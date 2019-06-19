<template>
    <div>
        <navbar/>
        <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="section-title">Nous sommes à l'écoute <i class="far fa-smile-wink"></i></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <p class="text">Nous vous invitons à remplir notre formulaire, si vous avez des questions techniques, 
                        commerciales ou memes des réclamations.</p>

                    <div class="find-widget">
                    StartUp:  <a href="#">EnSale</a>
                    </div>
                    <div class="find-widget">
                    Adresse:  <a href="#">Sidi Bouzid</a>
                    </div>
                    <div class="find-widget">
                    Tel:  <a href="#">+ 879-890-9767</a>
                    </div>
                    
                    <div class="find-widget">
                    Site web:  <a href="#">www.Ensale.ma</a>
                    </div>
                </div>
                <!-- contact form -->
                <div class="col-md-6">
                    <form method="post" @submit.prevent="onSubmit">
                        <!-- Subject -->
                        <div class="form-group">
                            <input class="form-control" placeholder="Sujet" type="text" name="subject" required data-error="Please enter your message subject" v-model="info.subject">
                            <div class="help-block with-errors"></div>
                        </div>
                        <!-- Message -->
                        <div class="form-group">
                            <textarea class="form-control" rows="8" id="message" placeholder="Votre message ici..." name="message" required data-error="Write your message" v-model="info.message"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <!-- Form Submit -->
                        <div class="form-submit mt-5 contact-button">
                            <button class="btn btn-primary" type="submit" id="form-submit"><i class="fas fa-paper-plane"></i>&emsp;Envoyer</button>
                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </section>
        <mfooter></mfooter>
    </div>
</template>

<script>
import {getLocalUser} from '../Helpers/auth';

export default {
    data(){
        return{
            info:{
                email: getLocalUser().email,
                subject:'',
                message:''
            },
            success:false
        }
    },
    methods:{
        onSubmit(){
            var user=getLocalUser();
            const AuthStr='Bearer '.concat(user.token);
            return new Promise((res,rej) =>{
                axios.post('api/auth/send',
                {
                    email: this.info.email,
                    subject: this.info.subject,
                    message: this.info.message,
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
        }
    }
}

</script>

<style>
    .contact-button .btn-primary{
        color: #2699fb;
        letter-spacing: 1px;
        line-height: 25px;
        border: 2px solid #2699fb;
        border-radius: 40px;
        background: transparent;
        transition: all 0.3s ease 0s;
    }

    .contact-button .btn-primary:hover {
        color: #FFF;
        background: #2699fb;
        border: 2px solid #2699fb;
    }

    .section-title{
        color: #2699fb;
    }

    .text{
        font-size: large;
    }
</style>
