<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title><?php echo get_phrase($page_title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link name="favicon" type="image/x-icon" href="<?php echo base_url().'assets/favicon.png' ?>" rel="shortcut icon" />
    <!-- BEGIN PLUGIN CSS -->
    <?php include 'application/views/backend/includes_top.php'; ?>
  </head>
  <!-- END HEAD -->
<body class="page-body" data-url="http://neon.dev">
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
      <?php include 'application/views/backend/'.$logged_in_user_role.'/navigation.php' ?>
      <div class="main-content">
        <?php include 'application/views/backend/header.php';?>
        <br>
        <br>
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary" data-collapsed="0">
              <div class="panel-body">
                  <div hidden="" class="row" style="margin-left: -15px;">
                      <div class="col-md-3">
                          <a href = "<?php echo site_url('admin/homework/register'); ?>" class="btn btn-block btn-info" type="button"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo get_phrase('add_category'); ?></a>
                      </div>
                  </div>
                  <br>
                  <?php 
                    if( isset($message) ){
                      echo "<div class='alert alert-danger'>$message</div>";
                    }
                   ?>
                  <table class="table table-bordered datatable" id="table-1" style="width: 100%;">
                    <thead>
                      <tr>
                        <th>Item</th>
                        <th>Estudiante</th>
                        <th><?php echo get_phrase('actions'); ?></th>
                        <th>Estado</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        foreach ($obj as $key => $value): ?>
                            <?php $response = json_decode( $value['response'], true ); ?>
                            <tr>
                              <td><?php echo $key + 1; ?></td>
                              <td style="width: 30%;"><?php echo $value['first_name']." ".$value['last_name']; ?></td>
                              <td style="text-align:center;">
                                 <?php if ( $response['data']['estado'] == 'procesada' && $value['confirmation'] == 0 ) { ?>
                                  <a href='<?php echo base_url("admin/confirmation/send/".$value['model_id']."/".$value['user_id']) ?>' onclick="return confirm('¿Desea confirmar la membresia?')" >
                                    <button type="button" class="btn btn-block">
                                      Confirmar
                                    </button>
                                  </a>
                                 <?php }else if ( $response['data']['estado'] == 'procesada' && $value['confirmation'] == 1 ) { ?>
                                  <span class="label label-primary">Dado de alta</span>
                                 <?php }else{ ?>
                                  <span class="label label-info">Datos para el sistema</span>
                                 <?php } ?>
                              </td>
                              <td>
                                <?php 

                                  if( $response['data']['estado'] != 'procesada' ){
                                    echo '<span style="color:#2b303a;" class="label label-warning">'.$response['data']['estado'].'</span>';
                                  }else{
                                    echo '<span class="label label-success">'.$response['data']['estado'].'</span>';
                                  }
                                 ?>
                              </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>

        <?php include 'application/views/backend/footer.php';?>
    </div>
    </div>
</body>
<?php include 'application/views/backend/includes_bottom.php'; ?>
</html>
