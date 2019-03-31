<template>
    <div>
        <a class="card card-body mb-2 ad-body" v-for="categorie in categories" :key="categorie.categorie_id" @click="fetchAdsbyCategory(categorie.categorie_id)">
                <h3>{{categorie.categorie_name}}</h3>
        </a>
    </div>
</template>
<script>
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
                let vm=this;
                page_url=page_url || 'api/categories'
                fetch(page_url)
                .then(res=>res.json())
                .then(res=>{
                    //console.log(res.data);
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

