<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="#" class="active"><?php echo get_phrase($page_title); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-body">
                <div class="row" style="margin-left: -15px;">
                    <div class="col-md-3">
                        <a href = "<?php echo site_url('admin/user_form/add_user_form'.$para); ?>" class="btn btn-block btn-info" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add').' '.get_phrase($page_title); ?></a>
                    </div>
                </div>
                <table class="table table-bordered datatable" id="table-1">
                    <thead>
                      <tr>
                        <th><?php echo get_phrase('photo'); ?></th>
                        <th><?php echo get_phrase('name'); ?></th>
                        <th><?php echo get_phrase('email'); ?></th>
                        <th><?php echo get_phrase('date_added'); ?></th>
                        <th><?php echo get_phrase('enrolled_courses'); ?></th>
                        <th><?php echo get_phrase('actions'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users->result_array() as $user): ?>
                            <tr class="gradeU">
                              <td>
                                  <img src="<?php echo $this->user_model->get_user_image_url($user['id']);?>" alt="" height="50" width="50" class="img-fluid">
                              </td>
                              <td><?php echo $user['first_name'].' '.$user['last_name']; ?></td>
                              <td><?php echo $user['email']; ?></td>
                              <td><?php echo date('D, d-M-Y', $user['date_added']); ?></td>
                              <td>
                                 <?php
                                    $enrolled_courses = $this->crud_model->enroll_history_by_user_id($user['id']);?>
                                    <ul>
                                        <?php foreach ($enrolled_courses->result_array() as $enrolled_course):
                                            $course_details = $this->crud_model->get_course_by_id($enrolled_course['course_id'])->row_array();?>
                                            <li><?php echo $course_details['title']; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                              </td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-default" data-toggle="dropdown"> <i class = "fa fa-ellipsis-v"></i> </button>
                                      <ul class="dropdown-menu">
                                          <li>
                                              <a href="<?php echo site_url('admin/user_form/edit_user_form/'.$user['id'].'/'.$user['role_id']) ?>">
                                                  <?php echo get_phrase('edit');?>
                                              </a>
                                          </li>
                                          <li class="divider"></li>
                                          <li>
                                              <a href="#" onclick="confirm_modal('<?php echo site_url('admin/users/delete/'.$user['id'].'/'.$user['role_id']); ?>');">
                                                  <?php echo get_phrase('delete');?>
                                              </a>
                                          </li>
                                          <li>
                                            <a>
                                              ¿Activar?
                                              <?php
                                                if( $user['status'] == 0 ){
                                                  $checked = "";
                                                }else{
                                                  $checked = "checked";
                                                }
                                              ?>
                                              <input class="is_status" id="is_status" data-id="<?php echo $user['id']; ?>" <?php echo $checked; ?> type="checkbox" />
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


<div class="row">
    <div class="col-md-12">
      <div class="grid simple">
        <div class="grid-body no-border">


          <div class="row">
              <br>

          </div>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">

  $(document).on("click", ".table tbody tr td .is_status", function() {
        //some think
        var is_checked = $(this).is(':checked');
        var id         = $(this).data("id");
        
        $.ajax({
            url: '<?php echo site_url("admin/is_status");?>',
            type : 'POST',
            data : {
                'id' : id,
                'is_checked' : is_checked
            },
            success: function( response )
            {}
        });

  });

  function is_status( status, id ){

        $.ajax({
            url: '<?php echo site_url('admin/is_status');?>',
            type : 'POST',
            data : {
                'id' : id,
                'status' : status
            },
            success: function( response )
            {}
        });

    }
</script>
