<?php

   $latest_courses = $this->crud_model->all_courses($category);

?>
<style type="text/css">
  .card-text {
        height: 67px;
    }
    .card-title {
        height: 62px;
    }
</style>
<div class="container"style="display: inline-flex; flex-direction: row; flex-wrap: wrap;justify-content: center;">
   <!--<div class="row">-->
      <!--<div class="col-md-8">-->
         <!-- tarjetas-->
         <?php foreach ($latest_courses as $latest_course){ ?>
            <?php
              if( $this->session->userdata('user_id') ){
                $children = $this->Media_model->get_children( $latest_course['children'] );
                $id = $children['id'];
                $title = $children['title'];
              }else{
                $id = $latest_course['id'];
                $title = $latest_course['title'];
              }
              if( $this->session->userdata('user_id') && $latest_course['is_pay'] == 1 ){
               $color_botton = "#eebe33";
              }else{
               $color_botton = "#0D0046";
              }
              if( $this->session->userdata('user_id') && $latest_course['is_pay'] == 1 ){
               $button = "warning";
               $text_button = "ADQUIRIDO";
              }else{
               $button = "primary";
               $text_button = "DETALLES";
              }
            ?>
            <div class="card mt-3" style="width: 18rem;margin: 8px 1%;">
               <img src="<?php echo $this->crud_model->get_course_thumbnail_url($latest_course['id']); ?>"  width="287px"  height="184px" style="width: auto;" class="card-img-top" alt="...">
               <div class="card-body">
                  <h5 class="card-title"><?php echo $latest_course['title']; ?></h5>
                  <p class="card-text"><?php echo limitar_cadena($latest_course['short_description'], 50, '...'); ?></p>
                  <!-- Validaciones de botones -->
                  <a href="<?php echo site_url('home/course/'.slugify($latest_course['title']).'/'.$latest_course['id']); ?>" class="btn btn-<?php echo $button; ?> btn-tarjetas" style="width: 53%;font-size: 15px;">
                     <?php echo $text_button; ?>
                  </a>
                  <?php if( $latest_course['is_pay'] == 1 ){ ?>
                    <a class="btn btn-primary" style="cursor: crosshair;">
                       PROBAR
                    </a>
                  <?php }else{ ?>
                    <a href="<?php echo site_url('home/lesson/'.slugify($title).'/'.$id.'?q=free'); ?>" class="btn btn-primary">
                      PROBAR
                    </a>
                  <?php } ?>
               </div>
            </div>
         <?php } ?>
      <!--</div>-->
   <!--</div>-->
</div>
