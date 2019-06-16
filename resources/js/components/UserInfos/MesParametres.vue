<template>
<b-container fluid>
    <b-row>
        <b-col class="text-center">
            <h2 class="text-success text-center">Changer votre photo de profil</h2>
        </b-col>
    </b-row>
    <b-row>
        <b-col class="m-auto" cols="6">
            <b-img @click="clickImage()" id="myImage"  circle center :src="defaultt" alt="Center image" width="200%" height="200%" class="profileImage border border-dark"></b-img>
            <b-row>
                <b-col class="m-auto" cols="8">
                    <input id="hiddenInput" style="display:none;" type="file" @change="onImageChange" name="image" class="form-control">
                </b-col>
            </b-row>
        </b-col>
    </b-row>
    <b-row>
        <b-col class="text-center m-2">
            <button @click="uploadImage()" class="btn btn-success m-auto text-center">Upload Picture</button>
        </b-col>
    </b-row>

</b-container>
</template>

<script>
export default {
    data() {
    return {
        credentials:{
            image:"",
            id:this.$parent.user.id,
        },
        defaultt:"http://pluspng.com/img-png/a-plus-logo-vector-png-free-vector-plus-icon-png-560.png",
        form: {
        cne:this.$parent.user.cne,
        email: this.$parent.user.email,
        firstName: this.$parent.user.first_name,
        lastName:this.$parent.user.last_name,
        },
        foods: [{ text: 'Select One', value: null }, 'Carrots', 'Beans', 'Tomatoes', 'Corn'],
        show: true
    }
    },
    methods: {
    onSubmit(evt) {
        evt.preventDefault()
        alert(JSON.stringify(this.form))
    },
    onReset(evt) {
        evt.preventDefault()
        // Reset our form values
        this.form.email = ''
        this.form.firstName = ''
        this.form.food = null
        this.form.checked = []
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
        this.show = true
        })
    },
    clickImage(){
        console.log("image Clicked");
            $("input[id='hiddenInput']").click();
    },
    close(index,e){
                e.preventDefault();
                this.newAd.image.splice(index, 1);
    },
    onImageChange(e) {
                var fileReader=new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload=(e) => {
                    this.credentials.image=e.target.result;
                    this.defaultt=e.target.result;
                    console.log(this.credentials.image);
                }
    },
    uploadImage(){
        axios.put('/api/auth/updatePicture',this.credentials)
        .then((res) => {
                this.$bvToast.toast('Votre Photo de profile a bien été publiée', {
                    title: 'Message',
                    variant: "success",
                    solid: true
                })
                console.log(this.$parent.user.picture_name);
                var user=JSON.parse(window.localStorage.getItem('user'));
                var myPicture=this.credentials.image.split(",");
                var $extension;
                if(myPicture[0].includes("jpg") || myPicture[0].includes("jpeg")){
                    $extension="jpg";
                }else{
                    $extension="png";
                }
                user.picture_name=this.$parent.user.email+'_'+this.$parent.user.cne+'.'+$extension;
                window.localStorage["user"] = JSON.stringify(user);
                this.$parent.user.picture_name=this.$parent.user.email+'_'+this.$parent.user.cne+'.'+$extension; 

            }).catch((error) => {
                console.log(error);
                this.$bvToast.toast(error, {
                title: 'Message',
                variant: "danger",
                solid: true
                })
            })
    }
    }
}
</script>