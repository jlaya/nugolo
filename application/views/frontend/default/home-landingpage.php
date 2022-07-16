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
            font-family: "GameOfSquids" !important;
            color: #FFF !important;
            font-weight: bold !important;
            border: none !important; 
            background-color: transparent !important;
            cursor: pointer !important;
        }
        .color-FFF:hover{
            font-family: "GameOfSquids" !important;
            color: #FFF !important;
            font-weight: bold !important;
            border: none !important; 
            background-color: transparent !important;
            cursor: pointer !important;
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
        
        .container {
            /*display:inline-block;*/
            width: 100vw;
        }
 
 
 
                     .cielo-1 {
                      width: 100vw;
                      height: 400vh;
                      background: transparent;
                      position: absolute;
                      -webkit-animation: animaCielo 15s linear infinite backwards running;
                      -moz-animation: animaCielo 15s linear infinite backwards running;
                      -ms-animation: animaCielo 15s linear infinite backwards running;
                      animation: animaCielo 15s linear infinite backwards running;
                      z-index: -5;
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
                      z-index: -5;
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
    
   
</head>
<body style="background: linear-gradient(338deg, #00205b, #37163b);">
        
        <div style="position: revert;;"> 
        <div class="cielo-2"></div>
        <div class="cielo-1"></div>
    </div>
    
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
    <!-- Estructura 1 -->
    <div class="container">
      <div class="row">
        <div class="w-100 text-center">
          <img src="https://i.ibb.co/R0zYZHR/logo.png" width="300px" height="80px" alt="nugolo escuela matematica">
        </div>
      </div>
    </div>
    <!-- Estructura 2 -->
    <div class="container mt-5">
      <div class="row">
        <div class="w-100 text-center">
          <div class="container">
              <div class="row">
                <div class="col">
                  <a href="<?php echo base_url('home/courses');?>">
                    <button class="color-FFF ">CURSOS</button>
                  </a>
                </div>
                <div class="col">
                  <a href="<?php echo base_url('registro');?>">
                    <button class="color-571894 ">SIGN UP</button>
                  </a>
                </div>
                <div class="col">
                  <a href="<?php echo base_url('login');?>">
                    <button class="color-571894 ">LOGIN</button>
                  </a>
                </div>
                <div class="col">
                  <a href="<?php echo base_url('contact');?>">
                    
                      <button class="color-FFF ">CONTACTANOS</button>
                  </a>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
    <!-- Estructura 3 -->
    <div class="container mt-5">
      <div class="row">
        <div class="w-100 text-center">
          <h1 class="h1-font ">DESAROLLA TU <br> APRENDIZAJE RAPIDO Y FACIL</h1>
        </div>
      </div>
    </div>
    <!-- Estructura 4 -->
    <div class="container">
      <div class="row">
        <div class="w-100 text-center">
          <img style="width: 100%;" src=https://i.ibb.co/fHnLCkj/3163-Convertido.png">
        </div>
      </div>
    </div>
    <br><br>
    <!-- Estructura 5 -->
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 col-md-6 text-center">
            <img style="width: 50%;" src="https://i.ibb.co/SdCVbqV/3172.png">
        </div>
        <div class="col-12 col-md-6"><h3 class="h3-font ">TE GUIAREMOS POR LA MEJOR RUTA PARA UN APRENDIZAJE SEGURO</h3></div>
      </div>
    </div>
    <!-- Estructura 6 -->
    <div class="container" hidden="">
      <div class="row">
        <div class="w-100 text-center" style="height: 300px;">
          &nbsp;
        </div>
      </div>
    </div>
    <br><br><br>
    <!-- Estructura 7 -->
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6"><h3 class="h3-font">TENDRAS UN TUTOR QUE TE <br> GUIARA EN TODO TU PROCESO <br> DE APRENDIZAJE</h3></div>
        <div class="col-12 col-md-6 text-center">
            <img style="width: 70%;" src="https://i.ibb.co/WnHxsRy/profevirtual.png">
        </div>
      </div>
    </div>
    <br><br><br>
    <!-- Estructura 8 -->
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 col-md-12 text-center"><h3 class="h3-font">PERSONALIZA TU PROPIO AVATAR</h3></div>
        <div class="col-12 col-md-12 text-center" style="background-image: url('https://i.ibb.co/TrvY7Sw/avatar.png');background-repeat: no-repeat;background-position:center;background-size: 50%">
            <br><br><br>
            <button class="mt-5 button-1">COOMING SOON</button> 
            <br><br><br>
            <br><br><br>
        </div>
      </div>
    </div>
    <!-- Estructura 9 -->
    <br><br><br>
    <div class="container">
      <div class="row">
        <div class="w-100 text-center">
          <a class="color-FFF" href="home/terms">
            Terminos y condiciones | Nugolo &copy; <?php echo date('Y')?>
          </a>
        </div>
      </div>
    </div>
    <br><br><br>
</body>
</html>
