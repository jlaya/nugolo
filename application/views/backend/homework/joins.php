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
        <div class="alert alert-info">
            <?php $name = $this->input->get('name'); echo $name; ?>
        </div>
        <form action="<?php echo site_url('admin/homework/join_people'); ?>" method="post" role="form" class="form-horizontal form-groups-bordered">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Participante</label>
                    <input type="hidden" id="join_id" name="join_id" value="<?php echo $id; ?>">
                    <div class="col-sm-5">
                        <select class="form-control" id="user_id" name="user_id" required="">
                            <option value="">---------</option>
                            <?php foreach ($users as $key => $value) { ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->first_name." ".$value->last_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('add_category'); ?></button>
                        <a href="<?php echo base_url('admin/homework'); ?>">
                            <button class = "btn btn-info" type="button">Volver</button>
                        </a>
                    </div>
                </div>
            </div>
            </form>
            <br>
            <br>
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="form-group">
                    
                    <div class="col-sm-12">
                        <table class="table table-bordered datatable" id="table-1">
                            <thead>
                              <tr>
                                <th>Item</th>
                                <th>Participante</th>
                                <th><?php echo get_phrase('actions'); ?></th>
                                <th>Verificado</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                foreach ($people as $key => $value): ?>
                                    <tr>
                                      <td><?php echo $key + 1; ?></td>
                                      <td><?php echo $value->first_name." ".$value->last_name; ?></td>
                                      <td>
                                        <a href='<?php echo base_url("admin/homework/delete_people/$value->id/$id") ?>?name=<?php echo $name; ?>'>
                                          <button class="btn btn-danger">Eliminar</button>
                                        </a>
                                      </td>
                                      <td>
                                          <?php if( $value->is_checked == 1 ){ ?>
                                            <label class="alert alert-info">SI</label>
                                          <?php }else{ ?>
                                            <label class="alert alert-danger">NO</label>
                                          <?php } ?>
                                      </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        <?php include 'application/views/backend/footer.php';?>
    </div>
    </div>
</body>
<?php include 'application/views/backend/includes_bottom.php'; ?>
</html>
