<?php 
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
<body class="page-body" data-url="http://neon.dev">
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
      <?php include 'application/views/backend/'.$logged_in_user_role.'/navigation.php' ?>
      <div class="main-content">
        <?php include 'application/views/backend/header.php';?>
        <br>
        <br>
        <form autocomplete="off" action="<?php echo site_url('announce/add'); ?>" method="post" role="form" enctype= multipart/form-data class="form-horizontal form-groups-bordered">
            <input type="hidden" name="id" value="0">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Titulo</label>

                    <div class="col-sm-5">
                        <input type="text" name="title" class="form-control" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Link</label>

                    <div class="col-sm-5">
                        <input type="url" name="url" class="form-control">
                    </div>
                </div>

                <div class="form-group" style="display: <?php echo $show_image; ?>;">
                    <label for="field-1" class="col-sm-3 control-label">Imagen</label>

                    <div class="col-sm-5">
                        <input type="file" id="image" name = "image">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('add_category'); ?></button>
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
<script type="text/javascript">
    $( document ).ready(function() {
        
        $('#course_id,#name').keyup(function(){
            var href  = $("#course_id").find(':selected').attr('data-url');
            var name  = $("#name").val();
            var url   = "";

            if( href !="" && name !="" ){
                url = "<a href='"+ href +"' target='_blank'>"+ name +"</a>";
            }

            $( "#url" ).val( href );
            $( "span.show-url" ).html( url );
            
        });

    });
</script>
</html>
