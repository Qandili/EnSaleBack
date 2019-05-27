<template>
    <div class="back" >
        <navbar/>
        <b-container>
            <b-row class=" margin">
                <b-col class="m-auto bg-light radius" cols="6">
                    <b-form   @submit.prevent="addPost">
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
                                <img src="" alt="image">
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
                </b-col>
            </b-row>
        </b-container>
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
                image:'',
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
            onImageChange(e) {
                var fileReader=new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload=(e) => {
                    this.newAd.image=e.target.result;
                }
            },
            // createImage(file) {
            //     let reader = new FileReader();
            //     let vm = this;
            //     reader.onload = (e) => {
            //         vm.newAd.image = e.target.result;
            //     };
            //     reader.readAsDataURL(file);
            // },
            // uploadImage(){
            //     axios.post('/image/store',{image: this.image}).then(response => {
            //        console.log(response);
            //     });
            // },
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
                console.log("success");
                // window.location.href="http://127.0.0.1:8001/";
                // this.$router.push("/");
            })
            .catch((error) => {
                console.log(error);
            })
            // axios.post(apiDomain+'api/auth/ad/new', this.newAd,{
            //         headers:{
            //             'Authorization': AuthStr,
            //             'X-Requested-With': 'XMLHttpRequest',
            //             'Content-Type': 'application/json'
            //         }
            //     })
            //     .then(response => {
            //         res(response);
            //     })
            //     .catch(err => console.error(err));

            //this.$router.push({path: '/'});
        }
    }
}
</script>

<style>
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