  <?php

    $get_enroll_course = $this->crud_model->get_enroll_course( $category );

  ?>
  <style type="text/css">
    .card-title {
      height: 100px;
      vertical-align: middle;
      display: table-cell;
    }
  </style>
  <div class="col-md-8">
    <?php foreach ($get_enroll_course as $field){ ?>
      <!-- tarjetas-->
      <div class="card" style="width: 18rem;">
          <img src="<?php echo $this->crud_model->get_course_thumbnail_url($field['id']); ?>" style="width: auto;" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?php echo $field['title']; ?></h5>
            <p class="card-text"><?php echo limitar_cadena($field['short_description'], 50, '...'); ?></p>
          <!-- Validaciones de botones -->
          <?php
            if( $field['is_free_course'] ==1 ){
              $style = 'width: 45%;font-size: 15px;';
            }else{
              $style = 'width: 45%;font-size: 15px;';
            }
          ?>
          <?php
            if( $field['is_free_course'] !=1 ){
              $hidden = "hidden";
            }else{
              $hidden = "";
            }
          ?>

            <a href="<?php echo site_url('home/lesson/'.slugify($field['title']).'/'.$field['id']); ?>" class="btn btn-primary btn-tarjetas" style="<?php echo $style; ?>" >EMPEZAR</a>
            <a target="_blank" <?php echo $hidden; ?> href="https://wa.me/573132545111?text=<?php echo $field['title']."%20".$field['price'].": %20Dejale este mensaje al asesor para que se comunique contigo"; ?>" class="btn btn-primary btn-tarjetas" style="<?php echo $style; ?>">
              PAGAR
            </a>
          </div>
      </div>
    <?php } ?>
  </div>