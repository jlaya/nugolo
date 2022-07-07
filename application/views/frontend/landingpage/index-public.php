<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="keywords" content="HTML5 Template" />
      <meta name="description" content="Neon - Admin template" />
      <meta name="author" content="Creativeitem" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <link name="favicon" type="image/x-icon" href="<?php echo base_url().'assets/favicon.ico' ?>" rel="shortcut icon" />
    <title>Nugolo</title>
      <link href="<?php echo base_url().'assets/frontend/landingpage/toastr.css'; ?>" rel="stylesheet" type="text/css" />
      <?php #include 'icon-whatsapp.php'; ?>
      <!--<script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
      <style type="text/css">

      #segundacaja{
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
      }

      #msform {
         position: absolute;
         top:0;
         left:0;
         width:100%;
         height: 100%;
         /* width: 25em !important;
         margin: 3.125em -4.6875em !important;
         text-align: center;
         position: relative; */
      }
      /* @media (max-width: 520px) and (min-width:1px) {
         #msform {
         letter-spacing: 0.2em;
         font-family: 'arial';
         width: 20em !important;
         margin: 2.5em 0px !important;
         text-align: center;
         position: relative; 
         }
         
      } */
      /*  */
         #msform fieldset {
         background: #292f45 !important;
         /*display: flex;*/
         border: 0 none;
         border-radius: 3px;
         box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
         padding: 20px 30px;
         box-sizing: border-box;
         width: 100%;
         height: 36.25rem;
         /* margin: 0% 0% 0% 16% ; */
         position: absolute;
         }

         #msform input, #msform textarea {
         padding: 15px;
         border: 1px solid #1f53c5 !important;
         border-radius: 3px;
         margin-bottom: 10px;
         width: 100%;
         box-sizing: border-box;
         font-family: 'arial';
         color: #2c333e !important;
         font-size: 13px;
         background-color: #FFF !important;
         }
         button, input, optgroup, select, textarea {
         font-family: 'arial';
         font-size: 100%;
         line-height: 1.15;
         margin: 0;
         height: 48.95px !important;
         border: 1px solid #1f53c5 !important;
         background-color: #FFF !important;
         color: #2c333e !important;
         }
         #msform .action-button {
         margin-top: 20px;
         width: 100px;
         margin-left: auto;
         margin-right: auto;
         background: #1f53c5 !important;
         font-weight: bold;
         color: white !important;
         border: 0 none;
         border-radius: 1px;
         cursor: pointer;
         padding: 10px 5px;
         }
    
         .form-register {
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         /* top: -25%;
         right: 10%;
         position: fixed; */
         /* width: 320px;
         height: 310px; */
         background: transparent !important;
         /* padding: 30px;
         margin: auto;
         margin-top: auto;
         margin-top: 100px; */
         border-radius: 4px;
         font-family: 'arial';
         color: white;
         box-shadow: none;
         }
         /*custom font*/
         @import url(http://fonts.googleapis.com/css?family=Montserrat);
         /*basic reset*/
         * {margin: 0; padding: 0;}
         html {
         height: 100%;
         /*Image only BG fallback*/
         /*background: url('http://thecodeplayer.com/uploads/media/gs.png');*/
         /*background = gradient + image pattern combo*/
         /*background: 
         linear-gradient(rgba(196, 102, 0, 0.2), rgba(155, 89, 182, 0.2)), 
         url('http://thecodeplayer.com/uploads/media/gs.png');*/
         }
         body {
         font-family: montserrat, arial, verdana;
         }
         /*Hide all except first fieldset*/
         #msform fieldset:not(:first-of-type) {
         display: none;
         }
         /*inputs*/
         
         /*buttons*/
        
         #msform .action-button:hover, #msform .action-button:focus {
         box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
         }
         /*headings*/
         .fs-title {
         font-family: 'Arial';
         display: flex;
         justify-content: center;
         font-size: 15px;
         margin-left: auto;
         margin-right: auto;
         letter-spacing: 0.5em;
         text-transform: uppercase;
         color: #fff;
         margin-bottom: 20px;
         }
         .fs-subtitle {
         font-weight: normal;
         font-size: 13px;
         color: #666;
         margin-bottom: 20px;
         }
         /*progressbar*/
         #progressbar {
         margin-bottom: 30px;
         overflow: hidden;
         /*CSS counters to number the steps*/
         counter-reset: step;
         }
         #progressbar li {
         list-style-type: none;
         color: white;
         text-transform: uppercase;
         font-size: 9px;
         width: 33.33%;
         float: left;
         position: relative;
         }
         #progressbar li:before {
         content: counter(step);
         counter-increment: step;
         width: 20px;
         line-height: 20px;
         display: block;
         font-size: 10px;
         color: #333;
         background: white;
         border-radius: 3px;
         margin: 0 auto 5px auto;
         }
         /*progressbar connectors*/
         #progressbar li:after {
         content: '';
         width: 100%;
         height: 2px;
         background: white;
         position: absolute;
         left: -50%;
         top: 9px;
         z-index: -1; /*put it behind the numbers*/
         }
         #progressbar li:first-child:after {
         /*connector not needed before the first step*/
         content: none; 
         }
         /*marking active/completed steps green*/
         /*The number of the step and the connector before it = green*/
         #progressbar li.active:before,  #progressbar li.active:after{
         background: #27AE60;
         color: white;
         }
         #logo img {
         display: inline-block;
         padding: 10px;
         margin-left: 42%;
         width: 8% !important;
         }
         #progressbar {
         margin-bottom: 30px;
         overflow: hidden;
         counter-reset: step;
         display: none !important;
         }
         
         
        
      
      </style>
   </head>
   <body>
      <div id="segundacaja">
         <section class="form-register">
            <!-- multistep form -->
            <form id="msform" method="POST" action="<?php echo base_url('users/add'); ?>">
              <input type="hidden" name="uri_string" value="<?php echo $this->input->get('uri_string'); ?>">
               <!-- progressbar -->
               <ul id="progressbar">
                  <li class="active">Cuenta Usuario</li>
                  <li>Valoraci&oacute;n</li>
                  <li>Video</li>
               </ul>
               <!-- fieldsets -->
               <fieldset>
                  <h2 class="fs-title">Registro</h2>
                  <select required="" style="width: 100%;margin-top: 1%;padding: 0px 8px;" id="nivel" name="nivel">
                     <option value="" selected="selected">Grado (escolar)</option>
                     <?php foreach (range(1, 11) as $key => $value) { ?>
                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                     <?php } ?>
                  </select>
                   <input type="hidden" name="depart" value="0">
                   <input type="hidden" name="city" value="0">
                  <input style="margin-top: 4%;" required="" type="text" name="first_name" placeholder="Nombre" />
                  <input required="" type="text" name="last_name" placeholder="Apellido" />
                  <input required="" type="text" name="email" placeholder="Correo electrónico" />
                  <input required="" type="date" name="date_nac" placeholder="Fecha de nacimiento" />
                  <input required="" type="hidden" name="phone" placeholder="Tel&eacute;fono" value="0" />
                  <input required="" type="hidden" name="address" placeholder="Dirección" value="0" />
                  <input required="" type="password" name="password" placeholder="Ingrese su contrase&ntilde;a" />
                  <input type="submit" class="submit action-button send-register_1" value="Enviar"/>
               </fieldset>
            </form>
         </section>
         <section class="form-register form-register-whatsapp" style="display: none;">
            <div style="background-color: brown;padding: 2%;">
               Recuerde hacer el pago y enviarnos su comprobante de pago para ser activado en nuestra plataforma.
            </div>
            <br>
            <a target="_blank" href="https://wa.me/573014701404?text=Hola!%20Estoy%20interesado%20en%20tu%20servicio">
               <div align="center">
                  <img title="Whatsapp" class="btn-whatsapp" src="<?php echo base_url('assets/icon-cliente.png'); ?>" width="400" height="400" alt="Whatsapp" style="margin: auto;">
               </div>
            </a>
         </section>
      </div>
   </body>
</html>

<!-- jQuery -->
<script src="<?php echo base_url().'assets/frontend/landingpage/jquery-1.9.1.min.js'; ?>" type="text/javascript"></script>
<!-- jQuery easing plugin -->
<script src="<?php echo base_url().'assets/frontend/landingpage/jquery.easing.min.js'; ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/backend/js/toastr.js'); ?>"></script>
<!-- SHOW TOASTR NOTIFIVATION -->
<?php if ($this->session->flashdata('flash_message') != ""):?>
<script type="text/javascript">
   toastr.success('<?php echo $this->session->flashdata("flash_message");?>');
</script>
<?php endif;?>
<?php if ($this->session->flashdata('error_message') != ""):?>
<script type="text/javascript">
   toastr.error('<?php echo $this->session->flashdata("error_message");?>');
</script>
<?php endif;?>
<script type="text/javascript">

   var param_pay = '<?php echo $_GET["pay"]; ?>';

   if( param_pay == 1 ){
      $(".form-register").hide();
      $(".form-register-whatsapp").show();
   }else{
      $(".form-register").show();
      $(".form-register-whatsapp").hide();
   }
   
   // Se verifica si se encuentra aceptada una transaccion
   var ref_payco = "<?php echo $ref_payco; ?>";
   var urlapp = "https://api.secure.payco.co/validation/v1/reference/" + ref_payco;

   // Captura de los datos en el formulario
   var load_data_form = function(){
      var forms_data = $("#msform").serialize();
      //se utiliza $.ajax(), a la cual se le pasa un objeto {}, con la información
      $.ajax({
          type:"POST", // la variable type guarda el tipo de la peticion GET,POST,..
          url:"<?php echo base_url('Confirmation/get_data_users'); ?>", //url guarda la ruta hacia donde se hace la peticion
          data: forms_data, // data recive un objeto con la informacion que se enviara al servidor
          success:function(datos){

           },
          dataType: 'json' // El tipo de datos esperados del servidor. Valor predeterminado: Intelligent Guess (xml, json, script, text, html).
      });
   }

   $('#depart').change(function() {
        var cod = $(this).val();
        $.ajax({
            type:'POST',
            dataType: 'json',
            url: '<?php echo base_url('User/provincia_ciudad'); ?>',
            data:{
              'cod': cod
            },
            success:function(o){
                var option = "";
                $('#city').find('option:not(:first)').remove();
                $.each( o, function( key, value ) {
                  //alert( key + ": " + value.city );
                  option += "<option value='"+value.city+"'>"+value.city+"</option>";
                });

                $("#city").append(option);
            },error:function(r) {

            }
        });

      })

   

   $('#pay-1').change(function(){
   
     var pay = $(this).val();
   
     if( pay == 1 ){
       $(".send-register").hide(1000);
       $("#show-button-pay").show(1000);
     }else{
       $(".send-register").show(1000);
       $("#show-button-pay").hide(1000);
     }

     load_data_form();
   
   });
   
   //jQuery time
   var current_fs, next_fs, previous_fs; //fieldsets
   var left, opacity, scale; //fieldset properties which we will animate
   var animating; //flag to prevent quick multi-click glitches
   
   $(".next").click(function(){
   if(animating) return false;
   animating = true;
   
   current_fs = $(this).parent();
   next_fs = $(this).parent().next();
   
   //activate next step on progressbar using the index of next_fs
   $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
   
   //show the next fieldset
   next_fs.show(); 
   //hide the current fieldset with style
   current_fs.animate({opacity: 0}, {
     step: function(now, mx) {
       //as the opacity of current_fs reduces to 0 - stored in "now"
       //1. scale current_fs down to 80%
       scale = 1 - (1 - now) * 0.2;
       //2. bring next_fs from the right(50%)
       left = (now * 50)+"%";
       //3. increase opacity of next_fs to 1 as it moves in
       opacity = 1 - now;
       current_fs.css({'transform': 'scale('+scale+')'});
       next_fs.css({'left': left, 'opacity': opacity});
     }, 
     duration: 800, 
     complete: function(){
       current_fs.hide();
       animating = false;
     }, 
     //this comes from the custom easing plugin
     easing: 'easeInOutBack'
   });
   });
   
   $(".previous").click(function(){
   if(animating) return false;
   animating = true;
   
   current_fs = $(this).parent();
   previous_fs = $(this).parent().prev();
   
   //de-activate current step on progressbar
   $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
   
   //show the previous fieldset
   previous_fs.show(); 
   //hide the current fieldset with style
   current_fs.animate({opacity: 0}, {
     step: function(now, mx) {
       //as the opacity of current_fs reduces to 0 - stored in "now"
       //1. scale previous_fs from 80% to 100%
       scale = 0.8 + (1 - now) * 0.2;
       //2. take current_fs to the right(50%) - from 0%
       left = ((1-now) * 50)+"%";
       //3. increase opacity of previous_fs to 1 as it moves in
       opacity = 1 - now;
       current_fs.css({'left': left});
       previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
     }, 
     duration: 800, 
     complete: function(){
       current_fs.hide();
       animating = false;
     }, 
     //this comes from the custom easing plugin
     easing: 'easeInOutBack'
   });
   });
   
</script>