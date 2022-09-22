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
  $get_enroll_course = $this->crud_model->get_enroll_course();
?>
<style type="text/css">
  .level-number {
    margin: -25px 0px 0px 9px;
  }
</style>
<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <img src="https://i.ibb.co/R0zYZHR/logo.png" alt="" height="50px" class="img-logo">
            </a>
            <button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler text-white  navbar-toggler-right text-uppercase rounded coloricono" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto respmenu">
                    <?php if( $this->session->userdata('user_id') ){ ?>
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
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>