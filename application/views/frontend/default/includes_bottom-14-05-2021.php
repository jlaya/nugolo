

<?php 
   // Load models
   require_once "application/models/Question_model.php";
   $instance = new Question_model();
   $obj  = $instance->question_info();
   $pull = $instance->exists_pull( "pull", $this->session->userdata('user_id') );
   $pay_users = $instance->exists_users_detail( $this->session->userdata('user_id') );
   ?>
<script src="<?php echo base_url().'assets/frontend/js/vendor/modernizr-3.5.0.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/vendor/jquery-3.2.1.min.js'; ?>"></script>
<script src="<?php echo base_url('assets/backend/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js'); ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/popper.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/bootstrap.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/slick.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/select2.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/tinymce.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/multi-step-modal.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/jquery.webui-popover.min.js'; ?>"></script>
<script src="https://content.jwplatform.com/libraries/O7BMTay5.js"></script>
<script src="<?php echo base_url().'assets/frontend/js/main.js'; ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
<script src="<?php echo base_url().'assets/frontend/js/bootstrap-tagsinput.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/custom.js'; ?>"></script>
<!-- SHOW TOASTR NOTIFIVATION -->
<?php if ($this->session->flashdata('flash_message') != ""):?>
<script type="text/javascript">
   toastr.success('<?php echo $this->session->flashdata("flash_message");?>');
</script>
<?php endif;?>
<?php if ($this->session->flashdata('error_message') != ""):?>
<script type="text/javascript">
   toastr.error('<?php echo $this->session->flashdata("error_message");?>');
</script>
<?php endif;?>
<!-- Slider Revolution core JavaScript files -->
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/jquery.themepunch.tools.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/jquery.themepunch.revolution.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.actions.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.carousel.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.kenburn.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.layeranimation.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.migration.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.navigation.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.parallax.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.slideanims.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.video.min.js'; ?>"></script>
<!-- Modal -->
<div class="modal fade" id="CuestionModal" tabindex="-1" role="dialog" aria-labelledby="CuestionModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="CuestionModalLabel">Encuesta</h5>
         </div>
         <form action="<?php echo base_url('Question/add_pull') ?>" method="POST">
         <div class="alert alert-danger">Dar clic en cada panel para mostrar el contenido de cada cuestionario</div>
            <input type="hidden" name="form" value="pull">
            <div class="modal-body jumbotron">
               <div id="accordion">
                  <?php foreach ($obj as $key => $value) { $relation = $value->id; ?>
                  <div class="card">
                     <div class="card-header" id="heading<?php echo $value->id; ?>">
                        <h5 class="mb-0">
                           <button style="width: 100%;" type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $value->id; ?>" aria-expanded="false" aria-controls="collapse<?php echo $value->id; ?>">
                           <?php echo $value->title; ?>
                           </button>
                        </h5>
                     </div>
                     <div id="collapse<?php echo $value->id; ?>" class="collapse" aria-labelledby="heading<?php echo $value->id; ?>" data-parent="#accordion">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-sm-12 alert alert-info"><?php echo trim($value->description); ?></div>
                           </div>
                           <?php $question = $instance->question( $value->id ); ?>
                           <?php foreach ($question as $key => $value) { ?>
                           <div class="row">
                              <div class="col-sm-12">
                                 <?php 
                                    $id              = $value->id;
                                    $type            = $value->type;
                                    $length          = $value->length;
                                    $video           = $value->video;
                                    $maxlength       = ( $value->length > 0 ) ? "maxlength=$value->length": "";


                                    $required        = ( $value->required == 1 ) ? "required": "";
                                    $required_field  = ( $value->required == 1 ) ? "<font style='color:red;font-weight:bold;'>*</font>": "";
                                    $class           = ( $value->type == "textarea" || $value->type == "input" ) ? "form-control": "";
                                    
                                    echo $value->question;
                                    if( $value->required == 1 ){
                                        echo " (".$required_field.")";
                                    }
                                    echo '<input type="hidden" name="id[]" value="'.$id.'"  />';
                                    // Campo checkbox

                                    if( $type =='video' ){
                                          
                                      echo '<iframe width="430" height="315" src='.$video.' frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                      
                                    }

                                    if( $type == 'input' ){

                                      $field = "<input $maxlength class='".$class."' id='".$type."' name='".$type."_".$id."[]' type=".$type." />";
                                      echo "<br/>".$field." <font style='color:#072342;font-weight:bold;'>".$value."</font>";
                                  
                                      if( $length > 0 ){
                                          echo "<small style='color:red;font-weight:bold;'>Cantidad de texto ($length)</small>";
                                      }

                                    }

                                    $array = explode(',',$value->value);
                                    foreach ($array as $value) {

                                        if( $type == 'radio' ){

                                          $field = "<input $maxlength class='".$class."' id='".$type."' name='".$type."_".$id."[]' type=".$type." value='".$value."' />";
                                          echo "<br/>".$field." <font style='color:#072342;font-weight:bold;'>".$value."</font>";
                                      
                                          if( $length > 0 ){
                                              echo "<small style='color:red;font-weight:bold;'>Cantidad de texto ($length)</small>";
                                          }

                                        }

                                        if( $type == 'checkbox' ){

                                          $field = "<input $maxlength class='".$class."' id='".$type."' name='".$type."_".$id."[]' type=".$type." value='".$value."' />";
                                          echo "<br/>".$field." <font style='color:#072342;font-weight:bold;'>".$value."</font>";
                                      
                                          if( $length > 0 ){
                                              echo "<small style='color:red;font-weight:bold;'>Cantidad de texto ($length)</small>";
                                          }

                                        }

                                    
                                    
                                    
                                    }
                                    
                                    ?>
                                 <br>
                                 <br>
                              </div>
                           </div>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
            </div>
            <div class="modal-footer">
               <button onclick="return confirm('Desea enviar la Informaci&oacute;n?, asegurece de verificar bien los datos introducidos para asi poder garantizar y evaluar su nivel nutricional.');" type="submit" class="btn btn-primary">Enviar</button>
            </div>
         </form>
      </div>
   </div>
</div>
<?php require_once "application/views/backend/admin/question/modal/modal_question.php"; ?>
<script type="text/javascript">
   (function($) {
               /* https://learn.jquery.com/using-jquery-core/document-ready/ */
            jQuery(document).ready(function() {
                  <?php if( $this->session->userdata('user_id') !="" && $pull == 0 && $pay_users->pay == 1 ) { ?>
                      $('#CuestionModal').modal({backdrop: 'static', keyboard: false});
                  <?php } ?>
                  /* initialize the slider based on the Slider's ID attribute from the wrapper above */
                  jQuery('#rev_slider_1').show().revolution({
   
                      /* options are 'auto', 'fullwidth' or 'fullscreen' */
                      sliderLayout: 'auto',
   
                      /* basic navigation arrows and bullets */
                      navigation: {
   
                          arrows: {
                              enable: true,
                              style: "hesperiden",
                              hide_onleave: false
                          },
   
                          bullets: {
                              enable: true,
                              style: "hesperiden",
                              hide_onleave: false,
                              h_align: "center",
                              v_align: "bottom",
                              h_offset: 0,
                              v_offset: 20,
                              space: 5
   
                          }
                      }
                  });
              });
   })(jQuery);
          
</script>

