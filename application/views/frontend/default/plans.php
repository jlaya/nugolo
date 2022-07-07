<?php include 'pixel-facebook.php';?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/custom-plans.css'); ?>">


<div id="intro" class=""></div>  <!-- background -->


<div class="container section bg-" style="min-height: calc(100vh - 65px - 87px );
">
    <div class="row align-items-center">
        <div class="col-md-6 col-4k-12" style="background: ;">
            <div class="pricing-table" >
                <div class="pricing-card">
                    <h3 class="pricing-card-header">Plan de entrenamiento</h3>
                    <div class="price"><sup>$</sup><?php echo config_item("precio_plans"); ?><span>/mes</span>
                        <p class="text-right" style="font-family: 'Montserrat'; font-weight: bold !important; font-size: 0.7rem; letter-spacing: 0; color: #000; margin-top: -2em; margin-right: 3.8em;"> <small style="font-weight: 400;">* con el 50% de descuento</small>  </p>
                    </div>
                    <ul style="text-decoration: none; list-style: none; padding: 0;">
                        <li>Plan de ejercicios por niveles adaptado a cada persona</li>
                        <li>Comunicación constante y directa con los instructores en la plataforma</li>
                        <li>Consultas de psicología deportiva</li>
                        <li>Consejos y recomendaciones con un fisioterapeuta</li>
                    </ul>
                    <p class="text-left" style="color: #000; font-size: 0.8em; font-family: 'Montserrat'; margin: 0.8em 1.6em; line-height: 0.8;"><small style="font-weight: 400">* Términos de descuento aplican solamente los primeros dos meses durante nuestro lanzamiento</small>  </p>
                    <a data-toggle="modal" data-target="#signUpModal" class="order-btn button-pay">PAGAR</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-4k-12 text-center" style="background: ; ">
            <iframe id="frame-plan" width="400em" height="300em" src="<?php echo config_item("video_plans"); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
        </div>
    </div>
</div>
    














