<template>
    <nav class="navbar navbar-expand-sm navbar-dark mb-2" style="background-color:#2699fb;">
        <a href="/" class="navbar-brand site-name">EnSale</a>
        <div v-if="!user" class="navbar-brand slogan">Le 1er site d'annonces gratuites exclusive pour ENSAistes au Maroc</div>
        <div v-if="user" class="container divNav">
            <router-link to="/" class="navbar-brand">Annonces</router-link>
            <router-link to="/categories" class="navbar-brand">Catégories</router-link>
            <a href="#" class="navbar-brand">Contacter nous</a>
            <router-link to="/newad" class="navbar-brand" data-toggle="modal" data-target="#myModal">Déposer une annonce</router-link>
            <a href="#" class="navbar-brand"><img src="" alt=""></a>
        </div>
        <div>
            <b-dropdown v-if="user" variant="primary" id="dropdown-1" text="Options" class="m-md-2 primary drop">
                <b-dropdown-item><router-link  to="/profile">profil</router-link></b-dropdown-item>
                <b-dropdown-item>Mes annonces</b-dropdown-item>
                <b-dropdown-item>mes favories</b-dropdown-item>
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-item @click="logout"  active>Logout</b-dropdown-item>
            </b-dropdown>
        </div>  
    </nav>
</template>
<script>
import { logout,getLocalUser } from '../../Helpers/auth';

export default {
    created(){
        this.user=getLocalUser();
        

        console.log(this.$store.getters.currentUser);
    },
    data(){
        return{
            user:null
        }
    },
    methods:{
        logout(){
                // console.log("logout called");
                this.$store.dispatch('logout'); 

                // logout()
                // .then((res) => {

                //     // this.$store.commit("logout",res);
                //     // console.log("success");
                //     // window.location.href="http://127.0.0.1:8001/";
                //     // this.$router.push("/");
                // })
                // .catch((error) => {
                //     console.log(error);
                //     this.error=error.message;
                //     this.$store.commit("loginFailed",{error});//error is a payload
                //     this.msg=error;
                // })
                
        }
    }
}
</script>

<style>
    .site-name{
        margin-left: 30px;
        font-size: xx-large;
    }
    .divNav{
        margin-left: 5%;
    }
    .drop{
        right: 50%;
    }

    .slogan{
        margin-left: 5px;
        margin-top: 9px;
        font-style: italic;
        font-size: medium;
    }
</style>

