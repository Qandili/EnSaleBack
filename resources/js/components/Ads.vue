<template>
    <div>
        <navbar/>
        <div class="most-watched">
            <h5 class="big-title">Les plus vues</h5>
        </div>
        <div class="by-category">
            <h5 class="big-title">Naviguer par catégorie</h5>
        </div>
        <div class="data-list" v-show="!single_ad">
            <h5 class="big-title">Toutes les annonces</h5>
            <a class="card card-body mb-2 ad-body" v-for="ad in ads" :key="ad.id" @click="showAd(ad.id)">
                <div class="dateTime">{{ad.created_at}}</div>
                <h5 class="card-title">{{ad.title}}</h5>
                <span>{{getCity(ad.user_id)}}</span>
                <b class="price">{{ad.price}} DH&emsp;<i class="fas fa-money-bill-wave"></i></b>
            </a>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                        <a class="page-link" href="#" @click="fetchAds(pagination.prev_page_url)">Previous</a>
                    </li>

                    <li class="page-item" disabled>
                        <a class="page-link text-dark" href="#">Page {{pagination.current_page}} of {{pagination.last_page}}</a>
                    </li>

                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                        <a class="page-link" href="#" @click="fetchAds(pagination.next_page_url)">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
        <child-component :display_ad="display_ad" v-show="single_ad"></child-component>
    </div>
</template>
<script>
    import {getLocalUser} from '../Helpers/auth';
    import Ad from './Ad';
    
    export default {
        components:{
            'child-component': Ad,
        },
        data(){
            return{
                ads:[],
                single_ad:'',
                display_ad:'',
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
                picture:{
                    id:'',
                    file:'',
                    ad_id:''
                },
                user: {
                    id:'',
                    cne:'',
                    email:'',
                    first_name:'',
                    last_name:'',
                    phone_number:'',
                    address:'',
                    city:'',
                    bith_date:''
                },
                pagination:{},
                edit:false,
                likes: 0,
                comments: 0,
                shares: 0
            }
        },
        mounted(){
            //run automatically when the page loads
            this.fetchAds();
        },
        methods:{
            fetchAds(page_url){
                var user=getLocalUser();
                const AuthStr='Bearer '.concat(user.token);
                page_url=page_url || 'api/auth/ads';
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
            getCity(id){
                var user=getLocalUser();
                const AuthStr='Bearer '.concat(user.token);
                fetch('api/auth/user/'+id,{
                    headers:{
                        'Authorization': AuthStr,
                        'Content-Type': 'application/json',
                    }
                })
                .then(res=>res.json())
                .then(res=>{
                    console.log(res.data);
                    return res.data;
                })
                .catch(err => console.log(err));
            }
        }
    }
</script>
<style>
    .most-watched,.by-category,.data-list{
        margin: auto;
        width: 80%;
    }
    .most-watched .big-title,.by-category .big-title,.data-list .big-title{
        color: #2699fb;
        text-decoration: underline;
        margin-left: 0%;
    }

    .ad-body{
        border: 5px solid #bce0fd;
        height: 13%;
    }

    a.card,a.card:hover {
        color: inherit;
        text-decoration: none;
    }

    .dateTime{
        font-size: small;
        color: #083f91;
        position: absolute;top: 0;
    }
    .card-title{
        position: absolute;left: 20%;
    }

    .price{
        position: absolute;right: 5%;top:50%;
        /*border: 2px dashed #083f91;*/
        padding: 1px 20px 1px 20px;
        border-radius: 10px;
        background-color: rgb(235, 192, 74);
        color: white;
    }
</style>

