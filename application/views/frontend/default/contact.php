<?php include 'pixel-facebook.php';?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/custom-about.css'); ?>">


<div class="container-contact">
    <form autocomplete="off" action="<?php echo site_url('contact/add'); ?>" method="post" role="form">
    <div class="contact-box">
        <div id="left" style="background: url(<?php echo base_url().'assets/frontend/images/frontend/contact-img.jpg' ?>); "></div>
        <div class="right">
            <h2>Contáctanos!</h2>
            <input type="text" name="name" class="field" placeholder="Nombre y apellido" required="">
            <input type="email" name="email" class="field" placeholder="Correo electrónico" required="">
            <textarea placeholder="Mensaje" name="message" class="field" required=""></textarea>
            <button class="btn-form" type="submit">Enviar</button>
        </div>
    </div>
    </form>
</div>








