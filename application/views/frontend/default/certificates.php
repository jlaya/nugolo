<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/fonts/font-awesome.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/Article-Clean.css');?>">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/Simple-Slider.css');?>">
    <style type="text/css">
    body {
    background-image: url(https://i.ibb.co/fHnLCkj/3163-Convertido.png\));
    background-position: top;
    background-repeat: no-repeat;
    background-size: cover;
    background-color: #3a0071;
    }
     @font-face {
          
          font-family: "boombox";
          src: url("<?php echo base_url('assets/frontend/fonts/boombox.ttf'); ?>");
          
          font-family: "Bebas-Regular";
          src: url("<?php echo base_url('assets/frontend/fonts/Bebas-Regular.ttf'); ?>");
          
          font-family: "GameOfSquids";
          src: url("<?php echo base_url('assets/frontend/fonts/GameOfSquids.ttf'); ?>");
          }
          
      .message-number{
        margin: -74px 0px 0px 36px;
        color: white;
        font-weight: bold;
        position: absolute;
      }
      .level-number{
        margin: -25px 0px 0px 30px;
        color: white;
        font-weight: bold;
        position: absolute;
      }
      .article-clean {
            color: #56585b;
            background-color: #a396d1 !important;
            font-family: 'Lora', serif;
            font-size: 14px;
        }
      
      
      .col-md-8 {
        display: -webkit-box;
        padding: 55px 5px;
        overflow-x: scroll;
      }
      
      .card {
        background-color: #572c2c3d; box-shadow: inset 0 -6px 30px 0 #eea8f3; color: bisque; backdrop-filter: blur(7px); border: 2px solid rgba(242, 224, 255, 0.76) !important; margin: 0px 1%;
      }
      
      #estilostablamenu {
          font-size: 13px;
      }
      
      .respmenu {
          flex-direction:row !important;
          align-items: center;
          margin-left: auto !important;
          margin-right: auto;
      }
      .navbar-collapse {
        display: flex;
      }
      #mainNav {
          padding-top: 0px !important;
          padding-bottom: 0px !important;
      }
      
      .bg-secondary {
          background-color: #963a99b8 !important;
          backdrop-filter: blur(7px) !important;
          border: 1px solid #ffffff3d !important;
        }
        .coloricono {
          background-color: #fbf8ff !important;
          color: #6610f2 !important;
        }
        /*-------------------------------*/
       /*disenio de botones generales */
        .btn-success {
          color: #fff;
          background-color: #6f1987 !important;
          border-color: #871980 !important;
        }
        
        .btn-primary {
          background-color: #f7ddff !important;
          border-color: #dab2fb !important;
          color: #300659 !important;
        }
        
        /*-------------------------------*/
       /* flecha */
       
       @keyframes moviendrew {
              0% {
                transform: translatex(0px);
              }
              100% {
                transform: translatex(20px);
              }
        }
        
        #flecha {
                    animation-name: moviendrew;
                    animation-duration: 0.5s;
                    animation-iteration-count: infinite;
                    animation-direction: alternate;
                    font-size: 100px;
                    color: white;
                    position: absolute;
                    top: 423px;
                    z-index: 1;

        }

        
        /*-------------------------------*/
       /* aqui van los puntos de ruptura */
       
       @media (max-width: 991px){
            .fixaltura {
             padding-top: calc(5rem + 57px)!important;
           }
      }
      
      @media (max-width: 767px){
            .card {
               width: 16rem !important;
            }
      }
      
      @media (min-width: 768px){
            .col-md-10 {
              flex: 0 0 auto;
              width: 100% !important;
            }
      } 
      
       @media (max-width: 500px){
            .respmenu {
                flex-direction: column-reverse !important;
            }
            .navbar-collapse {
              height: 100vh;
            }
            #mainNav .navbar-nav {
              margin-top: -1rem;
            }
        }
      
     @media (max-width: 320px){
            .card {
                margin: 0px 5%;
            }
            .img-logo {
              height: 40px;
            }
            
            #flecha {
                    animation-name: moviendrew;
                    animation-duration: 0.5s;
                    animation-iteration-count: infinite;
                    animation-direction: alternate;
                    font-size: 50px;
                    color: white;
                    position: absolute;
                    top: 423px;
                    z-index: 1;

            }
            
      }
    </style>
    <style>
        .container-table {
          display: grid;
          width: 98%;
          background-color: #250440a8;
          border-radius: 8px;
          margin: 10px;
        }
    </style>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="72">
    <?php include 'componentes/menu.php'; ?>
    <header class="text-white masthead fixaltura">
        <div class="container-table">
      <div class="row">
        <div class="col-12 col-md-12">
            <a style="color: #FFF;" href="<?php echo base_url(); ?>">
              <button class="btn btn-primary">
                Volver
              </button>
            </a>
            <table class="table" border="" style="width: 100%;color: #FFF;margin-top: 5%;">
              <tr style="text-align: center;">
                <th>Curso</th>
                <th>Certificado</th>
                <th>Acta</th>
                <th>Aprobado</th>
              </tr>
              <?php foreach ($docs as $key => $value) { ?>
              <?php
                $v1 = $this->Media_model->verify_lesson( $value->user_id, $value->course_id );
                #echo $this->db->last_query();
                $v2 = $this->Media_model->verify_lesson_is_checked( $value->user_id, $value->course_id );
                #echo $this->db->last_query();
                $v3 = $this->Media_model->verify_doc_yes( $value->user_id, $value->course_id );
              ?>
              <tr style="text-align: center;">
                <th><?php echo $value->course; ?></th>
                <th>
                  <?php
                    if( $v3->can > 0 ){
                      echo "<a target='_blank' href='".base_url("home/pdf/2?user_id=".$value->user_id."&course_id=".$value->course_id)."'><button class='btn btn-default'>Descargar</button></a>";
                    }else{
                      echo "NO";
                    }
                  ?>
                </th>
                <th>
                  <?php
                    if( $v3->can > 0 ){
                      echo "<a target='_blank' href='".base_url("home/pdf/1?user_id=".$value->user_id."&course_id=".$value->course_id)."'><button class='btn btn-default'>Descargar</button></a>";
                    }else{
                      echo "NO";
                    }
                  ?>
                </th>
                <th>
                  <?php
                    if( $value->yes == 1 ){
                      echo "SI";
                    }else if( $value->no == 1 ){
                      echo "NO";
                    }
                  ?>
                </th>
              </tr>
              <?php } ?>
            </table>
            <?php include 'application/views/frontend/default/filter-student.php'; ?>
            <br>
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
    </header>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/freelancer.js')?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/Simple-Slider.js')?>"></script>
</body>

</html>