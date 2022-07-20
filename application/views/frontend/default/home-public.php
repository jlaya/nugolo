<?php
    $user_details = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
    // Conteo de la cantidad de puntuaciones que tenga el usuario
    $wallet = $this->Media_model->wallet();

    // Validacion para el tema de las insignias
    #$count_history_user = $this->Media_model->count_history_user();

    function limitar_cadena($cadena, $limite, $sufijo){
      // Si la longitud es mayor que el límite...
      if(strlen($cadena) > $limite){
      // Entonces corta la cadena y ponle el sufijo
      return substr($cadena, 0, $limite) . $sufijo;
      }
      
      // Si no, entonces devuelve la cadena normal
      return $cadena;
    }

?>
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/custom-home.css'); ?>">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <style type="text/css">
            @font-face {
            
            font-family: "boombox";
            src: url("<?php echo base_url('assets/frontend/fonts/boombox.ttf'); ?>");
            
            font-family: "Bebas-Regular";
            src: url("<?php echo base_url('assets/frontend/fonts/Bebas-Regular.ttf'); ?>");
            
            font-family: "GameOfSquids";
            src: url("<?php echo base_url('assets/frontend/fonts/GameOfSquids.ttf'); ?>");
            }
        .button-1{
            color: #FFF;
            font-weight: bold;
            border-color: #5cdac9;
            background-color: #5cdac9;
        }
        .color-571894{
            width: 140px;
            height: 30px;
            color: #FFF;
            font-weight: bold;
            border: none; 
            background-color: #54178f;
            border-radius: 15px;
            border: 1px solid;
            border-color: #b858fe;
        }
        .color-FFF{
            font-family: "GameOfSquids";
            color: #FFF;
            font-weight: bold;
            border: none; 
            background-color: transparent;
        }
        .color-000{
            font-family: "GameOfSquids";
            color: #000;
            font-weight: bold;
            border: none; 
            background-color: transparent;
        }
        .h1-font{
            color: #FFF;
            font-family: "boombox" !important;
        }.h3-font{
            color: #FFF;
        }

        /* Tipografias 
        .boombox2{
            font-family: "boombox2";
            src: url("<?php echo base_url('assets/frontend/fonts/boombox2.ttf'); ?>");
        }
        .bebas{
            font-family: "Bebas-Regular";
            src: url("<?php echo base_url('assets/frontend/fonts/Bebas-Regular.ttf'); ?>");
        }
        .gameofsquids{
            font-family: "Game Of Squids";
            src: url("<?php echo base_url('assets/frontend/fonts/Game-Of-Squids.ttf'); ?>");
        }
        */
        
        
 
 
 
                     .cielo-1 {
                      width: 100vw;
                      height: 400vh;
                      background: transparent;
                      position: absolute;
                      -webkit-animation: animaCielo 15s linear infinite backwards running;
                      -moz-animation: animaCielo 15s linear infinite backwards running;
                      -ms-animation: animaCielo 15s linear infinite backwards running;
                      animation: animaCielo 15s linear infinite backwards running;
                    }
                    .cielo-1 .estrella {
                      background: #497c95;
                      position: absolute;
                      width: 2px;
                      height: 2px;
                      border-radius: 50%;
                    }
                    
                    .cielo-2 {
                      
                      width: 100%;
                      height: 400%;
                      position: absolute;
                      -webkit-animation: animaCielo 13s linear infinite backwards running;
                      -moz-animation: animaCielo 13s linear infinite backwards running;
                      -ms-animation: animaCielo 13s linear infinite backwards running;
                      animation: animaCielo 13s linear infinite backwards running;
                    }
                    .cielo-2 .estrellaDos {
                      background: #704995;
                      position: absolute;
                      width: 2px;
                      height: 2px;
                      border-radius: 50%;
                    }
                    
                    @-webkit-keyframes animaCielo {
                      0% {
                        top: -100%;
                      }
                      100% {
                        top: 0%;
                      }
                    }
                    @-ms-keyframes animaCielo {
                      0% {
                        top: -100%;
                      }
                      100% {
                        top: 0%;
                      }
                    }
                    @-o-keyframes animaCielo {
                      0% {
                        top: -100%;
                      }
                      100% {
                        top: 0%;
                      }
                    }
                    @-moz-keyframes animaCielo {
                      0% {
                        top: -100%;
                      }
                      100% {
                        top: 0%;
                      }
                    }

    </style>
    <style>
        /* Estilos para motores Webkit y blink (Chrome, Safari, Opera... )*/

        #contenedor::-webkit-scrollbar {
            -webkit-appearance: none;
        }

        #contenedor::-webkit-scrollbar:vertical {
            width:10px;
        }

        #contenedor::-webkit-scrollbar-button:increment,.contenedor::-webkit-scrollbar-button {
            display: none;
        } 

        #contenedor::-webkit-scrollbar:horizontal {
            height: 10px;t
        }

        #contenedor::-webkit-scrollbar-thumb {
            background-color: #d56bff;
            border-radius: 20px;
            
        }

        #contenedor::-webkit-scrollbar-track {
            border-radius: 10px;  
        }

        body{
    font-family: 'Open Sans', sans-serif;
    padding-right: 0 !important;
    color: #29303b;
    font-size: 15px;
}
    </style>
    
   
</head>
<body style="background: linear-gradient(338deg, #00205b, #37163b);">
        
    
    <br><br><br><br>
    <!-- Estructura 7 -->
    <div class="col-auto">
      <div class="m-0 row justify-content-center">
        <div class="">
            <button class="btn btn-default">
              <a style="color: #FFF;" href="<?php echo base_url(); ?>">Volver</a>
            </button>
            <div class="container-fluid row justify-content-center mx-0 px-1">
                <?php
                $latest_courses = $this->crud_model->all_courses();
                foreach ($latest_courses as $latest_course){ ?>
                <?php if( $latest_course['is_free_course'] !=1 ){ ?>
                <div class="mx-3" style="width: 250px;height: 370px;position: relative;overflow: hidden;/* padding: 10px 10px 10px 10px; */display: inline-block;">
                
                
                    <div style="background-color: #57C0C8;width: 250px; height: 300px; position: absolute; top: 50px;border-radius: 8px; display: inline-block;">
            
                    </div>
                    <div style="width: 250px; height: 180px; position: absolute; top: 140px ">
                        <div style="position:relative; text-align: center; padding-top: 20px; ">
                            <H1 style="color: #0D0046; line-height : 1px; font-weight: bold;"><b>&nbsp;</b></H1>
                            <h3 class="h3-margin-1"><?php echo $latest_course['title']; ?></h3>
                            <div class="div-description">
                              <?php echo limitar_cadena($latest_course['short_description'], 50, '...'); ?>
                              </div>
                           </div>
                    </div>
                    <?php 
                      if( $this->session->userdata('user_id') && $latest_course['is_pay'] == 1 ){
                        $color_botton = "#eebe33";
                      }else{
                        $color_botton = "#0D0046";
                      }
                    ?>
                    <div <?php echo $hidden; ?> style="background-color: #0D0046; width: 40%; height: 50px; position: absolute; top: 310px; margin-left: 130px; border-radius: 8px;">
                       <a href="<?php echo site_url('home/lesson/'.slugify($latest_course['title']).'/'.$latest_course['id']); ?>" style="text-decoration: none; color: white ;">  
                       <div style="position:relative; text-align: center; padding-top: 15px; ">
                       <b>PROBAR</b> 
                       </div>
                        </a>
                    </div>
                    <div style="background-color: <?php echo $color_botton; ?>; width: 40%; height: 50px; position: absolute; top: 310px;  border-radius: 8px;  margin-left: 19px;">
                        <a href="<?php echo site_url('home/lesson/'.slugify($latest_course['title']).'/'.$latest_course['id']); ?>" style="text-decoration: none; color: white ;">
                       <div style="position:relative; text-align: center; padding-top: 15px; ">
                        <?php if( $this->session->userdata('user_id') && $latest_course['is_pay'] == 1 ){ ?>
                          Adquirido
                        <?php }else{ ?>
                          Mas detalles
                        <?php } ?>
                       </div>
                        </a>
                    </div>
                    <div style="width: 150px; height: 150px; position: relative; top: 8px;   margin: 0 auto; ">
                        <img src="<?php echo $this->crud_model->get_course_thumbnail_url($latest_course['id']); ?>" alt="" width="150px"  height="150px">
                    </div>
                </div>
                <?php } ?>
                <?php } ?>

            </div>
        </div>
        <div class="col-12 col-md-2 text-center" style="display: none;">
            <div style="color:rgb(42, 22, 99) ; background-color: #A396D1; width:220px; height: 430px; position: absolute;text-align: center; padding: 0px 15px 0px 15px; border-radius: 8px;">
            <p><?php echo $user_details['first_name'].' '.$user_details['last_name']; ?></p>

            <?php
             if (file_exists('uploads/user_image/'.$user_details['id'].'.jpg')): ?>
                <img src="<?php echo base_url().'uploads/user_image/'.$user_details['id'].'.jpg';?>" alt="" width="120px" height="120px">
            <?php else: ?>
                <img src="<?php echo base_url().'uploads/user_image/placeholder.png';?>" alt="" width="120px" height="120px">
            <?php endif; ?>

             <br>
            <b>Nivel:</b> {{level}} &nbsp;&nbsp; <b>Título:</b> <br>
            {{title}}

            <div id="contenedor" style="background-color: #DCD4F8; height: 120px; border-radius: 8px; overflow-y: auto; margin-top: 10px;">
                experiencia <br>
                y logros <br>
                para mostrar
                experiencia <br>
                y logros <br>
                para mostrar
                experiencia <br>
                y logros <br>
                para mostrar
                experiencia <br>
                y logros <br>
                para mostrar
                experiencia <br>
                y logros <br>
                para mostrar
            </div>

            <div id="contenedor" style="background-color: #3A2D65; height: 60px; border-radius: 8px; overflow-x: auto; margin-top: 10px; padding: 8px 0px 0px 0px;">
                <img src="" alt="" width="50px" height="50px">
                <?php #foreach ($count_history_user as $key => $value) { ?>

                <?php #} ?>
            </div>
        </div>
        </div>
      </div>
    </div>
    </div>
    
    <!--<div style="position: revert;;"> 
        <div class="cielo-2"></div>
        <div class="cielo-1"></div>
    </div>-->
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js'></script>
  
  <script>
          for ( i=0 ;  i<500 ;i++)
      {
      var posX = Math.random()*$(window).width();
      var posY = Math.random()*$('.cielo-1').height();
      var alfa = Math.random();
      var estrella = '<div class="estrella"     style="left:'+posX+'px;top:'+posY+'px; opacity:'+alfa+'"></div>';
        
        $('.cielo-1').append(estrella);
      }

      for ( j=0 ;  j<500 ;j++)
      {
      var posLeft = Math.random()*$(window).width();
      var posTop = Math.random()*$('.cielo-2').height();
      var omega = Math.random();
      var estrellaDos = '<div class="estrellaDos" style="left:'+posLeft+'px;top:'+posTop+'px;opacity:'+omega+'"></div>';
                  
        $('.cielo-2').append(estrellaDos);
      }
  </script>
</body>
</html>
