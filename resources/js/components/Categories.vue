<template>
    <div>
        <navbar/>
        <div class="categories">
            <a class="mb-2 category-body" v-for="categorie in categories" :key="categorie.id" @click="fetchAdsbyCategory(categorie.categorie_id)">
                    <h4>{{categorie.name}}</h4>
            </a>
        </div>
    </div>
</template>
<script>
    import {getLocalUser} from '../Helpers/auth'
    export default {
        data(){
            return{
                categories:[],
                categorie:{
                    id:'',
                    name:''
                }
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
            fetchAdsbyCategory(id){
                alert(id);
            }
        }
    }
</script>
<style>
    .categories{
        margin-top: 3%;
        position: relative;left:8%;
    }
    .category-body{
        float: left;
        width: 25%;
        margin: 1.5%;
        background-color: #083f91;
        padding: 1%;
        border-top-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }
    .category-body h4{
        color: white;
        text-align: center;
    }
</style>

