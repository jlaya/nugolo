<?php
    $courses = $this->user_model->get_rutinas()->result();
    if( $role_id == 1 ){
        $show_image = 'block';
    }else{
        $show_image = 'none';
    }
?>
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
<body class="page-body">
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
      <?php include 'application/views/backend/'.$logged_in_user_role.'/navigation.php' ?>
      <div class="main-content">
        <?php include 'application/views/backend/header.php';?>
        <br>
        <br>
        <form id="formsAnuncio" action="<?php echo site_url('announce/add'); ?>" method="post">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="form-group">

                    <div class="col-sm-12">
                        <select required="" class="form-control select2" id="status" name="status">
                            <option value="">---</option>
                            <option value="1">Activo</option>
                            <option value="0">Bloqueado</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">

                    <div class="col-sm-12">
                        <input type="text" name="title" id="titles" class="form-control" placeholder="Titulo" required="">
                    </div>
                </div>

                <div class="form-group">

                    <div class="col-sm-12">
                        <textarea class="form-control" id="html" name="html" required=""></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button class = "btn btn-success" type="submit" onclick="envio()" name="button"><?php echo get_phrase('add_category'); ?></button>
                        <a href="<?php echo base_url('announce'); ?>">
                            <button class = "btn btn-info" type="button">Volver</button>
                        </a>
                    </div>
                </div>
            </div>
        </form>
        <?php include 'application/views/backend/footer.php';?>
    </div>
    </div>
</body>
<?php include 'application/views/backend/includes_bottom.php'; ?>
<script src="<?php echo base_url('assets/global/js/htmeditor.min.js'); ?>" htmeditor_textarea="html" full_screen="no" editor_height="480" run_local="no"> </script>
<script type="text/javascript">
    function envio(){
        document.getElementById("formsAnuncio").submit();
    }
</script>
</html>
