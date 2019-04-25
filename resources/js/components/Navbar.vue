<template>
    <nav class="navbar navbar-expand-sm navbar-dark mb-2" style="background-color:#2699fb;">
        <a href="/login" class="navbar-brand site-name">EnSale</a>
        <div v-if="user" class="container">
            <a href="/" class="navbar-brand">Annonces</a>
            <a href="/categories" class="navbar-brand">Catégories</a>
            <a href="#" class="navbar-brand">Contacter nous</a>
            <a href="#" class="navbar-brand">Déposer une annonce</a>
            <a href="#" class="navbar-brand"><img src="" alt=""></a>
        </div>
    </nav>
</template>
<script>
import { getLocalUser } from '../Helpers/auth';
export default {
    created(){
        this.user=getLocalUser();
    },
    data(){
        return{
            user:null
        }
    }
}
</script>

<style>
    .site-name{
        margin-left: 30px;
        font-size: xx-large;
    }
</style>

