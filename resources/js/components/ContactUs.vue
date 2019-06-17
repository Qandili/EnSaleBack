<template>
    <div style="background:#E3F2FD">
        <navbar/>
        <section class="Material-contact-section section-padding section-dark height">
        <div class="container">
            <div class="row">
                <!-- Section Titile -->
                <div class="col-md-12 wow animated fadeInLeft" data-wow-delay=".2s">
                    <h1 class="section-title">Love to Hear From You</h1>
                </div>
            </div>
            <div class="row">
                <!-- Section Titile -->
                <div class="col-md-6 mt-3 contact-widget-section2 wow animated fadeInLeft" data-wow-delay=".2s">
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content.</p>

                    <div class="find-widget">
                    StartUp  <a href="https://hostriver.ro">EnSale</a>
                    </div>
                    <div class="find-widget">
                    Adresse: <a href="#">Sidi Bouzid</a>
                    </div>
                    <div class="find-widget">
                    Tel:  <a href="#">+ 879-890-9767</a>
                    </div>
                    
                    <div class="find-widget">
                    Site web:  <a href="https://uny.ro">www.Ensale.ma</a>
                    </div>
                </div>
                <!-- contact form -->
                <div class="col-md-6 wow animated fadeInRight" data-wow-delay=".2s">
                    <form class="shake" role="form" method="post" id="contactForm" name="contact-form" data-toggle="validator">
                        <!-- Name -->
                        <div class="form-group label-floating">
                            <label class="control-label" for="name">Nom et prénom</label>
                            <input class="form-control" id="name" type="text" name="name" required data-error="Please enter your name">
                            <div class="help-block with-errors"></div>
                        </div>
                        <!-- email -->
                        <div class="form-group label-floating">
                            <label class="control-label" for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email" required data-error="Please enter your Email">
                            <div class="help-block with-errors"></div>
                        </div>
                        <!-- Subject -->
                        <div class="form-group label-floating">
                            <label class="control-label">Sujet</label>
                            <input class="form-control" id="msg_subject" type="text" name="subject" required data-error="Please enter your message subject">
                            <div class="help-block with-errors"></div>
                        </div>
                        <!-- Message -->
                        <div class="form-group label-floating">
                            <label for="message" class="control-label">Message</label>
                            <textarea class="form-control" rows="3" id="message" name="message" required data-error="Write your message"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <!-- Form Submit -->
                        <div class="form-submit mt-5 contact-button">
                            <button class="btn btn-primary" type="submit" id="form-submit"><i class="fas fa-paper-plane"></i>&emsp;Envoyer</button>
                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </section>
        <mfooter class="Cusfooter"></mfooter>
    </div>
</template>

<script>
export default {
name:"SpaTest"
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
.Cusfooter{
    bottom: 0;
    position: absolute;
    width: 100%;
}
.height{
        height: 83%;
}
</style>
