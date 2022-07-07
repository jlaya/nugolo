<?php include 'pixel-facebook.php';?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/custom-about.css'); ?>">


<div class="container-fluid content-about" style="min-height: calc(100vh - 65px - 87px );">
  <div id="bg-about" style="background: url(<?php echo base_url().'assets/frontend/images/frontend/mesa-2.png' ?>); " ></div>

  <div class="row bg-dark align-items-center row-about" style=" padding: 20px 0;" >
    <div class="col-md-7 bg- d-none d-lg-block">
        
    </div>
    <div class="col-lg-5 col-md-12 right-about bg-" >
      <p>En IronBody54 queremos que te mantengas en forma en cualquier lugar, somos un gimnasio virtual que cuenta con instructores especializados en diferentes tipos de entrenamientos, además tenemos un equipo de nutricionistas, psicólogos deportivos y fisioterapeutas para ofrecerte un plan de entrenamiento completo.</p>
      <p>Sabemos que cada persona es diferente y tiene requerimientos distintos al momento de iniciar un entrenamiento, por eso evaluamos el perfil de cada usuario para crearle un plan de entrenamiento y alimentación personalizado y además de esto lo acompañamos durante todo el proceso.</p>
      <p>Queremos ayudarte a mantenerte saludable y en forma, por eso llevamos el gimnasio a tu casa o a cualquier lugar donde quieras entrenar, solo necesitas un computador, conexión a Internet, un espacio para hacer los ejercicios y tener las ganas de ser la mejor versión de ti.</p>

      <div class="row d-flex align-items-center " style="margin-bottom: 20px;">
        <div class="col-lg-8 col-md-12 float-left bg-">
          <p class="ver-mas-about">Para comenzar solo debes registrarte, conoce nuestros precios aquí</p>
        </div>
        <div class="col-lg-4 col-md-12 d-md-block col-ver-mas">
         <button type="button" class="d-md-block btn btn-outline-info btn-arrowed">
           Ver mas
           <a class="link link--arrowed" href="<?php echo base_url('plans'); ?>">
            <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
              <g fill="none" stroke="#fff" stroke-width="1.5" stroke-linejoin="round" stroke-miterlimit="10">
                <circle class="arrow-icon--circle" cx="16" cy="16" r="15.12"></circle>
                <path class="arrow-icon--arrow" d="M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98"></path>
              </g>
            </svg>
          </a>
          </button>
          
        </div>
      </div>
    </div>
  </div>
</div>

