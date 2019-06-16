<template>
    <div>
        <navbar/>
        <div class="container">
            <div v-if="confirmed" class="row mt-5">
                <div class="col-lg-4 col-md-12 mt-5">
                    <div class="row mt-6">
                        <!--<img class="m-auto" width="100" height="100" src="https://cdn1.iconfinder.com/data/icons/e-commerce-set-1-3/64/a-01-512.png">-->
                        <span class="hello-message">Bienvenue dans EnSale</span>
                    </div>
                    <!-- <input  name="email" type="text">
                    <span>{{ errors.first('email') }}</span> -->

                    <form class="mt-5 login-form" action="">
                        <!--<label for="Email">Email address</label>-->
                        <input name="email" v-validate="'required|email'" v-model="credentials.email" type="email" required class="mb-2" id="" placeholder="Email">
                        <span class="text-danger d-block">{{ errors.first('email') }}</span>
                        <!--<label for="Password">Mot de passe</label>-->
                        <input  name="password" v-validate="'required'" v-model="credentials.password" type="password" required class="mb-2" id="" placeholder="Mot de passe">
                        <span class="text-danger">{{ errors.first('password') }}</span>
                        <p class="text-danger">{{ this.msg }}</p>
                    </form>
                    <div class="row mt-3 login-button">
                        <div class="col-6 text-center">
                            <button @click="logIn()" class="btn btn-primary">Se connecter</button>
                            <!-- <input type="submit" value="Login"> -->
                            <!--<button @click="confirm()" class="btn btn-success">Confirmer votre compte</button>-->
                        </div>
                    </div>
                    <div class="row mt-2 login-link">
                        <div class="col-7 text-center">
                            <a href="#">Mot de passe oublié?</a>
                        </div>
                    </div>
                </div>
                <div class="background-image">
                    <img height="70%" width="100%" src="e-commerce.png" alt="">
                </div>
            </div>
            <div v-else-if="!confirmed" class="row mt-5">
                <div class="col-lg-4 col-md-12 mt-5">
                    <!--<div class="row mt-9">
                        <img class="m-auto" width="100" height="100" src="https://cdn1.iconfinder.com/data/icons/e-commerce-set-1-3/64/a-01-512.png">
                    </div>-->
                    <div class="row mt-6">
                        <!--<img class="m-auto" width="100" height="100" src="https://cdn1.iconfinder.com/data/icons/e-commerce-set-1-3/64/a-01-512.png">-->
                        <span class="hello-message">Compte vérifié. Bienvenue parmi nous :)</span>
                    </div>
                    <form class="mt-5 login-form" action="">
                        <!--<label for="Password">Mot de passe</label>-->
                        <input  name="password" v-validate="'required'" v-model="credentials.password" type="password" required class="mb-2" id="" placeholder="Nouveau mot de passe">
                        <!--<label for="Password">Confirmer votre mot de passe</label>-->
                        <input  name="password_confirmation" v-validate="'required'" v-model="credentials.password_confirmation" type="password" required class="mb-2" id="" placeholder="Confirmer votre mot de passe">
                        <span class="text-danger">{{ errors.first('password') }}</span>
                        <p class="text-danger">{{ this.msg }}</p>
                    </form>
                    <div class="row mt-3 login-button">
                        <div class="col-6 text-center">
                            <button @click="confirm()" class="btn btn-success">Confirmer</button>
                        </div>
                    </div>
                    <!--<div class="row mt-2">
                        <div class="col-12 text-center">
                            <a href="#">mot de passe oublié?</a>
                        </div>
                    </div>-->
                </div>
                <div class="background-image">
                    <img height="70%" width="100%" src="e-commerce.png" alt="">
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

                console.log("login called");
                console.log(this.$data.credentials.email);
                verify(this.$data.credentials)
                .then((res) => {
                        console.log(res.response);
                        this.confirmed=true;
                        console.log("success");
                        // this.$router.push({path: '/'});
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

    .hello-message{
        font-size: 50px;
        color: #083f91;
    }

    .login-form input{
        border: none;
        border-bottom: 2px solid #083f91;
        height: 40px;
        width: 100%;
        margin: 5%;
    }

    .login-button .btn-primary{
        color: #2699fb;
        letter-spacing: 1px;
        line-height: 25px;
        border: 2px solid #2699fb;
        border-radius: 40px;
        background: transparent;
        transition: all 0.3s ease 0s;
    }

    .login-button .btn-primary:hover {
        color: #FFF;
        background: #2699fb;
        border: 2px solid #2699fb;
    }

    .login-button .btn-success{
        color: #3cdd57;
        letter-spacing: 1px;
        line-height: 25px;
        border: 2px solid #3cdd57;
        border-radius: 40px;
        background: transparent;
        transition: all 0.3s ease 0s;
    }

    .login-button .btn-success:hover {
        color: #FFF;
        background: #3cdd57;
        border: 2px solid #3cdd57;
    }

    .login-link a{
        color: #2699fb;
    }

    .background-image{
        margin-left: 14%;
        margin-top: 1%;
        width: 600px;
        height: 900px;
    }
</style>



