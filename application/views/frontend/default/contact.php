<?php include 'pixel-facebook.php';?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/custom-about.css'); ?>">
<style>
    body {
        background: #050017 !important;;
    }
    .colormenu {
        background-color: #4e3999;
    }
    .btn-form {
        width: auto;
        padding: 0.4rem 0.5rem;
        background-color: #ffffff;
        color: #48668E;
        border: 2px solid #48668E;
        border-radius: 1rem;
        font-size: 1.1rem;
        cursor: pointer;
        transition: .3s;
        font-family: 'roboto';
        letter-spacing: 2px;
    }
    
    @media (max-width: 767px){
        .container-volver {
          color: white;
          display: block !important;
          margin-top: 13px;
        }
        .container-contact {
            padding: 0px 0px;
        }
    }
    .container-volver{
        display: none;
    }
</style>
<div class="row colormenu">
  <div class="col-12">
        <?php include 'menu-home.php'; ?>
  </div>
</div>
<div class="container container-volver">
    <a href="<?php echo base_url(); ?>">
        <button class="btn btn-primary">Volver</button>
    </a>
</div>
<div class="container-contact">
    <form autocomplete="off" action="<?php echo site_url('contact/add'); ?>" method="post" role="form">
    <div class="contact-box">
        <div id="left" style="background: url(<?php echo base_url().'assets/frontend/images/frontend/contact-img.jpg' ?>); "></div>
        <div class="right">
            <h2>Contáctanos!</h2>
            <input type="text" name="name" class="field" placeholder="Nombre y apellido" required="">
            <input type="email" name="email" class="field" placeholder="Correo electr贸nico" required="">
            <textarea placeholder="Mensaje" name="message" class="field" required=""></textarea>
            <button class="btn-form" type="submit">Enviar</button>
        </div>
    </div>
    </form>
</div>








