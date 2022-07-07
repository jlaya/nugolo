<?php
    //echo base_url(uri_string()); exit;
    //header("Location: ".base_url(uri_string()));
    $this->load->library('session');
    header('X-Frame-Options: SAMEORIGIN');
    $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
    $user_id = $this->session->userdata('user_id');
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
    #$videos = $this->Media_model->get_multi_media_users( $course_details['token'] );
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
    $wallet = $this->Media_model->wallet();
    
    # SELECT SUM(a.sum_modules) AS sum_modules FROM history_user AS a INNER jOIN multi_media AS b ON( a.multi_media_id = b.id ) WHERE b.month = 'Enero' GROUP BY b.month 
    #echo "<pre>";
    #print_r($sum_modules);
    #exit;
    //echo $this->db->last_query();

    #setlocale(LC_TIME, 'es_PA.UTF-8');
?>
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
        .menu-area {
            margin-bottom: 3rem!important;
        }
    /*@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');*/

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
            display: inline-block;
            width: 100% !important;
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
        position: relative;
        width: 100%;
        height: auto;
        margin-top: -50px;
        background: #fff;
        color: #000;
        border-radius: 30px;
        z-index: 1000;
        box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.4);
        padding: 10px;
        margin-bottom: 65px;
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

  <?php include 'includes_top.php';?>
</head>
<body style="color: #fff; background: linear-gradient(338deg, #00205b, #37163b);">

<?php
  if ($this->session->userdata('user_login')) {
    include 'logged_in_header.php';
  }else {
    include 'logged_out_header.php';
  }
?>

<section class="container-fluid pt-5" style="min-height: 100vh;">
  <div>
    <?php $verify = $this->input->get("r"); ?>
    <?php if ( $verify == 1 ) { ?>
    <div class="alert alert-info">Atenci&oacute;n: ya se encuentra validado.</div>
    <?php } ?>
    <div class="row">
      <div class="col-lg-7">
        
        <div class="about-instructor-box">
            <!-- BORRAR ESTO -->
            <span style="color: red;" class="mensaje"></span>

            <div hidden="" class="about-instructor-title">
                + Videos
            </div>
            <form action="<?php echo base_url('Video/is_checked/'.$sum_modules); ?>" id='frm-send' method="POST">
              <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
              <input type="hidden" name="url" value="<?php echo base_url(uri_string()); ?>">
              <div class="col" style="height: 600px">
                <div class="col-lg-3">
                  <div class="about-instructor-image">
                    <ul class="more-videos"></ul>
                  </div>
                </div>
                <div class="row  justify-content-center" >
                    <div class="container-fluid py-5 px-0" >
                      <div class="col-md-12 mb-2 text-center text-md-left px-0" style="background-color: transparent;">
                        <!--<div class="d-inline-block p-2 mb-4 rounded course-text-content text-center text-lg-left">
                          Puntuaciones: <?php echo $wallet->cant; ?>
                        </div>-->


                        <input type="hidden" id="sum_modules" value="<?php echo $sum_modules; ?>">
                        <p class="text-center text-lg-left panel-semanas-curso">
                          <label class="d-block d-lg-inline-block mb-2"></label>
                          <!-- Taps de lista de cursos con sus lecciones asociadas -->
                          <?php include 'taps-course.php'; ?>
                        </p>

                      </div>
                      <!--<div class="col-md-12 mb-4 d-flex flex-column align-items-center justify-content-center" style="height: auto;">
                        <div class="main-loading-course " style="width: 50%">
                          <img src="https://i.postimg.cc/k589Sr4b/3742225.png" class="img-fluid img-loading-course mt-4" style="display: none;"></img>
                          <h4 style="display: none;" class="text-loading-course-video mb-5 text-center"> Comienza un nuevo desafio, ahora! </h4>
                        </div>
                      </div>
                      <div class="col-md-12" style="background-color: transparent;">
                        
                      </div>-->
                    </div>
                </div>
              </div>
              
            </form>
        </div>
      </div>

      <div class="col-lg-5">
          <br>
        <object type="application/php" data='<?php echo base_url("chat_private?course_id=$course_id");?>' style="width:100%; height:600px;">
            <embed src='<?php echo base_url("chat_private?course_id=$course_id");?>' style="width:100%; height:600px;" frameborder="0" style="border:0;">
          </object>
      </div>
    </div>
  </div>
</section>
<?php
  
  #echo $total_module."<br>";
  #echo $sum_modules_total."<br>";

  /*if( $this->Media_model->sum_history_user() ){
    $sum_history_user = $this->Media_model->sum_history_user();
  }else{
    $sum_history_user = $sum_history_user->cant;
  }


  #echo $total_module;
  #echo "<br>";
  #echo $sum_history_user->cant;

  // Si se completa todos los modulos de todos los cursos se anade un logro

  #echo "$total_module == $sum_history_user->cant";

  if( $total_module == $sum_history_user ){

    #echo "Fino";
    #return false;
    
    // Se inserta las puntuaciones
    $wallet = array(
        'value' => 1,
        'user_id' => $this->session->userdata('user_id'),
        'module' => 'all',
    );
    $this->db->insert('wallet', $wallet);

    // Se ingresa el historial de que cumplio todos los cursos
    $data_history['name']           = "Ha completado los $total_module cursos";
    $data_history['sum_modules']    = $total_module;
    $data_history['multi_media_id'] = 0;
    $data_history['user_id']        = $this->session->userdata('user_id');
    $data_history['module_id']      = 0;
    $data_history['is_checked']     = 1;
    $this->db->insert('history_user', $data_history);
    #echo $this->db->last_query();

    // Cierre de proceso
    $this->db->where('multi_media_id', 0);
    $this->db->where('user_id', $this->session->userdata('user_id'));
    $fields = array(
        'close' => 1
    );
    $this->db->update('history_user', $fields );

    #echo $this->db->last_query();

  }else{
    echo "";
  }*/

  

?>

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
  
  function get_module( module_id){
    $("#module_id").val(module_id);
    // Se limpia el contenedor de Video
    $("div.video-embed").html("");
  }

  get_module(1);

  function show_content(id,sum_modules,value1,value2){
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
      /*if( value1 == value2 ){
        $('.shadow-sm').prop('disabled',true);
      }else{
        $('.shadow-sm').prop('disabled',false);
      }*/
      $("#multi_media_id").val(r['id']);

    }
    });
  }
</script>

</body>
</html>
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