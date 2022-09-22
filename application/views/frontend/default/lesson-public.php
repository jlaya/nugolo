<?php
    //echo base_url(uri_string()); exit;
    //header("Location: ".base_url(uri_string()));
    $this->load->library('session');
    header('X-Frame-Options: SAMEORIGIN');
    $user_id = $this->session->userdata('user_id');
    // Matricular estudiante de forma gratuita
    if( $this->input->get('q') == "free" ){
      $this->crud_model->enroll_to_free_course( $course_id, $user_id );
    }

    $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
    $r1 = $this->Media_model->count_lesson( $user_id, $course_id );
    $r1 = $r1->can;
    $r2 = $this->Media_model->count_lesson_logros( $user_id, $course_id );
    $r2 = $r2->can;
    #echo "$r1 == $r2";
    #exit;

    if( $r1 > 0 && $r1 == $r2 ){
      $disabled = "style='display:none;'";
    }else{
      $disabled = "style='display:block;'";
    }

    //$first_more_videos = $this->Media_model->first_get_media($course_details['token']);
    //$more_videos = $this->Media_model->get_media($course_details['token']);
    // Carga automatica de video segun el usuario
    $this->Media_model->add_video( $course_id, $course_details['token'] );
    // Lectura de datos de videos
    $token  = $course_details['token'];
    $row_media = $this->Media_model->row_media( $token );
    $videos = $this->Media_model->get_media_users( $course_details['token'] );
    $doc = $this->Media_model->searchDocument( $course_details['id'] )->cant;
    $module = $this->Media_model->group_by_users( $course_details['token'] );
    # Consulta para hacer el conteo de la cantidad de lecciones que pueda tener a nivel
    # global los modulos
    $sum_modules = $this->Media_model->sum_modules( $course_details['token'] );
    $sum_modules = $sum_modules->sum_modules;
    $total_module = $sum_modules;
    // Se toman la cantidad de cursos que ha obtenido el curso
    $cant_module = $this->Media_model->history_users();
    $cant_module = $cant_module->cant_module;

    // Conteo de la cantidad de puntuaciones que tenga el usuario
    //$wallet = $this->Media_model->wallet();
    
    # SELECT SUM(a.sum_modules) AS sum_modules FROM history_user AS a INNER jOIN multi_media AS b ON( a.multi_media_id = b.id ) WHERE b.month = 'Enero' GROUP BY b.month 
    #echo "<pre>";
    #print_r($sum_modules);
    #exit;
    //echo $this->db->last_query();

    #setlocale(LC_TIME, 'es_PA.UTF-8');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Curso</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bebas">
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
             padding-top: calc(2rem + 57px)!important;
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
            .col-md-4 {
              display: flex;
              align-self: center;
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
      .sub-menu-course{
        width: 33%;
      }
      @media (max-width: 600px){
          .responsivo-submenu {
              flex-direction: column;
          }
          .sub-menu-course{
            width: 100%;
          }
      }
      
    </style>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="72">
    <!--<div id="flecha">
         &#8594;
    </div>-->
    <?php include 'componentes/menu.php'; ?>
    <header class="text-center text-white masthead fixaltura">
        <div class="container" style="margin-bottom: 10px;">
            <div class="row responsivo-submenu">
              <div class="col-md-6 sub-menu-course ">
                <a href="<?php echo base_url('home/courses'); ?>">
                    <button style="width: 100%;" class = "btn btn-primary" type="button">Volver</button>
                </a>
              </div>
              <div class="col-md-6 sub-menu-course">
                <h5><?php echo $course_details['title']; ?></h5>
              </div>
              <div class="col-md-6 sub-menu-course">
                <a href="<?php echo site_url('home/course/'.slugify($course_details['title']).'/'.$course_details['id']); ?>">
                  <button style="width: 100%;" class="btn btn-primary">Ver contenido</button>
                </a>
              </div>
            </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <?php include 'componentes/videos.php'; ?>
            </div>
            <div class="col">
              <?php include 'componentes/chat.php'; ?>
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

<?php
  //include 'footer.php';
  include 'includes_bottom.php';
  include 'modal.php';
?>
<input type="hidden" id="get_token" value="<?php echo $course_details['token']; ?>">

<script type="text/javascript">
  function get_url(url){
    alert(url)
  }
</script>
<script type="text/javascript">
  var acc = document.getElementsByClassName("accordion");
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
      /* Toggle between adding and removing the "active" class,
      to highlight the button that controls the panel */
      this.classList.toggle("active");

      /* Toggle between hiding and showing the active panel */
      var panel = this.nextElementSibling;
      if (panel.style.display === "block") {
        panel.style.display = "none";
      } else {
        panel.style.display = "block";
      }
    });
  }
</script>
<script type="text/javascript">
  
  /*function get_module( module_id){
    $("#module_id").val(module_id);
    // Se limpia el contenedor de Video
    $("div.video-embed").html("");
  }*/

  //get_module(1);

  /*function show_content(id,sum_modules,value1,value2){
    var token = '<?php echo $token; ?>';

    $.ajax({
      dataType: "json",
      url: '<?php echo site_url('home/show_content');?>',
      type : 'POST',
      data : {
        'id' : id,
        'token' : token
    },
    success: function(r){
      //console.log('r: ', r.embed);
      // Vimeo
      if( r.type == 1 ){
        content_iframe = '<iframe src="'+r.url+'" width="100%" height="316.688px" style="position: absolute; padding: 1%; left: 0; width: 100%; height: 316.688px;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
      }else if( r.type == 2 ){
        content_iframe = '<iframe src="'+r.url+'" width="100%" height="316.688px" style="position: absolute; padding: 1%; left: 0; width: 100%; height: 316.688px;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
      }else if( r.type == 3 ){
        //content_iframe = '<div style="width: 100%;">';
          //content_iframe += '<div style="position: relative; padding-bottom: 56.25%; padding-top: 0; height: 0;">';
            content_iframe = '<iframe frameborder="0" width="100%" height="316.688px" style="position: absolute; padding: 1%; left: 0; width: 100%; height: 316.688px;" src="'+r.url+'" type="text/html" allowscriptaccess="always" allowfullscreen="true" scrolling="yes" allownetworking="all"></iframe>';
          //content_iframe += '</div>';
        //content_iframe += '</div>';
        $("input.sum_modules").val(sum_modules);
      }

      $("div.video-embed").html(content_iframe);
      
      $("#multi_media_id").val(r['id']);

    }
    });
  }*/
</script>

</body>
</html>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">&nbsp;</h5>
      </div>
      <div class="modal-body">
        <picture>
          <source
            media="(max-width: 400px)"
            srcset="<?php echo base_url('assets/notify-media.png'); ?>">
          <img
            src="<?php echo base_url('assets/notify.png'); ?>"
            alt="Notify" style="width: 100%;display:block;margin:auto;">
        </picture>
      </div>
      <div class="modal-footer">
        <a href="<?php echo base_url('home'); ?>">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
        </a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  $( document ).ready(function() {

    var notify = "<?php echo $this->input->get('q'); ?>";
    var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'))
  
    if( notify == 'message' ){
      document.onreadystatechange = function () {
        myModal.show();
      };
    }

  });
  
</script>

<input type="hidden" id="ready_videoId" value="<?php echo $this->session->userdata('videoId'); ?>">
<?php 
  $arraydata = array(
          'get_token' => $course_details['token']
  );
  $this->session->set_userdata($arraydata);
?>
<?php 
  $arraydata = array(
          'url' => base_url(uri_string())
  );
  $this->session->set_userdata($arraydata);
?>