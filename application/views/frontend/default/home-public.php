<?php
    $user_details = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
    $category = $this->input->get('category');
    // Conteo de la cantidad de puntuaciones que tenga el usuario
    #$wallet = $this->Media_model->wallet();

    // Validacion para el tema de las insignias
    #$count_history_user = $this->Media_model->count_history_user();

    /*function limitar_cadena($cadena, $limite, $sufijo){
      // Si la longitud es mayor que el límite...
      if(strlen($cadena) > $limite){
      // Entonces corta la cadena y ponle el sufijo
      return substr($cadena, 0, $limite) . $sufijo;
      }
      
      // Si no, entonces devuelve la cadena normal
      return $cadena;
    }*/

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
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
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="72">
    <?php include 'componentes/menu.php'; ?>
    <header class="text-center text-white masthead fixaltura">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?php include 'filter-category-home-public.php'; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php include 'componentes/cards-courses.php'; ?>
    </header>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/freelancer.js')?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/Simple-Slider.js')?>"></script>
</body>

</html>