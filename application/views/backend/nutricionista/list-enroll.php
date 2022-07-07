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
                  <div class='alert alert-info'>
                    <?php echo strtoupper($course->title); ?>
                  </div>
                  <table class="table table-bordered datatable" id="table-1">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('photo'); ?></th>
                            <th><?php echo get_phrase('user_name'); ?></th>
                            <th><?php echo get_phrase('email'); ?></th>
                            <th><?php echo get_phrase('enrolled_course'); ?></th>
                            <th><?php echo get_phrase('enrollment_date'); ?></th>
                            <th><?php echo get_phrase('actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($obj as $enroll):
                            //$user_data = $this->db->get_where('users', array('id' => $enroll['user_id']))->row_array();
                            //print_r($user_data);
                            //$course_data = $this->db->get_where('course', array('id' => $enroll['course_id']))->row_array();?>
                            <tr class="gradeU">
                                <td>
                                    <img src="<?php echo $this->user_model->get_user_image_url($enroll['user_id']); ?>" alt="" height="50" width="50">
                                </td>
                                <td>
                                    <?php echo $enroll['first_name'].' '.$enroll['last_name']; ?>
                                </td>
                                <td><?php echo $enroll['email']; ?></td>
                                <td><?php echo $enroll['course']; ?></td>
                                <td><?php echo date('D, d-M-Y', $enroll['date_added']); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" data-toggle="dropdown"> <i class = "fa fa-ellipsis-v"></i> </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a onclick="confirm_modal('<?php echo site_url('admin/enroll_history_delete/'.$enroll['id'].'/'.$course->id); ?>');">
                                                    <?php echo get_phrase('delete');?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <?php include 'application/views/backend/modal.php';?>
        <?php include 'application/views/backend/footer.php';?>
    </div>
    </div>
</body>
<?php include 'application/views/backend/includes_bottom.php'; ?>
</html>
