<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cursos</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/api-video/css/demo.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/api-video/css/font-awesome.min.css') ?>">
  <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/api-video/css/shCoreDefault.css') ?>"/>

  <style type="text/css">

    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    .text-loading-course-video{font-family: 'Poppins';}
    .course-text-content{font-family: 'Poppins'; letter-spacing: 1px;background: transparent !important;color: #48668e;box-shadow: 3px 3px 5px -1px #48668e;}
    @media (max-width: 991.98px) { .main-loading-course{width: 100% !important;}}

    .main-course-content{
      width: 100%;
      padding-right: 15px;
      padding-left: 15px;
      margin-right: auto;
      margin-left: auto;
    }
    /* Style the buttons that are used to open and close the accordion panel */
    .accordion {
      background-color: #eee;
      color: #444;
      cursor: pointer;
      padding: 18px;
      width: 100%;
      text-align: left;
      border: none;
      outline: none;
      transition: 0.4s;
    }

    /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
    .active, .accordion:hover {
      background-color: #ccc;
    }

    .panel-semanas-curso button{
      margin: 0 10px;
    }

    #container {
      margin: 0 auto;
      width: 460px;
      padding: 2em;
    }

    .ui-progress-bar {
     margin-top: 3em;
     margin-bottom: 3em;
    }

    .ui-progress span.ui-label {
     font-size: 1.2em;
     position: absolute;
     right: 0;
     line-height: 33px;
     padding-right: 12px;
     color: rgba(0,0,0,0.6);
     text-shadow: rgba(255,255,255, 0.45) 0 1px 0px;
     white-space: nowrap;
    }

    @-webkit-keyframes animate-stripes {
     from {
     background-position: 0 0;
     }

     to {
     background-position: 44px 0;
     }

    }
    .ui-progress-bar {
     position: relative;
     height: 35px;
     padding-right: 2px;
     background-color: #abb2bc;
     border-radius: 35px;
     -moz-border-radius: 35px;
     -webkit-border-radius: 35px;
     background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #b6bcc6), color-stop(1, #9da5b0));
     background: -moz-linear-gradient(#9da5b0 0%, #b6bcc6 100%);
     -webkit-box-shadow: inset 0px 1px 2px 0px rgba(0, 0, 0, 0.5), 0px 1px 0px 0px #FFF;
     -moz-box-shadow: inset 0px 1px 2px 0px rgba(0, 0, 0, 0.5), 0px 1px 0px 0px #FFF;
     box-shadow: inset 0px 1px 2px 0px rgba(0, 0, 0, 0.5), 0px 1px 0px 0px #FFF;
    }

    .button-send{
      padding: 7px 32px !important; 
      border-radius: 4px !important; 
      font-size: 16px !important;
    }

    .ui-progress {
     position: relative;
     display: block;
     overflow: hidden;
     height: 33px;
     -moz-border-radius: 35px;
     -webkit-border-radius: 35px;
     border-radius: 35px;
     -webkit-background-size: 44px 44px;
     background-color: #74d04c;
     background: -webkit-gradient(linear, 0 0, 44 44, color-stop(0.00, rgba(255,255,255,0.17)), color-stop(0.25, rgba(255,255,255,0.17)), color-stop(0.26, rgba(255,255,255,0)), color-stop(0.50, rgba(255,255,255,0)), color-stop(0.51, rgba(255,255,255,0.17)), color-stop(0.75, rgba(255,255,255,0.17)), color-stop(0.76, rgba(255,255,255,0)), color-stop(1.00, rgba(255,255,255,0)) ), -webkit-gradient(linear, left bottom, left top, color-stop(0, #74d04c), color-stop(1, #9bdd62));
     background: -moz-repeating-linear-gradient(top left -30deg, rgba(255,255,255,0.17), rgba(255,255,255,0.17) 15px, rgba(255,255,255,0) 15px, rgba(255,255,255,0) 30px ), -moz-linear-gradient(#9bdd62 0%, #74d04c 100%);
     -webkit-box-shadow: inset 0px 1px 0px 0px #dbf383, inset 0px -1px 1px #58c43a;
     -moz-box-shadow: inset 0px 1px 0px 0px #dbf383, inset 0px -1px 1px #58c43a;
     box-shadow: inset 0px 1px 0px 0px #dbf383, inset 0px -1px 1px #58c43a;
     border: 1px solid #4c8932;
     -webkit-animation: animate-stripes 2s linear infinite;
    }
    .btn:disabled {
        opacity: .65;
        background-color: #17a2b8 !important;
    }
  </style>
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
        
        .container {
            display:inline-block;
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

        body {
            font-family: 'Open Sans', sans-serif !important;
            font-size: 15px;
        }
    </style>
    
    <style type="text/css">
      .content{
        width: 100%;
        height: auto;
        margin: -16% 0% 0% 0%;
      }
      .nav-pills{
        width: 100%;
      }
      .nav-item{
        width: auto;
      }
      .nav-pills .nav-link{
        font-weight: bold;
        padding-top: 13px;
        text-align: center;
        background: #343436;
        color: #fff;
        border-radius: 30px;
        height: 100px;
      }
      .nav-pills .nav-link.active{
        background: #ad7dfd !important;
        color: #000;
      }
      .tab-content{
        position: absolute;
        width: 100%;
        height: auto;
        margin-top: -50px;
        background: #fff;
        color: #000;
        border-radius: 30px;
        z-index: 1000;
        box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.4);
        padding: 30px;
        margin-bottom: 50px;
      }
      .tab-content button{
        border-radius: 15px;
        width: 100%;
        margin: 0 auto;
        float: right;
      }
      .active, .accordion:hover {
          background-color: transparent;
      }
    </style>
</head>
<body style="color: #fff;background: linear-gradient(338deg, #00205b, #37163b);">

<section class="course-content-area" style="min-height: 100vh;">
  <div class="main-course-content">
    <div class="row">
      <div class="col-lg-7">
        <br>
        <div class="about-instructor-box">
            <!-- BORRAR ESTO -->
            <span style="color: red;" class="mensaje"></span>

            <div hidden="" class="about-instructor-title">
                + Videos
            </div>
            <form action="<?php echo base_url('document/save'); ?>" enctype="multipart/form-data" method="POST">
              <input type="hidden" name="course_id" value="<?php echo $this->input->get('course_id'); ?>">
              <?php if( count($verify) == 0 ){ ?>
              <input type="file" name="doc" required="">
              <input type="submit" value="Adjuntar" class="btn btn-primary">
              <?php } ?>
              <a href="<?php echo $this->session->userdata('url'); ?>">
                <button style="cursor: pointer;" type="button">Volver</button>
              </a>
            </form>
        </div>
      </div>

      <div class="col-lg-5">
        <?php
          if( isset($obj[0]->doc) && $obj[0]->doc !="" ){
            $file = $obj[0]->doc;
          }else{
            $file = "";
          }
        ?>
        <?php if( $file !="" ){ ?>
          <iframe src="<?php echo base_url($file); ?>" width="100%" height="680px"></iframe>
        <?php } ?>
      </div>
    </div>
  </div>
</section>
</body>
</html>