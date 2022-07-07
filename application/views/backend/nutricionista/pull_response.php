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
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        foreach ($obj as $key => $value): ?>
                            <tr>
                              <td><?php echo $key + 1; ?></td>
                              <td style="width: 80%;"><?php echo $value->first_name. ' ' .$value->last_name; ?></td>
                              <td>
                                  <button class="btn btn-info detail-response" data-toggle="modal" data-target="#ResponseModal" data-names="<?php echo $value->first_name. ' ' .$value->last_name; ?>" data-id="<?php echo $value->id; ?>" >Ver</button>
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

<script type="text/javascript">
  $('button.detail-response').click(function(){
    
    var user_id = $(this).data('id');
    var names   = $(this).data('names');
    $("h5#header-name").text(names);

    $.ajax({
       type:"POST", // la variable type guarda el tipo de la peticion GET,POST,..
       url:"<?php echo base_url('Question/ajax_pull'); ?>",
       data: {'user_id': user_id },
       success:function( response ){
         var option = '';
         option += '<ul>';
         $.each( response , function(index, value) {
           //console.log(value.paisnombre)
           option += '<li style="color:#2B3A4A;font-weight:bold;"><div>'+value.question+'</div></li>';
           option += '<div style="color:#000;background-color:#D5D5D6;padding: 2% 2% 2% 2%;">'+value.response+'</div>';
         });
         option += '<ul>';
         $("div.response-question").append(option);
        },
       dataType: 'json' // El tipo de datos esperados del servidor. Valor predeterminado: Intelligent Guess (xml, json, script, text, html).
   });

  });
</script>

<!-- Modal -->
<div class="modal fade" id="ResponseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="header-name"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="response-question"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


