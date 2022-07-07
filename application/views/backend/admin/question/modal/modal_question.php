<!-- Modal -->
<div class="modal fade" id="CuestionModalUpdate" tabindex="-1" role="dialog" aria-labelledby="CuestionModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="CuestionModalLabel">Encuesta</h5>
         </div>
         <form action="<?php echo base_url('Question/update_pull') ?>" method="POST">
           <div class="alert alert-danger">
            Dar clic en cada panel para mostrar el contenido de cada cuestionario,
            <br>
            En esta oportunidad usted tiene la opción de poder actualizar los datos de la encuesta para asi
            poder garantizar bien de que los datos sean lo mas real posible para que sea atendido por el
            nutriciónista, psicóloga y fisioterapeuta.
          </div>
            <input type="hidden" name="form" value="pull">
            <div class="modal-body jumbotron">
               <div id="accordion-edit">
                  <?php foreach ($obj as $key => $value) { $relation = $value->id; ?>
                  <div class="card">
                     <div class="card-header" id="heading-<?php echo $value->id; ?>">
                        <h5 class="mb-0">
                           <button style="width: 100%;" type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-<?php echo $value->id; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $value->id; ?>">
                           <?php echo $value->title; ?>
                           </button>
                        </h5>
                     </div>
                     <div id="collapse-<?php echo $value->id; ?>" class="collapse" aria-labelledby="heading-<?php echo $value->id; ?>" data-parent="#accordion-edit">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-sm-12 alert alert-info"><?php echo trim($value->description); ?></div>
                           </div>
                           <?php $question_user = $instance->question_user_detail( $value->id ); ?>
                           <?php #echo $this->db->last_query(); ?>
                           <?php foreach ($question_user as $key => $value) { ?>
                           <div class="row">
                              <div class="col-sm-12">
                                 <?php 

                                    $id              = $value->id;
                                    $type            = $value->type;
                                    $length          = $value->length;
                                    $video           = $value->video;
                                    $res_question    = $value->res_question;
                                    $maxlength       = ( $value->length > 0 ) ? "maxlength=$value->length": "";


                                    $required        = ( $value->required == 1 ) ? "required": "";
                                    $required_field  = ( $value->required == 1 ) ? "<font style='color:red;font-weight:bold;'>*</font>": "";
                                    $class           = ( $value->type == "textarea" || $value->type == "input" ) ? "form-control": "";
                                    
                                    echo $value->question;
                                    if( $value->required == 1 ){
                                        echo " (".$required_field.")";
                                    }
                                    echo '<input type="hidden" name="id[]" value="'.$value->question_id.'"  />';

                                    if( $type =='video' ){
                                          
                                      echo '<iframe width="430" height="315" src='.$video.' frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                      
                                    }

                                    if( $type == 'input' ){

                                      $field = "<input $maxlength class='".$class."' id='".$type."' name='".$type."_".$id."[]' value='$res_question' type=".$type." />";
                                      echo "<br/>".$field." <font style='color:#072342;font-weight:bold;'>".$value."</font>";
                                  
                                      if( $length > 0 ){
                                          echo "<small style='color:red;font-weight:bold;'>Cantidad de texto ($length)</small>";
                                      }

                                    }

                                    // Campo checkbox
                                    $array = explode(',',$value->value);
                                    foreach ($array as $value) {


                                        if( $type == 'radio' ){

                                          if( $value == $res_question ){
                                            $checked_radio = 'checked';
                                          }else{
                                            $checked_radio = '';
                                          }

                                          $field = "<input $maxlength class='".$class."' id='".$type."' name='".$type."_".$id."[]' type=".$type." $checked_radio value='".$value."' />";
                                          echo "<br/>".$field." <font style='color:#072342;font-weight:bold;'>".$value."</font>";
                                      
                                          if( $length > 0 ){
                                              echo "<small style='color:red;font-weight:bold;'>Cantidad de texto ($length)</small>";
                                          }

                                        }

                                        

                                        if( $type == 'checkbox' ){

                                          if( $value == $res_question ){
                                            $checked_checkbox = 'checked';
                                          }else{
                                            $checked_checkbox = '';
                                          }

                                          $field = "<input $maxlength class='".$class."' id='".$type."' name='".$type."_".$id."[]' type=".$type." $checked_checkbox value='".$value."' />";
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
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
         </form>
      </div>
   </div>
</div>