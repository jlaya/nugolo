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
                  <div class="row" style="margin-left: -15px;">
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
                        <th>Tarea</th>
                        <th><?php echo get_phrase('actions'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        foreach ($obj as $key => $value): ?>
                            <tr>
                              <td><?php echo $key + 1; ?></td>
                              <td style="width: 30%;"><?php echo $value['name']; ?></td>
                              <td>
                                <a href='<?php echo base_url("admin/homework/edit/".$value['id']) ?>'>
                                  <button class="btn btn-info">Editar</button>
                                </a>
                                |
                                <a href='<?php echo base_url("admin/homework/delete/".$value['id']) ?>'>
                                  <button class="btn btn-danger">Eliminar</button>
                                </a>
                                |
                                <a href='<?php echo base_url("admin/homework/joins/".$value['id']) ?>?name=<?php echo $value['name']; ?>'>
                                  <button class="btn btn-primary">Unir participantes</button>
                                </a>
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
