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
        <form autocomplete="off" action="<?php echo site_url('admin/homework/add'); ?>" method="post" role="form" class="form-horizontal form-groups-bordered">
            <input type="hidden" name="id" value="0">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Desde</label>

                    <div class="col-sm-5">
                        <input type="date" name="range_from" class="form-control" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Hasta</label>

                    <div class="col-sm-5">
                        <input type="date" name="range_to" class="form-control" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Curso</label>

                    <div class="col-sm-5">
                        <select class="form-control" id="course_id" name="course_id" required="">
                            <option value="">---------</option>
                            <?php foreach ($course as $key => $value) { ?>
                            <option data-url="<?php echo site_url('home/course/'.slugify($value['title']).'/'.$value['id']); ?>" value="<?php echo $value['id']; ?>">
                                <?php echo $value['title']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Tarea</label>

                    <div class="col-sm-5">
                        <input type="text" id="name" name = "name" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Color</label>

                    <div class="col-sm-5">
                        <input type="color" id="color" name = "color" class="form-control" value="<?php echo $color; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Enlace</label>

                    <div class="col-sm-5">
                        <span style="color: red;" class="show-url"></span>
                        <input type="hidden" id="url" name = "url" class="form-control" required>
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
