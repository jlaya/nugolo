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
        <form autocomplete="off" action="<?php echo site_url('insignias/update'); ?>" method="post" role="form" enctype= multipart/form-data class="form-horizontal form-groups-bordered">
            <input type="hidden" name="id" value="<?php echo $edit->id; ?>">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Nombre de la insignia</label>

                    <div class="col-sm-5">
                        <input type="text" name="name" class="form-control" value="<?php echo $edit->name; ?>" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="valorCoin" class="col-sm-3 control-label">Moneda</label>

                    <div class="col-sm-5">
                        <input type="text" name="valorCoin" class="form-control" value="<?php echo $edit->valorCoin; ?>" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="valorExp" class="col-sm-3 control-label">Experiencia</label>

                    <div class="col-sm-5">
                        <input type="text" name="valorExp" class="form-control" value="<?php echo $edit->valorExp; ?>" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Imagen</label>

                    <div class="col-sm-5">
                        <input type="file" id="avatar" name = "avatar">
                        <small style="color: red;font-weight: bold;"><?php echo $edit->avatar; ?></small>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Rutinas</label>

                    <div class="col-sm-6">
                        <div class="content-courses"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('add_category'); ?></button>
                        <a href="<?php echo base_url('insignias'); ?>">
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
<input type="hidden" id="value_course_ids" value="<?php echo $edit->course_ids; ?>">
<script type="text/javascript">
    jQuery(document).ready(function(){

        function ajax_insignias() {
            var value_course_ids = $("#value_course_ids").val();
            $.ajax({
                url: "<?php echo site_url('insignias/ajax_insignias');?>",
                type : 'POST',
                dataType: "json",
                success: function(r)
                {
                    var content = "";
                    $.each(r, function(i,o){
                        content +="<input type='checkbox' value="+o.id+" name='course_ids[]' id='course_ids-"+o.id+"' />";
                        content +="&nbsp;&nbsp;&nbsp;<label>"+o.name+"</label><br>";
                    });

                    $("div.content-courses").append(content);

                    $.map( value_course_ids.split(","), function( val ) {
                      $("#course_ids-"+val).prop("checked",true);
                    });

                }
            });
        }

        ajax_insignias();

    });
</script>
</html>
