<template>
    <div>
        <navbar/>
        <div class="container bg-light">
            <div v-if="confirmed" class="row mt-5 border border-1">
                <div class="col-lg-4 col-md-12 mt-5">
                    <div class="row mt-9">
                        <img class="m-auto" width="100" height="100" src="https://cdn1.iconfinder.com/data/icons/e-commerce-set-1-3/64/a-01-512.png">
                    </div>
                    <!-- <input  name="email" type="text">
                    <span>{{ errors.first('email') }}</span> -->

                    <form class="mt-5" action="">
                        <label for="Email">Email address</label>
                        <input name="email" v-validate="'required|email'" v-model="credentials.email" type="email" required class="form-control mb-2 round" id="" placeholder="Email ou CNE">
                        <span class="text-danger d-block">{{ errors.first('email') }}</span>
                        <label for="Password">Mot de passe</label>
                        <input  name="password" v-validate="'required'" v-model="credentials.password" type="password" required class="form-control  mb-2 round" id="" placeholder="Mot de pass">
                        <span class="text-danger">{{ errors.first('password') }}</span>
                        <p class="text-danger">{{ this.msg }}</p>
                    </form>
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <button @click="logIn()" class="btn btn-primary">Se connecter</button>
                            <!-- <input type="submit" value="Login"> -->
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 text-center">
                            <a href="#">mot de passe oublié?</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 m-0 p-0">
                    <img height="70%" width="100%" src="http://www.fcensas.com/template/img/slider/ensas-pano.jpg" alt="">
                </div>
            </div>
            <div v-else-if="!confirmed" class="row mt-5 border border-1">
                <div class="col-lg-4 col-md-12 mt-5">
                    <div class="row mt-9">
                        <img class="m-auto" width="100" height="100" src="https://cdn1.iconfinder.com/data/icons/e-commerce-set-1-3/64/a-01-512.png">
                    </div>
                    <p class="text-center text-danger">Vous devez vérifier votre compte</p>
                    <p class="text-center text-danger">Entrer votre nouveau mot de passe</p>                    
                    <form class="mt-5" action="">

                        <label for="Password">Mot de passe</label>
                        <input  name="password" v-validate="'required'" v-model="credentials.password" type="password" required class="form-control  mb-2 round" id="" placeholder="Mot de pass">
                        <label for="Password">confirmer votre Mot de passe</label>
                        <input  name="password_confirmation" v-validate="'required'" v-model="credentials.password_confirmation" type="password" required class="form-control  mb-2 round" id="" placeholder="confirmer votre Mot de pass">
                        <span class="text-danger">{{ errors.first('password') }}</span>
                        <p class="text-danger">{{ this.msg }}</p>
                    </form>
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <button @click="confirm()" class="btn btn-success">Confirmer votre compte</button>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 text-center">
                            <a href="#">mot de passe oublié?</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 m-0 p-0">
                    <img height="70%" width="100%" src="http://www.fcensas.com/template/img/slider/ensas-pano.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {apiDomain} from '../../config.js'
    import {login, getLocalUser,verify} from '../../Helpers/auth'

    export default {
        name:"login",
        computed: {
            welcome(){
                return this.$store.getters.welcome;
            }
        },
    data() {
        return {
            msg:"",
            AuthStr:'',
            confirmed:true,
            myprop:"",
            verify:false,
            token:"",
            user:null,
            requiredEmail:"",
            requiredPassword:"",
            error:{
                message:"",
                "email":[]
            },
            credentials:{
                id:"",
                email:"",
                password:"",
                password_confirmation:"",
                remember_me: false

            },
        };
        },
        methods: {
            logIn(){
                this.$validator.validate().then(valid => {
                if (!valid) {
                    return 0;
                }else{

                console.log("login called");
                console.log(this.$data.credentials.email);
                this.$store.dispatch('login');
                login(this.$data.credentials)
                .then((res) => {
                    console.log(res.response);
                    if(res.response==("unconfirmed_account")){
                        this.$data.credentials.id=res.user.id;
                        this.$data.credentials.password=null;
                        this.confirmed=false; 
                    }
                    else{
                        this.confirmed=true;
                        this.$store.commit("loginSuccess",res);
                        console.log("success");
                        this.$router.push({path: '/'});
                    }


                })
                .catch((error) => {
                    console.log(error);
                    this.error=error.message;
                    this.$store.commit("loginFailed",{error});//error is a payload
                    this.msg=error;
                })
                }
                });
            },
        confirm(){
                this.$validator.validate().then(valid => {
                if (!valid) {
                    return 0;
                }else{

                console.log("confirm called");
                console.log(this.$data.credentials.email);
                this.confirmed=true;
                verify(this.$data.credentials)
                .then((res) => {
                        console.log("success");
                })
                .catch((error) => {
                    console.log(error);
                    this.error=error.message;
                    this.$store.commit("Verification failed",{error});//error is a payload
                    this.msg=error;
                })
                }
                });
        },
    },
}
</script>
<style>
    .mt-9{
        margin-top: 35px;
    }
    #img{
        width: 100%;
        height:100%;
    }
</style>



