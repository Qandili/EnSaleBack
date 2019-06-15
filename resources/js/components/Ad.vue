<template>
    <div class="card card-body mb-2 single-data">
        <div v-for="object in display_ad" :key="object.id">
            <div v-if="object.title">
                <h3>{{object.title}}</h3>
                <ul>
                    <li>Prix: {{object.price}}</li>
                    <li>Catégorie: {{object.categorie_id}}</li>
                    <li>Propriétaire: {{object.user_id}}</li>
                </ul>
                <p>{{object.description}}</p>
                <b>{{object.created_at}}</b>
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

export default {
    props:['display_ad'],
    data(){
        return{
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
            likes: 0,
            comments: 0,
            shares: 0,
        }
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
</style>

