<template>
    <div>
        <navbar/>
        <h4 class="big-title">Déposer votre annonce</h4>
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
        </b-form>
    </div>
</template>

<script>
import {getLocalUser} from '../Helpers/auth';
import { apiDomain } from '../config';

export default {
    data(){
        return{
            user:this.$store.getters.currentUser,
            categories:[],
            newAd: {
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
            return new Promise((res,rej) =>{
                axios.post(apiDomain+'api/auth/ad/new', this.newAd,{
                    headers:{
                        'Authorization': AuthStr,
                        //'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => {
                    res(response);
                })
                .catch(err => console.error(err));
            })
            //this.$router.push({path: '/'});
        }
    }
}
</script>

<style>
    .big-title{
        margin-left: 10%;
        color: #2699fb;
        text-decoration: underline;
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