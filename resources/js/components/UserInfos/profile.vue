<template>
    <b-container fluid>
        <b-row>
            <b-col class="p-0" cols="12">
                <navbar/>
            </b-col>
        </b-row>
        <b-row>
            <b-col cols="2">
                <b-row>
                    <b-col>
                        <b-img v-if="!user.picture_name"  circle center width="100%"
                        :src="profileImage"
                        alt="Center image" class="profileImage"></b-img>
                        <b-img v-if="user.picture_name"  circle center width="100%"
                        :src="'/Profile_Pictures/'+user.picture_name"
                        alt="Center image" class="profileImage"></b-img>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col class="m-auto text-center" cols="12">
                        <p>{{ this.user.first_name }}</p>
                    </b-col>
                </b-row>
                <b-row>
                    <b-list-group class="m-auto myList">
                        <b-list-group-item class="" ><router-link to="/profile">paramétres</router-link></b-list-group-item>
                        <b-list-group-item><router-link to="/profile/mesannonces" >mes annonces</router-link></b-list-group-item>
                        <b-list-group-item><router-link to="/profile/mesfavoris" replace>mes favoris</router-link></b-list-group-item>
                    </b-list-group>
                </b-row>
            </b-col>
            <b-col>
                <router-view/>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
import { getLocalUser } from '../../Helpers/auth';
import {User} from '../../app.js';
export default {
    computed:{
    },
data(){
    return {
        profileImage:"https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light",
        user:this.$store.getters.currentUser,
    }
}
}
</script>

<style scopped>
.profileImage{
    margin: 10px 0px 10px 20px;
    border-radius: 100%;
}
.myList{
        width: 90%;
}
.user{
        margin: 50px 15px;
}
</style>
