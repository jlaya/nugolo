<?php
  $user = $this->user_model->messageCountUser();
  $message_teacher = $this->user_model->message_teacher();
  $countMessage = $user->can + $message_teacher->can;
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
  html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: middle !important;
}
.nav-link {
  padding: 0;
    padding-right: 0px;
    padding-left: 0px;
}
@media (min-width: 768px){
  .navbar-expand-md .navbar-nav .nav-link {
    padding-right: 0 !important;
    padding-left: 0 !important;
  }
}
/*.order-0 {*/
/*  display: flex;*/
/*}*/
.navbar-nav {
  flex-wrap: wrap-reverse;
  flex-direction: row-reverse;
}

.centrarmenupubliccursos{
    display: flex;
    justify-content: center;
}
</style>
<nav class="navbar navbar-expand-md navbar-light bg-light centrarmenupubliccursos">
  <div class="order-0">
      <a class="navbar-brand mx-auto" href="<?php echo site_url(); ?>">
        <img src="https://i.ibb.co/R0zYZHR/logo.png" alt="" height="40">
      </a>
      <!--<button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler text-white bg-primary navbar-toggler-right text-uppercase rounded collapsed" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">-->
      <!--    <span class="navbar-toggler-icon"></span>-->
      <!--</button>-->
  </div>
  <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
          <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('home'); ?>">
                <img style="width: 120px;" src="<?php echo base_url('assets/frontend/volver.png'); ?>">
              </a>
          </li>
          <?php if( $this->session->userdata('user_id') ){ ?>
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
          <li class="nav-item">
            <a class="color-FFF" href="<?php echo site_url('home/certificates'); ?>">
            <img style="width: 50px;" src="<?php echo base_url('assets/frontend/certificado.png'); ?>">
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('home/messages'); ?>">
                <img style="width: 65px;" src="<?php echo base_url('assets/frontend/correo.png'); ?>">
                <div class="message-number"><?php echo $countMessage; ?></div>
              </a>
          </li>
          <li class="nav-item">
              <table style="background-color: azure;  -webkit-border-radius: 10px 10px 10px 56px;
              border-radius: 10px 10px 10px 56px; text-align: right;width: 169px;">
                  <tbody>
                      <tr>
                          <td colspan="2" style="padding-top: 8px !important;"><?php echo $user_details['first_name']; ?></td>
                          <td rowspan="2"><img src="https://nugolociencia.com/assets/frontend/perfil.png" alt="" width="60px" style="vertical-align: middle !important"></td>
                      </tr>
                      <tr>
                          <td>Nivel</td>
                          <td><?php echo $level->cant; ?></td>
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
</nav>