

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="<?php echo base_url().'assets/frontend/landingpage/normalize.min.css'; ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().'assets/frontend/landingpage/styles.css'; ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().'assets/frontend/landingpage/toastr.css'; ?>" rel="stylesheet" type="text/css" />
      <style type="text/css">
         #msform fieldset {
            background: #292f45 !important;
            border: 0 none;
            border-radius: 3px;
            box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
            padding: 20px 30px;
            box-sizing: border-box;
            width: 80%;
            margin: 0 10%;
            position: absolute;
        }

        #msform input, #msform textarea {
            padding: 15px;
            border: 1px solid #1f53c5 !important;
            border-radius: 3px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #989da3 !important;
            font-size: 13px;
            background-color: #FFF !important;
        }

        button, input, optgroup, select, textarea {
            font-family: sans-serif;
            font-size: 100%;
            line-height: 1.15;
            margin: 0;
            height: 48.95px !important;
            border: 1px solid #1f53c5 !important;
            background-color: #FFF !important;
            color: #585d6d !important;
        }

        #msform .action-button {
            width: 100px;
            background: #1f53c5 !important;
            font-weight: bold;
            color: white !important;
            border: 0 none;
            border-radius: 1px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }

        .fs-title {
            font-size: 15px;
            text-transform: uppercase;
            color: white !important;
            margin-bottom: 10px;
        }

         .form-register {
         top: -25%;
         right: 10%;
         position: fixed;
         width: 320px;
         height: 310px;
         background: transparent !important;
         padding: 30px;
         margin: auto;
         margin-top: auto;
         margin-top: 100px;
         border-radius: 4px;
         font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
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
         background: url('http://thecodeplayer.com/uploads/media/gs.png');
         /*background = gradient + image pattern combo*/
         background: 
         linear-gradient(rgba(196, 102, 0, 0.2), rgba(155, 89, 182, 0.2)), 
         url('http://thecodeplayer.com/uploads/media/gs.png');
         }
         body {
         font-family: montserrat, arial, verdana;
         }
         /*form styles*/
         #msform {
         width: 400px;
         margin: 50px auto;
         text-align: center;
         position: relative;
         }
         #msform fieldset {
         background: white;
         border: 0 none;
         border-radius: 3px;
         box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
         padding: 20px 30px;
         box-sizing: border-box;
         width: 80%;
         margin: 0 10%;
         /*stacking fieldsets above each other*/
         position: absolute;
         }
         /*Hide all except first fieldset*/
         #msform fieldset:not(:first-of-type) {
         display: none;
         }
         /*inputs*/
         #msform input, #msform textarea {
         padding: 15px;
         border: 1px solid #ccc;
         border-radius: 3px;
         margin-bottom: 10px;
         width: 100%;
         box-sizing: border-box;
         font-family: montserrat;
         color: #2C3E50;
         font-size: 13px;
         }
         /*buttons*/
         #msform .action-button {
         width: 100px;
         background: #27AE60;
         font-weight: bold;
         color: white;
         border: 0 none;
         border-radius: 1px;
         cursor: pointer;
         padding: 10px 5px;
         margin: 10px 5px;
         }
         #msform .action-button:hover, #msform .action-button:focus {
         box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
         }
         /*headings*/
         .fs-title {
         font-size: 15px;
         text-transform: uppercase;
         color: #2C3E50;
         margin-bottom: 10px;
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

      </style>
      <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
         rel="stylesheet"> -->
      <script src="funciones.js"></script>
      <title>Registro</title>
   </head>
   <body >
      <div id="fullscreen">
         <img src="<?php echo base_url().'assets/frontend/landingpage/images/background.jpg'; ?>" alt="">
      </div>
      <div id="cajaprincipal" >
         <div id="logo">
            <img src="<?php echo base_url().'assets/frontend/landingpage/images/logo-gym.png'; ?>" alt="ironman" width="150px" >
         </div>
         <nav hidden="" >
            <ul class="menu">
               <li><a href="#!">Home</a></li>
               <li><a href="#!">About</a></li>
               <li><a href="<?php echo base_url('login'); ?>">Iniciar</a></li>
            </ul>
         </nav>
      </div>
      <div id="segundacaja">
         <img src="<?php echo base_url().'assets/frontend/landingpage/images/Image@4x.png'; ?>"  width="50%">
         <section class="form-register" style="background-color: #292f45;">
            <!-- multistep form -->
            <form id="msform" method="POST" action="<?php echo base_url('users/add'); ?>">
               <!-- progressbar -->
               <ul id="progressbar">
                  <li class="active">Cuenta Usuario</li>
                  <li>Valoraci&oacute;n</li>
                  <li>Video</li>
               </ul>
               <!-- fieldsets -->
               <fieldset>
                  <h2 class="fs-title">Registro</h2>
                  <select required="" style="width: 100%;margin-top: 1%;" name="city">
                    <option value="" selected="selected">Ciudad</option>
                    <option value="Bogotá">Bogotá</option>
                    <option value="Medellin">Medellin</option>
                    <option value="Cali">Cali</option>
                    <option value="Barranquilla">Barranquilla</option>
                    <option value="Cartagena">Cartagena</option>
                    <option value="Cúcuta">Cúcuta</option>
                    <option value="Bucaramanga">Bucaramanga</option>
                    <option value="Villavicencio">Villavicencio</option>
                    <option value="Ibague">Ibague</option>
                    <option value="Santa Marta">Santa Marta</option>
                    <option value="Valledupar">Valledupar</option>
                    <option value="Caldas">Caldas</option>
                    <option value="Risaralda">Risaralda</option>
                    <option value="Huila">Huila</option>
                    <option value="Nariño">Nariño</option>
                    <option value="Neiva">Neiva</option>
                    <option value="Bello">Bello</option>
                    <option value="Manizales">Manizales</option>
                  </select>
                  <input style="margin-top: 4%;" required="" type="text" name="first_name" placeholder="Nombre" />
                  <input required="" type="text" name="last_name" placeholder="Apellido" />
                  <input required="" type="text" name="email" placeholder="Ingrese su E-mail" />
                  <input required="" type="text" name="phone" placeholder="Tel&eacute;fono" />
                  <input required="" type="text" name="address" placeholder="Dirección" />
                  <input required="" type="password" name="password" placeholder="Ingrese su contrase&ntilde;a" />
                  <input type="button" name="next" class="next action-button" value="Siguiente" />
               </fieldset>
               <!-- Valoracion I -->
               <fieldset>
                  <h2 class="fs-title">Valoraci&oacute;n I</h2>
                  <select required="" name="gender" style="width: 100%;margin-top: 1%;">
                    <option value="">G&eacute;nero</option>
                    <option value="male">Masculino</option>
                    <option value="female">Femenino</option>
                  </select>
                  <input required="" name="age" type="text" placeholder="Edad" style="margin-top: 4%" />
                  <input required="" name="contact" type="text" placeholder="Contacto (correo y/o n&eacute;mero)" />
                  <input required="" name="weighing" type="text" placeholder="Peso (Kg)" />
                  <input required="" name="stature" type="text" placeholder="Estatura (cm)" />
                  <input type="button" name="previous" class="previous action-button" value="Anterior" />
                  <input type="button" name="next" class="next action-button" value="Siguiente" />
               </fieldset>
               <!-- Valoracion II -->
               <fieldset>
                  <h2 class="fs-title">Valoraci&oacute;n II</h2>
                  <select required="" name="type_activity" style="width: 100%;margin-top: 1%;">
                    <option value="">Actividad F&iacute;sica</option>
                    <option value="Crossfit">Crossfit</option>
                    <option value="Running">Running</option>
                    <option value="Cycling">Cycling</option>
                    <option value="Yoga">Yoga</option>
                    <option value="Pilates">Pilates</option>
                    <option value="Combat">Combat</option>
                    <option value="Dance">Dance</option>
                    <option value="Group fitness">Group fitness</option>
                  </select>
                  <select required="" name="frequency" style="width: 100%;margin-top: 4%;">
                    <option value="">Frecuencia</option>
                    <option value="1 vez por semana">1 vez por semana</option>
                    <option value="2 vez por semana">2 vez por semana</option>
                    <option value="3 vez por semana">3 vez por semana</option>
                    <option value="m&aacute;s de 4 veces por semana">M&aacute;s de 4 veces por semana</option>
                  </select>
                  <select required="" name="schedule" style="width: 100%;margin-top: 6%;">
                    <option value="">Horario</option>
                    <optgroup label="Ma&ntilde;ana">
                        <option value="6 a.m">6 a.m</option>
                        <option value="7 a.m">7 a.m</option>
                        <option value="8 a.m">8 a.m</option>
                    </optgroup>
                    <optgroup label="Tarde">
                        <option value="5 p.m">5 p.m</option>
                        <option value="6 p.m">6 p.m</option>
                        <option value="7 p.m">7 p.m</option>
                        <option value="8 p.m">8 p.m</option>
                    </optgroup>
                  </select>
                  <select required="" id="category_id" name="category_id" style="width: 100%;margin-top: 6%;">
                    <option value="">Especifique su patologia o escriba ninguna:</option>
                    <?php foreach ($category as $key => $value) { ?>
                      <option value="<?php echo $value->id; ?>">
                        <?php echo $value->name; ?>
                      </option>
                    <?php } ?>
                  </select>
                  <textarea required="" id="pathology" name="pathology" placeholder="Especifique su patolog&iacute;a" style="width: 100%;margin-top: 6%;"></textarea>
                  <input type="button" name="previous" class="previous action-button" value="Anterior" />
                  <input type="button" name="next" class="next action-button" value="Siguiente" />
               </fieldset>
               <fieldset>
                  <h2 class="fs-title">Video de muestra</h2>
                  <select required="" id="pay" name="pay" style="width: 100%;margin-top: 4%;">
                    <option value="">Pagar</option>
                    <option value="0">No</option>
                    <option value="1">Si</option>
                  </select>
                  <br>
                  <br>
                  <div class="show-panel-epayco" style="display: none;">
                    <!-- Seccion de pago -->
                    <h2 class="fs-title">Datos de pago</h2>
                    <div class="form-group"/>
                        <input required="" class="field-pay" type="text" name="doc_number" placeholder="Número de documento">
                    </div/>
                    <div class="form-group"/>
                        <input required="" class="field-pay" type="text" name="number_card" placeholder="Número de tarjeta de crédito">
                    </div/>
                    <div class="form-group"/>
                        <input required="" class="field-pay" type="text" size="4" name="cvc" placeholder="CVC">
                    </div/>
                    <div class="form-group"/>
                        <input required="" class="field-pay" type="text" name="exp_month" placeholder="Mes de expiración(MM)">
                        <input required="" class="field-pay" type="text" name="exp_year" placeholder="Año de expiración(AAAA)">
                    </div/>
                  </div>
                  <input type="button" name="previous" class="previous action-button" value="Anterior" />
                  <input type="submit" class="submit action-button" value="Enviar" onclick="return confirm_send('&#191;Esta usted de acuerdo de enviar los datos&#63;, aseg&uacute;rece de revisar la informaci&oacute;n.')" />
               </fieldset>
            </form>
         </section>
         <!-- jQuery -->
         <script src="<?php echo base_url().'assets/frontend/landingpage/jquery-1.9.1.min.js'; ?>" type="text/javascript"></script>
         <!-- jQuery easing plugin -->
         <script src="<?php echo base_url().'assets/frontend/landingpage/jquery.easing.min.js'; ?>" type="text/javascript"></script>

         <script type="text/javascript">
           
           /**
           * @param String name
           * @return String
           */
            function getParameterByName(name) {
                name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
                return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            $('#pay').change(function(){

              var pay = $(this).val();

              if( pay == 1 ){
                $(".field-pay").val('');
                $(".show-panel-epayco").show(1000);
              }else{
                $(".field-pay").val(0);
                $(".show-panel-epayco").hide(1000);
              }

            });

         </script>

         <script type="text/javascript">

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
         <script type="text/javascript">
           function confirm_send(question) {

              if(confirm(question)){

                 toastr.success('Aun no se ha enviado ninguna informaci&oacute;n, verifique los campos obligatorios.');

              }else{
                return false;  
              }

            }
         </script>
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
      </div>
   </body>
</html>

