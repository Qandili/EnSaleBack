<template>
    <div class="card card-body mb-2 single-data">
        <div v-for="object in display_ad" :key="object.id">
            <div v-if="object.title">
                <b-dropdown v-if="object.user.id==local_user.id" variant="link" toggle-class="text-decoration-none" class="menu" no-caret>
                    <template slot="button-content"><i class="fas fa-ellipsis-v"></i><span class="sr-only">Menu</span></template>
                    <b-dropdown-item><router-link  to="#"><i class="fas fa-trash-alt"></i>&emsp;Modifier</router-link></b-dropdown-item>
                    <b-dropdown-item><router-link  to="#"><i class="fas fa-pencil-alt"></i>&emsp;Supprimer</router-link></b-dropdown-item>
                </b-dropdown>
                <h3 class="ad-title">{{object.title}}</h3>
                <p>{{object.description}}</p>
                <ul class="informations">
                    <li><b>Prix:</b>&emsp;<span class="price">{{object.price}}DH</span></li>
                    <li><b>Catégorie:</b>&emsp;{{object.categorie.name}}</li>
                    <li><b>Propriétaire:</b>&emsp;{{object.user.first_name}} {{object.user.last_name}}</li>
                </ul>
                <b class="dateTime">{{object.created_at}}</b>
            </div>
            <div v-else v-for="picture in object" :key="picture.id">
                <img class="picture" :src="'/serverimages/'+picture.file" alt="image">
            </div>
        </div>
        <ul class="reactions">
            <li><a @click="likes++"><i class="far fa-thumbs-up"></i> {{likes}}</a></li>&emsp;
            <li><a @click="comment()"><i class="far fa-comment-dots"></i> {{comments}}</a></li>&emsp;
            <li><a @click="share()"><i class="fas fa-share"></i> {{shares}}</a></li>
        </ul>
    </div>
</template>
<script>
import {getLocalUser} from '../Helpers/auth';

export default {
    props:['display_ad'],
    data(){
        return{
            local_user:'',
            ad:{
                id:'',
                description:'',
                price:'',
                sold:'',
                title:'',
                created_at:'',
                user: {
                    id:'',
                    picture_name:null,
                    cne:'',
                    email:'',
                    first_name:'',
                    last_name:'',
                    phone_number:'',
                    address:'',
                    city:'',
                    bith_date:''
                },
                categorie:{
                    id:'',
                    name:''
                }
            },
            picture:{
                id:'',
                file:'',
                ad_id:''
            },
            likes: 0,
            comments: 0,
            shares: 0,
        }
    },
    mounted(){
        //run automatically when the page loads
        this.local_user=getLocalUser();
    }
}

</script>
<style>
    .single-data{
        margin: auto;
        width: 80%;
    }

    .reactions li{
        display: inline-block;
        list-style-type: none;
        position: relative;left: 88%;bottom: 0%;
    }
    .picture{
        width: 50%;
        height: 60%;
        float: left;
        margin-top: 20px;
        border: 2px solid white;
    }

    .ad-title{
        height: 50px;
        width: 100%;
        color: #083f91;
        font-size: xx-large;
        border-bottom: 2px solid #083f91;
    }

    .informations{
        border: 2px solid #083f91;
        border-radius: 12px;
        padding: 2%;
        width: 50%;
        /*background-color: #bce0fd;*/
    }

    .informations li{
        margin: 7px;
        color: black;
        list-style: none;
    }

    .informations li b{
        color: #083f91;
    }

    .price{
        font-size: x-large;
    }

    .dateTime{
        position: absolute;right:0;top:0;
        /*border: 2px dashed #083f91;*/
        padding: 1px 20px 1px 20px;
        border-radius: 5px;
        background-color: #083f91;
        color: white;
    }

    .menu{
        margin-top: 10px;
        float: right;
    }
</style>

