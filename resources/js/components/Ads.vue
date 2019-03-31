<template>
    <div>
        <div class="most-watched">
            <h4 class="big-title">Les plus vues</h4>
        </div>
        <div class="by-category">
            <h4 class="big-title">Naviguer par catégorie</h4>
        </div>
        <div class="data-list" v-show="!single_ad">
            <h4 class="big-title">Toutes les annonces</h4>
            <a class="card card-body mb-2 ad-body" v-for="ad in ads" :key="ad.id" @click="showAd(ad.id)">
                <h3>{{ad.title}}</h3>
                <ul>
                    <li>Prix: {{ad.price}}</li>
                    <li>Catégorie: {{ad.categorie}}</li>
                </ul>
                <b>{{ad.created_at}}</b>
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

        <div class="card card-body mb-2 ad-body single-data" v-for="ad in single_ad" :key="ad.id" v-show="single_ad">
            <h3>{{ad.title}}</h3>
            <ul>
                <li>Prix: {{ad.price}}</li>
                <li>Catégorie: {{ad.categorie}}</li>
                <li>Propriétaire: {{ad.categorie}}</li>
            </ul>
            <p>{{ad.description}}</p>
            <b>{{ad.created_at}}</b>
            <ul class="reactions">
                <li><a @click="likes++"><i class="far fa-thumbs-up"></i> {{likes}}</a></li>&emsp;
                <li><a @click="comment()"><i class="far fa-comment-dots"></i> {{comments}}</a></li>&emsp;
                <li><a @click="share()"><i class="fas fa-share"></i> {{shares}}</a></li>
            </ul>  
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                ads:[],
                single_ad:'',
                ad:{
                    id:'',
                    description:'',
                    price:'',
                    sold:'',
                    title:'',
                    student:'',
                    categorie:'',
                    created_at:''
                },
                ad_id:'',
                pagination:{},
                edit:false,
                likes: 0,
                comments: 0,
                shares: 0
            }
        },
        created(){
            //run automatically when the page loads
            this.fetchAds();
        },
        methods:{
            fetchAds(page_url){
                let vm=this;
                page_url=page_url || 'api/ads'
                fetch(page_url)
                .then(res=>res.json())
                .then(res=>{
                    //console.log(res.data);
                    this.ads=res.data;
                    vm.makePagination(res.meta,res.links);
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
                let vm=this;
                fetch('api/ad/'+id)
                .then(res=>res.json())
                .then(res=>{
                    //console.log(res.data);
                    this.single_ad=res.data;
                    })
                    .catch(err => console.log(err));
            }

        }
    }
</script>
<style>
    .big-title{
        color: #2699fb;
        text-decoration: underline;
    }
    .ad-body{
        border: 1px solid #bce0fd;
    }

    a.card,a.card:hover {
        color: inherit;
        text-decoration: none;
    }
    .reactions li{
        display: inline-block;
        list-style-type: none;
        position: relative;left: 88%;bottom: 0%;
    }
    .single-data{
        height: 247px;
    }
</style>

