<template>
    <div>
        <h5 class="sub-title"><i class="fas fa-list-ul"></i>&emsp;Mes annonces</h5>
        <b-row>
            <b-col cols="4" class="mb-2" v-for="ad in user.ads" :key="ad.id">
                <v-card class="mx-auto" color="#1E88E5" dark max-width="400" @click="showAd(ad.id)">
                    <v-card-title>
                        <i class="fas fa-shopping-cart mr-3"></i>
                        <span class="title font-weight-light">{{ad.created_at}}</span>
                    </v-card-title>
                    <v-card-text class="headline font-weight-bold">{{ad.title}}</v-card-text>
                    <v-card-actions>
                        <v-list-tile class="grow">
                            <v-list-tile-avatar color="grey darken-3">
                                <v-img class="elevation-6" src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light" v-if="!user.picture_name"></v-img>
                                <v-img class="elevation-6" :src="'/Profile_Pictures/'+user.picture_name" v-if="user.picture_name"></v-img>
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title>{{ user.first_name }} {{ user.last_name }}</v-list-tile-title>
                            </v-list-tile-content>
                            <v-layout align-center justify-end>
                                <i class="fas fa-money-bill-wave mr-2"></i>
                                <span class="subheading mr-2">{{ad.price}} Dh</span>&emsp;&emsp;
                                <i class="fas fa-trash-alt text-danger"></i>&emsp;
                                <i class="fas fa-pencil-alt text-warning"></i>
                            </v-layout>
                        </v-list-tile>
                    </v-card-actions>
                </v-card>
            </b-col>
        </b-row>
    </div>
</template>

<script>
import {getLocalUser} from '../../Helpers/auth';

export default {
    data(){
        return{
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
                user:{
                    ads:[],
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
                
                
        }
    },
    mounted(){
        //run automatically when the page loads
        this.fetchAds();
    },
    methods:{
        fetchAds(){
            var user=getLocalUser();
            const AuthStr='Bearer '.concat(user.token);
            axios.get(`/api/auth/userads/`+user.id,{
                headers:{
                    'Authorization': AuthStr,
                    'Content-Type': 'application/json',
                }
            }).then(res=>{
                console.log(res.data);
                this.user=res.data;
            })
            .catch(err => console.log(err));
        }
    }
}
</script>
<style>
.sub-title{
    color:#2699fb;
    margin: 20px;
}

</style>
