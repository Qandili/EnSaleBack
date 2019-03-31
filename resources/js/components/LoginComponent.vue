<template>
    <div class="container bg-light">
        <div class="row mt-5 border border-1">
            <div class="col-lg-4 col-md-12 mt-5">
                <div class="row mt-9">
                    <img class="m-auto" width="100" height="100" src="https://image.flaticon.com/icons/png/512/17/17004.png">
                </div>
                <form class="mt-5" action="">
                    <label for="Email">Email address</label>
                    <input v-model="student.student_cne" type="email" class="form-control mb-2 round" id="" placeholder="Email ou CNE">
                    <label for="Password">Mot de passe</label>
                    <input  v-model="student.password" type="password" class="form-control  mb-2 round" id="" placeholder="Mot de pass">
                    <p class="text-danger">{{ this.msg }}</p>
                </form>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <button @click="logIn(student.student_cne,student.password)" class="btn btn-primary">Se connecter</button>
                        <button class="btn btn-success">Confirmer votre compte</button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 text-center">
                        <a href="#">mot de passe oublié?</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 m-0 p-0">
                <img width="100%" src="https://cdn-06.9rayti.com/rsrc/cache/widen_750/uploads/2017/07/Concours-d%E2%80%99acc%C3%A8s-en-3%C3%A8me-ann%C3%A9e-ENSA-Safi-2017.png" alt="">
            </div>
        </div>
    </div>
</template>
<script>
    export default {
    data() {
        return {
            info:0,
            msg:"",
            student: {
                student_cne: '',
                first_name: '',
                last_name: '',
                email: '',
                phone_number: 0,
                password: '',
                birth_date: '',
                confirmed_account: '',
                isAdmin: false
            },
        };
        },
        methods: {
            logIn(cne,pass){
                axios
                .post('http://127.0.0.1:8000/api/login', {
                    student_cne:cne,
                    password:pass,
                }).then((response) => {
                    this.info=(response.data);
                })
                .catch(function (error) {
                console.log(error)});
                setTimeout( () => 
                {if(this.info===1){
                    window.location.href="http://127.0.0.1:8000/api/test";
                    console.log("login success");   
                    return true;
                }
                this.msg="false password or username !";
                console.log(this.msg);      
                return false;
                }, 1000);
    }
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

