<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>&nbsp;
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="#" class="active"><?php echo get_phrase('logs').' '.get_phrase('paguelo_facil'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i>&nbsp;<?php echo $page_title; ?></h2>
<br />

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">
                <!-- REPORT DATE RANGE SELECTOR STARTS-->
                <div class="form-group">

                  <div class="col-sm-4 col-sm-offset-4 hidden">
                        <form class="form-inline" action="<?php echo site_url('admin/enroll_history/filter_by_date_range') ?>" method="post">
                            <div class="col-md-10">
                                <div class="daterange daterange-inline add-ranges" data-format="D MMMM, YYYY" style="cursor:text;"
                              data-start-date="<?php echo date("d F, Y" , $timestamp_start);?>" data-end-date="<?php echo date("d F, Y" , $timestamp_end);?>">
                              <i class="entypo-calendar"></i>&nbsp;
                                <span id="date_range_selector" style="font-size: 12px;color:#000;">
                                  <?php echo date("d M, Y" , $timestamp_start) . " - " . date("d M, Y" , $timestamp_end);?>
                                </span>
                                <input id="date_range" type="hidden" name="date_range" value="<?php echo date("d F, Y" , $timestamp_start) . " - " . date("d F, Y" , $timestamp_end);?>">
                            </div>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-info" id="submit-button"
                              onclick="update_date_range();">
                              <?php echo get_phrase('filter');?>
                                </button>
                            </div>
                        </form>
                  </div>
                </div>
                <br>
                <hr>
                <table class="table table-bordered datatable" id="table-1">
                    <thead>
                      <tr>
                        <th><?php echo get_phrase('id'); ?></th>
                        <th><?php echo get_phrase('transaction'); ?></th>
                        <th><?php echo get_phrase('date'); ?></th>
                        <th><?php echo get_phrase('course'); ?></th>
                        <th><?php echo get_phrase('Recibo de Pago'); ?></th>
                        <th><?php echo get_phrase('user'); ?></th>
                        
                        <th><?php echo get_phrase('ip'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php  foreach($logspf as $log):
                        $user_data = $this->db->get_where('users', array('id' => $log['user_id']))->row_array();
                        $course_data = ($this->db->select('title')->where_in('id',json_decode($log['course_id']))->get('course')->result_array());?>
                        <tr class="gradeU">
                          <td><?php echo $log['id'];?></td>
                          <td>                           
                            <?php
                            $imprimir='';
                            $linea2='';
                            $linea1='';
                            $nombre='<i class="text-default fa fa-user-circle"></i>&nbsp;';
                              foreach (json_decode($log['data_transaction']) as $key => $value) {
                                $email='';
                                if($key=='Status'){
                                  if($value=='Approved'){
                                    $linea1.= '<i class="text-success fa fa-check-circle"></i>&nbsp;Aprobado';
                                  }else{
                                    $linea1.= '<i class="text-danger fa fa-minus-circle"></i>&nbsp;Rechazado';
                                  }
                                }
                                if($key=='Amount'){
                                   $linea1.=' <i class="text-default fa fa-dollar"></i>'.number_format($value,2);
                                }
                               
                                if($key=='Date'){
                                   $linea2.='<br>';
                                  $array = str_split($value, 2); 
                                  $linea2.= '<i class="text-default fa fa-calendar"></i>&nbsp;'.$array[0].'.'.$array[1].'.'.$array[2];
                                }
                                if($key=='Time'){
                                  $array = str_split($value, 2); 
                                  $linea2.= ' <i class="text-default fa fa-clock"></i>&nbsp;'.$array[0].':'.$array[1].':'.$array[2];
                                }
                                if($key=='CardType'){
                                   
                                   $linea1.= '<br><i class="text-default fa fa-credit-card"></i>&nbsp;'.(($value=='MC')?'MASTER CARD':(($value=='VISA')?'VISA':$value));
                                }
                                
                                if($key=='Name'||$key=='LastName'){
                                  $nombre.=$value.' ';
                                }
                                if($key=='Email'){
                                  $email='<br><i class="text-default fa fa-envelope"></i>&nbsp;'.$value;
                                }
                              if($key=='error'){
                                $imprimir='<i class="text-danger fa fa-times"></i>&nbsp;'.$value;
                              }             
                            }                              if(empty($linea1)&&$imprimir==''){
                                $imprimir='<i class="text-danger fa fa-times"></i>&nbsp;Error';
                              }
                              if($imprimir==''){
                              $imprimir= '<p class="text-justify">'.$linea1.' '.$linea2.' <br>'.$nombre.' '.$email.'</p>';
                              }

                            
                            echo $imprimir;
                             ?>

                          </td>
                          <td><?php echo date('d.m.Y',$log['date_transaction']);?></td>
                          <td><p class="text-justify"><small><?php foreach ($course_data as $key => $course) {
                          echo '<i class="fa fa-check text-info"></i> '.$course['title'].'<br>';
                        }?></small></p></td>
                          <td><?php echo (empty($log['fact_num']))?'No Disponible':$log['fact_num'];?></td>
                          <td><?php echo $user_data ['first_name'].' '.$user_data ['last_name'].'<br><small>'.$user_data ['email'].'</small>';?></td>
                          
                          <td>
                            <?php echo (($log['ip']=='::1'||$log['ip']=='localhost'||$log['ip']=='127.0.0.1'||$log['ip']==''||$log['ip']==NULL)?'<small>Sin Información</small>':$log['ip']);?>
                          </td>
                        </tr>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function update_date_range()
{
  var x = $("#date_range_selector").html();
  $("#date_range").val(x);
}
</script>