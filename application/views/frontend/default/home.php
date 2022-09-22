<?php
    $this->load->model('Announce_model');
    $user_id = $this->session->userdata('user_id');
    $user_details = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
    // Conteo de la cantidad de puntuaciones que tenga el usuario
    $wallet = $this->Media_model->wallet();
    $level = $this->Media_model->level();
    $showLogros = $this->Media_model->showLogros();
    #$this->load->model('Insignias_model');
    $showInsignias = $this->Insignias_model->showInsignias();
    // Anuncios
    $announceActive = $this->Announce_model->announceActive();


    $intentosFallidos = $this->Media_model->intentosFallidos( $user_id );

    #exit;

    // Validacion para el tema de las insignias
    #$count_history_user = $this->Media_model->count_history_user();

    // Se realiza el conteo de cursos en el caso de que el usuario no lo posea
    $course_user = $this->Media_model->count_relation_course_user()->cant;
    #exit;

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
<?php
  $user = $this->user_model->messageCountUser();
  $message_teacher = $this->user_model->message_teacher();
  $countMessage = $user->can + $message_teacher->can;
  $get_enroll_course = $this->crud_model->get_enroll_course( $category );
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
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="72">
    <div id="flecha">
         &#8594;
    </div>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="http://localhost/colombia/nugolo/">
                <img src="https://i.ibb.co/R0zYZHR/logo.png" alt="" height="50px" class="img-logo">
            </a>
            <button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler text-white  navbar-toggler-right text-uppercase rounded coloricono" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto respmenu">
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded" title="Proximamente...">
                           <img style="width: 65px;" src="<?php echo base_url('assets/frontend/new/tiendanugol.png'); ?>">
                       </a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded" title="Proximamente...">
                           <img style="width: 65px;" src="<?php echo base_url('assets/frontend/new/monedas_nugol.png'); ?>">
                           <div class="level-number"><?php echo $wallet->cant; ?></div>
                       </a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded" href="<?php echo site_url('home/courses'); ?>">
                            <img style="width: 65px;" src="<?php echo base_url('assets/frontend/new/cursosnugol.png'); ?>">
                        </a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded" href="<?php echo site_url('home/certificates'); ?>">
                            <img style="width: 65px;" src="<?php echo base_url('assets/frontend/new/certificadosnugol.png'); ?>">
                        </a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded" href="<?php echo base_url('home/messages'); ?>">
                            <img style="width: 65px;" src="<?php echo base_url('assets/frontend/new/mensajesnugol.png'); ?>">
                            <div class="message-number"><?php echo $countMessage; ?></div>
                        </a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1" id="estilostablamenu">
                        <table style="background-color: azure;  -webkit-border-radius: 10px 10px 10px 56px; box-shadow: -7px 9px 23px -10px rgba(27,9,71,0.68);
                          border-radius: 10px 10px 10px 56px; text-align: right;width: 219px;">
                              <tbody>
                                  <tr>
                                      <td colspan="2" style="padding-top: 8px !important;"><?php echo $user_details['first_name']; ?></td>
                                      <td rowspan="2" style="width: 80px;"><img src="https://nugolociencia.com/assets/frontend/perfil.png" alt="" width="60px" style="vertical-align: middle !important"></td>
                                  </tr>
                                  <tr>
                                      <td>Nivel</td>
                                      <td><?php echo $level; ?></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" style="padding-bottom:10px;">
                                      <a href="<?php echo base_url('home/profile/users'); ?>">
                                        Ver Perfil
                                      </a>
                                    </td>
                                    <td>
                                      <a class="nav-link" href="<?php echo base_url('login/logout/user'); ?>">
                                        <img style="width: 65px;" src="<?php echo base_url('assets/frontend/salir.png'); ?>">
                                      </a>
                                    </td>
                                  </tr>
                              </tbody>
                          </table>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="text-center text-white masthead fixaltura">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?php include 'filter-category.php'; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php if( $course_user == 0 ){ ?>
                  <a title="Ir a todos los cursos" class="color-FFF text-center" href="<?php echo site_url('home/courses'); ?>">
                    <img src="<?php echo base_url('assets/mensaje.png');?>" alt="" width="300px" height="300px">
                  </a>
                <?php }else{ ?>
                    <?php include 'cards.php'; ?>
                <?php } ?>
                <?php include 'anuncios.php'; ?>
            </div>
        </div>
    </header>
    <div class="text-center text-white copyright py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12"><span></span></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12 text-left">
                          <h1 style="color: white;font-size: 22px;margin:1%;background-color: rebeccapurple;padding: 10px;">Glosario de temas</h1>
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-12">
                          <?php
                            foreach ($get_enroll_course as $key => $value) {
                              foreach (json_decode($value['outcomes']) as $outcome){
                                
                                    echo '<div style="float: left;margin: 1% 1% 1% 1%;">';
                                      echo '<button type="button" class="btn btn-success">'.$outcome.'</button>';
                                      echo '</div>';
                                    
                              }
                            } 
                          ?>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-lg-none scroll-to-top position-fixed rounded"><a class="text-center d-block rounded text-white" href="#page-top"><i class="fa fa-chevron-up"></i></a></div>
    <div class="modal text-center" role="dialog" tabindex="-1" id="portfolio-modal-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="modal-body">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <h2 class="text-uppercase text-secondary mb-0">Project Name</h2>
                                <hr class="star-dark mb-5"><img class="img-fluid mb-5" src="assets/img/portfolio/cabin.png">
                                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pb-5"><a class="btn btn-primary btn-lg mx-auto rounded-pill portfolio-modal-dismiss" role="button" data-bs-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Close Project</a></div>
            </div>
        </div>
    </div>
    <div class="modal text-center" role="dialog" tabindex="-1" id="portfolio-modal-2">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="modal-body">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <h2 class="text-uppercase text-secondary mb-0">Project Name</h2>
                                <hr class="star-dark mb-5"><img class="img-fluid mb-5" src="assets/img/portfolio/cake.png">
                                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pb-5"><a class="btn btn-primary btn-lg mx-auto rounded-pill portfolio-modal-dismiss" role="button" data-bs-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Close Project</a></div>
            </div>
        </div>
    </div>
    <div class="modal text-center" role="dialog" tabindex="-1" id="portfolio-modal-3">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="modal-body">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <h2 class="text-uppercase text-secondary mb-0">Project Name</h2>
                                <hr class="star-dark mb-5"><img class="img-fluid mb-5" src="assets/img/portfolio/circus.png">
                                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pb-5"><a class="btn btn-primary btn-lg mx-auto rounded-pill portfolio-modal-dismiss" role="button" data-bs-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Close Project</a></div>
            </div>
        </div>
    </div>
    <div class="modal text-center" role="dialog" tabindex="-1" id="portfolio-modal-4">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="modal-body">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <h2 class="text-uppercase text-secondary mb-0">Project Name</h2>
                                <hr class="star-dark mb-5"><img class="img-fluid mb-5" src="assets/img/portfolio/game.png">
                                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pb-5"><a class="btn btn-primary btn-lg mx-auto rounded-pill portfolio-modal-dismiss" role="button" data-bs-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Close Project</a></div>
            </div>
        </div>
    </div>
    <div class="modal text-center" role="dialog" tabindex="-1" id="portfolio-modal-5">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="modal-body">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <h2 class="text-uppercase text-secondary mb-0">Project Name</h2>
                                <hr class="star-dark mb-5"><img class="img-fluid mb-5" src="assets/img/portfolio/safe.png">
                                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pb-5"><a class="btn btn-primary btn-lg mx-auto rounded-pill portfolio-modal-dismiss" role="button" data-bs-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Close Project</a></div>
            </div>
        </div>
    </div>
    <div class="modal text-center" role="dialog" tabindex="-1" id="portfolio-modal-6">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="modal-body">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <h2 class="text-uppercase text-secondary mb-0">Project Name</h2>
                                <hr class="star-dark mb-5"><img class="img-fluid mb-5" src="assets/img/portfolio/submarine.png">
                                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pb-5"><a class="btn btn-primary btn-lg mx-auto rounded-pill portfolio-modal-dismiss" role="button" data-bs-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Close Project</a></div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/freelancer.js')?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/Simple-Slider.js')?>"></script>
</body>

</html>