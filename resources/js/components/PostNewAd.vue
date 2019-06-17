<template>
    <div>
        <navbar/>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <b-container class="m-auto bg-light radius">
                        <div class="modal-header">
                            <h4 class="modal-title">Déposer votre annonce</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <b-form @submit.prevent="addPost">
                                <b-row class="p-2">
                                    <b-col class="m-auto" cols="8">
                                        <b-form-select v-model="newAd.categorie_id">
                                            <option :value=0>Choisissez une catégorie</option>
                                            <option :value="categorie.id" v-for="categorie in categories" :key="categorie.id">
                                                {{categorie.name}}
                                            </option>
                                        </b-form-select>
                                    </b-col>
                                </b-row>
                                <b-row class="p-2">
                                    <b-col class="m-auto" cols="8">
                                        <b-form-input id="input-2" v-model="newAd.title" placeholder="Titre de l'annonce" ></b-form-input>
                                    </b-col>
                                </b-row>
                                <b-row class="p-2">
                                    <b-col class="m-auto" cols="8">
                                        <b-form-textarea id="textarea" v-model="newAd.description" placeholder="Description..." rows="3" max-rows="6"></b-form-textarea>
                                    </b-col>
                                </b-row>
                                <b-row>
                                    <b-col class="m-auto" cols="8">
                                        <input type="file" @change="onImageChange" name="image" class="form-control">
                                    </b-col>
                                </b-row>
                                <b-row>
                                    <b-col  class="m-auto" cols="12">
                                        <span  v-bind:key="index" v-for="(images,index) in this.newAd.image">
                                            <!-- <img class="image" :src="images" alt="image">
                                            <button class="text-danger hi">x</button> -->
                                            <!-- {{ index }} -->
                                            <div id="container">
                                                    <button v-on:click="close(index,$event)" id = "x">X</button>
                                                    <img class="image" :src="images" alt="image">
                                            </div>
                                        </span>
                                    </b-col>
                                </b-row>
                                <b-row class="p-2">
                                    <b-col class="m-auto" cols="8">
                                        <b-form-group id="input-group-2">
                                            <b-form-input type="number" id="input-2" v-model="newAd.price" placeholder="Prix"></b-form-input>
                                        </b-form-group>
                                    </b-col>
                                </b-row>
                                <b-row>
                                    <b-col class="m-auto" cols="6">
                                        <b-button class="ml-4" type="submit" variant="primary">Déposer votre annonce</b-button>
                                    </b-col>
                                </b-row>
                            </b-form>
                        </div>
                    </b-container>
                </div>
            </div>
        </div>
        <!-- <h4 class="big-title">Déposer votre annonce</h4>
        <b-form  class="form" @submit.prevent="addPost">
            <fieldset>
                <legend>Informations générales</legend>
                <b-form-select v-model="newAd.categorie_id">
                    <option :value=0>Choisissez une catégorie</option>
                    <option :value="categorie.id" v-for="categorie in categories" :key="categorie.id">
                        {{categorie.name}}
                    </option>
                </b-form-select>
                <b-form-group id="input-group-2">
                    <b-form-input id="input-2" v-model="newAd.title" placeholder="Titre de l'annonce" ></b-form-input>
                </b-form-group>
                <b-form-textarea id="textarea" v-model="newAd.description" placeholder="Déscription..." rows="3" max-rows="6"></b-form-textarea>
                <b-form-group id="input-group-2">
                    <b-form-input id="input-2" v-model="newAd.price" placeholder="Prix"></b-form-input>
                </b-form-group>
            </fieldset>
            <fieldset>
                <legend>Photos</legend>
            </fieldset>
            <fieldset>
                <legend>Vos informations</legend>
                <b-form-group id="input-group-2">
                    <b-form-input id="input-2" :value="user.last_name" placeholder="Nom" disabled></b-form-input>
                </b-form-group>
                <b-form-group id="input-group-2">
                    <b-form-input id="input-2" :value="user.first_name" placeholder="Prénom" disabled></b-form-input>
                </b-form-group>
                <b-form-group id="input-group-1">
                    <b-form-input id="input-1" :value="user.email" type="email" placeholder="Email" disabled></b-form-input>
                </b-form-group>

                <b-form-group id="input-group-2">
                    <b-form-input id="input-2" :value="user.phone_number" placeholder="Téléphone" disabled></b-form-input>
                </b-form-group>
            </fieldset>
            <b-button type="submit" variant="primary">Déposer votre annonce</b-button>
        </b-form> -->

    </div>
</template>

<script>
import {getLocalUser} from '../Helpers/auth';
import { apiDomain } from '../config';
import {postAd} from './../Helpers/Ads'

export default {
    data(){
        return{
            image:null,
            user:this.$store.getters.currentUser,
            categories:[],
            newAd: {
                image:[],
                title:'',
                description:'',
                price:0,
                user_id:this.$store.getters.currentUser.id,
                categorie_id:0,
            },
        }
    },
    created(){
        this.fetchCategories();
    },
    methods:{
            close(index,e){
                e.preventDefault();
                this.newAd.image.splice(index, 1);
            },
            onImageChange(e) {
                var fileReader=new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload=(e) => {
                    this.newAd.image.push(e.target.result);
                }
            },
        fetchCategories(page_url){
            var user=getLocalUser();
            const AuthStr='Bearer '.concat(user.token);
            page_url=page_url || 'api/auth/categories'
            fetch(page_url,{
                headers:{
                    'Authorization': AuthStr,
                    'Content-Type': 'application/json',
                }
            })
            .then(res=>res.json())
            .then(res=>{
                this.categories=res.data;
            })
            .catch(err => console.log(err));
        },
        addPost() {
            var user=getLocalUser();
            const AuthStr='Bearer '.concat(user.token);
            console.log(this.newAd);
            postAd(this.newAd)
            .then((res) => {
                this.$bvToast.toast('Votre annonce a bien été publiée', {
                    title: 'Message',
                    variant: "success",
                    solid: true
                })
                //window.location.href="http://127.0.0.1:8000/";
            })
            .catch((error) => {
                console.log(error);
                this.$bvToast.toast(error, {
                title: 'Message',
                variant: "danger",
                solid: true
                })
            })
            //this.$router.push({path: '/'});
        }
    }
}
</script>

<style>



#container {
    width: 30%;
    border-radius: 25px;
    border: 2px solid #A4D3EE;
    /* padding: 15px 15px 15px 15px; */
    margin: 20px 20px 20px 20px;
    background: #A4D3EE;
    overflow: visible;
    box-shadow: 3px 3px 2px #888888;
    position: relative;
    display: inline-block;
}

#x {
    position: absolute;
    background: red;
    color: white;
    top: -10px;
    right: -10px;
}
    .margin{
        margin-top:10%;   
    }
    /* .back{
        background-image: url("https://cdn1.iconfinder.com/data/icons/e-commerce-set-1-3/64/a-01-512.png");
    } */
    .big-title{
        margin-left: 10%;
        color: #2699fb;
        text-decoration: underline;
    }
    .radius{
            border-radius: 1rem;
    }
    .image{
        width: 100%;
        height: 16%;
        margin: 1;
        padding: 6px;
        /* border: 1px solid gray; */
        border-radius: 1.5rem;
    }
    .form{
        width: 60%;
        margin: auto;
        margin-top:50px;
        margin-bottom:50px;
        padding: 30px;
        border: 5px solid #083f91;
        border-top-left-radius: 30px;
        border-bottom-right-radius: 30px;
    }
    fieldset legend{
        font-weight: bold;
        font-size: 25px;
        color: #083f91;
    }

</style>