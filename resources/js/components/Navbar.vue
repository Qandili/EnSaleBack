<template>
    <nav class="navbar navbar-expand-sm navbar-dark mb-2" style="background-color:#2699fb;">
        <a href="/login" class="navbar-brand site-name">EnSale</a>
        <div v-if="user" class="container divNav">
            <a href="/" class="navbar-brand">Annonces</a>
            <a href="/categories" class="navbar-brand">Catégories</a>
            <a href="#" class="navbar-brand">Contacter nous</a>
            <a href="#" class="navbar-brand">Déposer une annonce</a>
            <a href="#" class="navbar-brand"><img src="" alt=""></a>
        </div>
        <div>
        <b-dropdown v-if="user" variant="primary" id="dropdown-1" text="options" class="m-md-2 primary drop">
            <b-dropdown-item>Profile</b-dropdown-item>
            <b-dropdown-item>Mes annonces</b-dropdown-item>
            <b-dropdown-item>mes favories</b-dropdown-item>
            <b-dropdown-divider></b-dropdown-divider>
            <b-dropdown-item @click="logout"  active>Logout</b-dropdown-item>
        </b-dropdown>
</div>
    </nav>
</template>
<script>
import { logout,getLocalUser } from '../Helpers/auth';
export default {
    created(){
        this.user=getLocalUser();
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
</style>

