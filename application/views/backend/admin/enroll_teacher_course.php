<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="<?php echo site_url('admin/enroll_history'); ?>"><?php echo get_phrase('enroll_history'); ?></a> </li>
    <li><a href="#" class="active"><?php echo get_phrase('enroll_a_student'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <div class="panel panel-primary" data-collapsed="0" style="width: 100%;">
            <div class="panel-heading">
                <div class="panel-title" hidden="">
                    <?php echo get_phrase('enrollment_form'); ?>
                </div>
            </div>
            <div class="panel-body">
                <form action="<?php echo site_url('admin/enroll_teacher_course/enroll'); ?>" method="post" role="form" class="form-horizontal form-groups-bordered">
                    <div class="col-sm-10">
                        <select class="form-control select2" name="course_id" required>
                            <?php $course_list = $this->crud_model->get_courses()->result_array();
                                foreach ($course_list as $course):
                                if ($course['status'] != 'active')
                                    continue;?>
                                <option value="<?php echo $course['id'] ?>"><?php echo $course['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                    <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('add_category'); ?></button>
                    </div>
                    <div style="width: 100%;">
                    <table class="table table-bordered datatable" id="table-1" style="width: 100%;">
                        <thead>
                          <tr>
                            <th style="width: 5%;">Vincular</th>
                            <th>Profesor</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            foreach ($user_detail as $key => $value): ?>
                                <tr>
                                  <td><input type="checkbox" id="user_id" name="user_id[]" value="<?php echo $value->id; ?>" /></td>
                                  <td><?php echo $value->first_name.' '.$value->last_name; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                      </table>
                      </div>
                  </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function is_checked( id ){
        
        var is_checked = $('#is_checked').is(':checked');
        
        if( is_checked == true ){
            is_checked = 1;
        }else{
            is_checked = 0;
        }
        
        $.ajax({
            url: '<?php echo site_url('admin/is_checked');?>',
            type : 'POST',
            data : {
                'id' : id,
                'is_checked' : is_checked
            },
            success: function( response )
            {}
        });
    }

    function is_verify( is_verify, id, user_id ){

        $.ajax({
            url: '<?php echo site_url('admin/is_verify');?>',
            type : 'POST',
            data : {
                'id' : id,
                'is_verify' : is_verify,
                'user_id' : user_id
            },
            success: function( response )
            {
                location.reload();
            }
        });

    }

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

</script>