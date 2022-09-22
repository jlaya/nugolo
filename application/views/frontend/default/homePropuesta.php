<?php
  
  $user_id = $this->session->userdata('user_id');
  $intentosFallidos = $this->Media_model->intentosFallidos( $user_id );
  $intentosFallidos4 = $this->Media_model->intentosFallidos4( $user_id );

  #print_r($intentosFallidos4);

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
    <?php include 'componentes/menu.php'; ?>
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
                  <div class="col-md-8">
                    <a title="Ir a todos los cursos" class="color-FFF text-center" href="<?php echo site_url('home/courses'); ?>">
                      <img src="<?php echo base_url('assets/mensaje.png');?>" alt="" width="300px" height="300px">
                    </a>
                </div>
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
</body>

</html>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/freelancer.js')?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/Simple-Slider.js')?>"></script>

    <?php if( count($intentosFallidos) > 0 ){ ?>
      <script type="text/javascript">
        $( document ).ready(function() {
          var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'))
          myModal.show();
        });
      </script>
    <?php } ?>
    <!-- 4 intentos fallidos -->
    <?php if( count($intentosFallidos4) > 0 ){ ?>
      <script type="text/javascript">
        $( document ).ready(function() {
          var myModal4 = new bootstrap.Modal(document.getElementById('staticBackdrop4'))
          myModal4.show();
        });
      </script>
    <?php } ?>


<?php if( count($intentosFallidos) > 0 ){ ?>
      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body" style="position: absolute;">
                      <img src="<?php echo base_url('assets/advertising.png'); ?>" style="width: 100%;">
                      <div class="row">
                        <div class="col-lg-4">&nbsp;</div>
                        <div class="col-lg-8" style="margin: -35% 0% 0% 30%;position: absolute;font-size: 14px;width: auto;color: white">
                          Debes estar pendiente del mensaje del tutor en la plataforma y en tu correo electrónico
                          <div style="height: 115px;overflow-y:auto;" class="scrollbar-hidden">
                            <?php foreach ($intentosFallidos as $key => $value) { ?>
                            <br><br>
                            <div style="margin: 0 0 0 35%;position: relative;">
                              Cantidad de impactos <span>2</span>
                              <br>
                              vida de tu nave <span>2</span>
                            </div>
                            <br>
                              <div style="margin: 0 0 0 35%;position: relative;">
                                <p><?php echo $value->title; ?></p>
                              </div>
                            <?php } ?>
                          </div>
                          <img src="<?php echo base_url('assets/source.gif'); ?>" style="width: 40%;margin: -37% 0% 0% 0%;" >
                          <br>
                          <br>
                      </div>
                  </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>

    <?php if( count($intentosFallidos4) > 0 ){ ?>
      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body" style="position: absolute;">
                      <img src="<?php echo base_url('assets/advertisingfinal.png'); ?>" style="width: 100%;">
                      <div class="row" style="display: none;">
                        <div class="col-lg-4">&nbsp;</div>
                        <div class="col-lg-8" style="margin: -35% 0% 0% 30%;position: absolute;font-size: 14px;width: auto;color: white">
                          Debes estar pendiente del mensaje del tutor en la plataforma y en tu correo electrónico
                          <div style="height: 115px;overflow-y:auto;" class="scrollbar-hidden">
                            <?php foreach ($intentosFallidos4 as $key => $value) { ?>
                            <br><br>
                            <div style="margin: 0 0 0 35%;position: relative;">
                              Cantidad de impactos <span>2</span>
                              <br>
                              vida de tu nave <span>2</span>
                            </div>
                            <br>
                              <div style="margin: 0 0 0 35%;position: relative;">
                                <p><?php echo $value->title; ?></p>
                              </div>
                            <?php } ?>
                          </div>
                          <img src="<?php echo base_url('assets/source.gif'); ?>" style="width: 40%;margin: -37% 0% 0% 0%;" >
                          <br>
                          <br>
                      </div>
                  </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>