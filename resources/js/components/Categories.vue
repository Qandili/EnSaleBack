<template>
    <div>
        <navbar/>
        <div  v-show="!single_categorie">
            <b-row   >
                <b-col class="mb-4" v-for="(categorie,index) in categories" :key="categorie.id" @click="fetchAdsbyCategory(categorie.id,categorie.name)" cols="4">
                    <v-layout>
                        <v-flex xs12 sm6 offset-sm3>
                        <v-card>
                            <v-img
                            class="white--text"
                            height="200px"
                            :src="'/Cat/'+pictures[index]+'.jpeg'" 
                            > 
                            </v-img>
                            <v-card-title>
                            <div>
                                <span class="grey--text">categorie {{index + 1}}</span><br>
                                <span>{{categorie.name}}</span><br>
                            </div>
                            </v-card-title>
                        </v-card>
                        </v-flex>
                    </v-layout>
                </b-col>
            </b-row>
        </div>
            <!-- <a class="mb-2 category-body" v-for="categorie in categories" :key="categorie.id" @click="fetchAdsbyCategory(categorie.id,categorie.name)">
                    <h4>{{categorie.name}}</h4>
            </a> -->
        <div class="data-list" v-show="single_categorie && !single_ad">
            <h5 class="big-title">{{categorieName}}</h5>
            <a class="card card-body mb-2" v-for="ad in ads" :key="ad.id"  @click="showAd(ad.id)">
                <div class="dateTime">{{ad.created_at}}</div>
                <h5 class="card-title">{{ad.title}}</h5>
                <b class="price">{{ad.price}} DH&emsp;<i class="fas fa-money-bill-wave"></i></b>
            </a>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                        <a class="page-link" href="#" @click="fetchAdsbyCategory(categorieId,categorieName,pagination.prev_page_url)">Previous</a>
                    </li>

                    <li class="page-item" disabled>
                        <a class="page-link text-dark" href="#">Page {{pagination.current_page}} of {{pagination.last_page}}</a>
                    </li>

                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                        <a class="page-link" href="#" @click="fetchAdsbyCategory(categorieId,categorieName,pagination.next_page_url)">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
        <child-component :display_ad="display_ad" v-show="single_ad"></child-component>
    </div>
</template>
<script>
    import {getLocalUser} from '../Helpers/auth'
    import Ad from './Ad';

    export default {
        components:{
            'child-component': Ad,
        },
        data(){
            return{
                categories:[],
                single_ad:'',
                pictures:[
                    "info",
                    "vehicule",
                    "louer",
                    "bien",
                    "loisir",
                    "service"

                ],
                single_categorie:'',
                categorieId: '',
                display_ad:'',
                categorieName:'',
                categorie:{
                    id:'',
                    name:''
                },
                ads:[],
                ad:{
                    id:'',
                    description:'',
                    price:'',
                    sold:'',
                    title:'',
                    user_id:'',
                    categorie_id:'',
                    created_at:'',
                },
                pagination:{},
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
            fetchAdsbyCategory(id,name,page_url){
                var user=getLocalUser();
                const AuthStr='Bearer '.concat(user.token);
                this.single_categorie='notempty';
                this.categorieId=id;
                this.categorieName=name;
                page_url=page_url || 'api/auth/categorie/'+id;
                fetch(page_url,{
                    headers:{
                        'Authorization': AuthStr,
                        'Content-Type': 'application/json',
                    }
                })
                .then(res=>res.json())
                .then(res=>{
                    //console.log(res.data);
                    this.ads=res.data;
                    this.makePagination(res.meta,res.links);
                })
                .catch(err => console.log(err));
            },
            makePagination(meta,links){
                let pagination={
                    current_page:meta.current_page,
                    last_page:meta.last_page,
                    next_page_url:links.next,
                    prev_page_url:links.prev
                }
                this.pagination=pagination;
            },
            showAd(id){
                var user=getLocalUser();
                const AuthStr='Bearer '.concat(user.token);
                this.single_ad='notempty';
                return new Promise((res,rej) =>{
                    axios.get('api/auth/ad/'+id,{
                        headers:{
                            'Authorization': AuthStr,
                            'Content-Type': 'application/json',
                        }
                    })
                    .then( response => {
                        console.log(response.data);
                        this.display_ad=response.data;
                    })
                    .catch(err => console.log(err));
                })
            },
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

