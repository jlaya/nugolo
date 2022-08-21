<?php
  $user = $this->user_model->messageCountUser();
  #echo $user->can;
?>
<style type="text/css">
  .bg-light {
      background-color: transparent !important;
  }
  .message-number{
    margin: -65px 0px 0px 36px;
    color: red;
    font-weight: bold;
    position: absolute;
  }
</style>
<nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="order-0">
                    <a class="navbar-brand mx-auto" href="<?php echo site_url(); ?>">
                      <img src="https://i.ibb.co/R0zYZHR/logo.png" alt="" height="50">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('home'); ?>">
                              <img style="width: 65px;" src="<?php echo base_url('assets/frontend/volver.png'); ?>">
                            </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" title="Proximamente...">
                             <img style="width: 50px;" src="<?php echo base_url('assets/frontend/shop.png'); ?>">
                         </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" title="Proximamente...">
                             <img style="width: 50px;" src="<?php echo base_url('assets/frontend/money.png'); ?>">
                         </a>
                        </li>
                        <li class="nav-item">
                          <a class="color-FFF" href="<?php echo site_url('home/courses'); ?>">
                          <img style="width: 50px;" src="<?php echo base_url('assets/frontend/course.png'); ?>">
                          </a>
                        </li>
                        <?php if( $this->session->userdata('user_id') ){ ?>
                        <li class="nav-item">
                          <a class="color-FFF" href="<?php echo site_url('home/certificates'); ?>">
                          <img style="width: 50px;" src="<?php echo base_url('assets/frontend/certificado.png'); ?>">
                          </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('home/messages'); ?>">
                              <img style="width: 65px;" src="<?php echo base_url('assets/frontend/correo.png'); ?>">
                              <div class="message-number"><?php echo $user->can; ?></div>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if( $this->session->userdata('user_id') ){ ?>
                        <li class="nav-item" style="display: none;">
                            <a style="margin: 8% 0% 0% 0%;" class="nav-link" href="<?php echo base_url('home/profile/users'); ?>">
                              <?php echo $user_details['first_name']; ?>
                              <br>Editar perfil
                            </a>
                        </li>
                        <?php } ?>
                        <?php if( $this->session->userdata('user_id') ){ ?>
                        <li class="nav-item">
                            <a class="nav-link">
                              <?php if (file_exists('uploads/user_image/'.$user_details['id'].'.jpg')): ?>
                                  <img src="<?php echo base_url().'uploads/user_image/'.$user_details['id'].'.jpg';?>" alt="" class="img-fluid w-20 user-avatar" style="width: 65px;">
                              <?php else: ?>
                                  <img src="<?php echo base_url('assets/frontend/perfil.png');?>" alt="" class="img-fluid w-20 user-avatar" style="width: 65px;">
                              <?php endif; ?>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if( $this->session->userdata('user_id') ){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('login/logout/user'); ?>">
                              <img style="width: 65px;" src="<?php echo base_url('assets/frontend/salir.png'); ?>">
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </nav>