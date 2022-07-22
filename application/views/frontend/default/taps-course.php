  <style type="text/css">
  	.taps-element{
  		float: left;
  		background-color: #ad7dfd;
  		margin: 0% 2% 0% 0%;
  		padding: 1% 2% 1% 2%;
  		cursor: pointer;
  	}
  </style>
  <div class="content">
    <!-- Nav pills -->
    <ul class="nav nav-pills" role="tablist">
      <?php $sum_modules_total = 0; foreach ($module as $key => $modules) { $module_id = $key + 1; ?>
      <?php
	      $module_id = $key + 1;
	      $sum_modules = $this->Media_model->get_modules( $modules->month, $token );
	      if( $this->Media_model->find_sum_modules( $modules->month ) ){
	        $find_sum_modules = $this->Media_model->find_sum_modules( $modules->month );
	        $find_sum_modules = $find_sum_modules->find_sum_modules;
	      }else{
	        $find_sum_modules = 0;
	      }
	      $verify_history_user = $this->Media_model->verify_history_user($module_id);

	  ?>
      <li class="nav-item">
        <a class="nav-link <?php echo ( $module_id == 1 ? 'active' : '' ) ?>" data-toggle="pill" href="#taps-<?php echo $module_id; ?>" onclick='get_module(<?php echo $key + 1; ?>);'>
        	<?php echo $module_id; ?>
        </a>
      </li>
      <?php $sum_modules_total += $find_sum_modules; } ?>
      <li class="nav-item" style="display: none;">
        <a class="nav-link" data-toggle="pill" href="#taps-video">
        	Video
        </a>
      </li>
      <li class="nav-item" style="display: none;">
        <a class="nav-link" data-toggle="pill" href="#taps-valoracion">
        	Valoraci&oacute;n
        </a>
      </li>
      <?php if( $this->input->get('q') !="free" ){ ?>
      <li class="nav-item">
        <a class="nav-link" href='<?php echo base_url("document?course_id=$course_id"); ?>'>
          Cargar taller
        </a>
      </li>
      <?php } ?>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <?php $sum_modules_total = 0; foreach ($module as $key => $modules) { $module_id = $key + 1; ?>
      <div id="taps-<?php echo $module_id; ?>" class="container tab-pane <?php echo ( $module_id == 1 ? 'active' : '' ) ?>">
        <!-- Si la cantidad de lecciones es igual a la cantidad de lecciones vistas se valida para su puntuacion -->
        <?php
          /*if( $sum_modules->sum_modules == $find_sum_modules && $verify_history_user->verify > 0 ){ ?>
            <script type="text/javascript">
              alert("Ha logrado el número de lecciones vistas del modulo <?php echo $key + 1; ?>")
            </script>
        <?php
          $num_module = $key + 1;
          $name = "Ha logrado el número de lecciones vistas del modulo $num_module";
          $update_history_user = $this->Media_model->is_checked_history_user( $module_id , $sum_modules->sum_modules, $name );

          }*/
        ?>
        
          <?php
            $obj = $this->Media_model->get_ids_module_users( $modules->token );
          ?>

          <!-- Resultados -->
          <?php #echo $sum_modules->sum_modules; ?> <!--(--><?php #echo ( $find_sum_modules == null ) ? 0 : $find_sum_modules ?><!--)-->

          <?php foreach ($obj as $key => $value) { ?>
            <?php
              $get_sum_modules = $this->Media_model->get_sum_modules( $value->id );
            ?>
            <a title="Lecci&oacute;n (<?php echo $value->id; ?>)" onclick="show_content(<?php echo $value->id; ?>,<?php echo ($get_sum_modules->sum_modules ? $get_sum_modules->sum_modules : 0); ?>,<?php echo ($sum_modules->sum_modules ? $sum_modules->sum_modules : 0); ?>,<?php echo ( $find_sum_modules == null ) ? 0 : $find_sum_modules ?>);">
            	<div class="taps-element">Lecci&oacute;n <?php echo $key + 1; ?></div>
            </a>
          <?php } ?>

      </div>
      <?php $sum_modules_total += $find_sum_modules; } ?>
      
      <div id="taps-video" class="container tab-pane" style="display: none;">
      	<div class="video-embed-old w-100" style="width: 563px;height: 316.688px;"></div>
      </div>
      <div id="taps-valoracion" class="container tab-pane">
        <input type="hidden" id="module_id" name="module_id" />
        <input type="hidden" id="multi_media_id" name="multi_media_id" />
        <input type="hidden" class="sum_modules" name="sum_modules">
      </div>
      <br><br>
      <p>
      <div class="w-100" style="width: 563px;height: 316.688px;">
      	<div class="video-embed"></div>
      </div>
      </p>
    </div>
    <?php if( $this->input->get('q') !="free" ){ ?>
    <div class="tab-content" >
      <div class="row justify-content-center">
        <?php if( $doc > 0 ){ ?>
        <div class="col-auto">
          <label class="form-check-label" for="is_checked">
            Si viste todo el curso dale clic en el botón enviar
          </label>
        </div>
        <div class="col-auto">
          <input required="" type="checkbox" class="form-check-input" id="is_checked" name="is_checked" value="1">
        </div>
        <div class="col-auto">
          <button style="width:150px;" type="submit" class="btn button-send btn-lg btn-block shadow-sm" onclick="return confirm(\'Esta de acuerdo en dar de visto al curso?\');">Enviar</button>
        </div>
        <?php }else{ ?>
          <div class="col-auto">
            <label class="form-check-label" for="is_checked">
              <div style="white-space: normal !important">
              <a href="<?php echo base_url("document?course_id=$course_id"); ?>">Recuerda para validar el curso debes cargar el taller.</a>
              </div>
            </label>
          </div>
          <div class="col-auto">
            <button style="width:150px;background-color: red;" type="button" class="btn button-send btn-lg btn-danger shadow-sm">Enviar</button>
          </div>
        <?php } ?>
      </div>
    </div>
    <?php } ?>
  </div>