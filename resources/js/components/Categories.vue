<template>
    <div>
        <navbar/>
        <a class="card card-body mb-2 ad-body" v-for="categorie in categories" :key="categorie.id" @click="fetchAdsbyCategory(categorie.categorie_id)">
                <h3>{{categorie.name}}</h3>
        </a>
    </div>
</template>
<script>
    import {getLocalUser} from '../Helpers/auth'
    export default {
        data(){
            return{
                categories:[],
                categorie:{
                    categorie_id:'',
                    categorie_name:''
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

