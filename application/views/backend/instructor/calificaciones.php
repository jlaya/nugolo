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
                <div class="div-2" style="display: none;">
                    <form id="formSend" method="POST">
                        <input type="hidden" name="user_id" id="value-user_id">
                        <input type="hidden" name="course_id" id="value-course_id">
                        <input type="hidden" name="category_id" id="value-category_id">
                        <input type="hidden" name="tutor_id" id="value-tutor_id">
                        <div class="row">
                            <div class="col-md-12">
                                <textarea style="width: 100%;" class="form-horizontal" id="messageSend" name="messageSend" placeholder="Escribir mensaje aqui..."></textarea>
                                <small style="color: red;">Para enviar el mensaje debe dar a la tecla Intro.</small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="div-1">
                    <form action="<?php echo site_url('admin/enroll_teacher_course/enroll'); ?>" method="post" role="form" class="form-horizontal form-groups-bordered">
                        <div style="width: 100%;">
                        <table class="table table-bordered datatable" id="table-1" style="width: 100%;">
                            <thead>
                              <tr>
                                <th style="width: 30%;">Alumno</th>
                                <th>Curso</th>
                                <th style="width: 5%;">Documento</th>
                                <th style="width: 5%;">Mensaje</th>
                                <th style="width: 5%;">SI</th>
                                <th style="width: 5%;">NO</th>
                                <th style="width: 5%;">Logros</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                #echo $this->session->userdata('user_id');
                                #print_r($obj);
                                $counter = 1;
                                foreach ($obj as $key => $value): ?>
                                    <tr>
                                      <td><?php echo $value->first_name.' '.$value->last_name; ?></td>
                                      <td><?php echo $value->title; ?></td>
                                      <td>
                                          <a target="_blank" href="<?php echo base_url($value->doc); ?>">Ver</a>
                                      </td>
                                      <td>
                                          <button type="button" title="Escribir mensaje..." class="btn btn-success" onclick="getMessage(<?php echo $value->user_id; ?>,<?php echo $value->course_id; ?>,<?php echo $value->category_id; ?>,<?php echo $value->tutor_id; ?>)">Abrir</button>
                                      </td>
                                      <td><input type="checkbox" class="yes yes-<?php echo $value->id; ?>" id="user_id" data-id="<?php echo $value->id; ?>" <?php echo ( $value->yes == 1 ? "checked" : "" ) ?> /></td>
                                      <td><input type="checkbox" class="no no-<?php echo $value->id; ?>" id="user_id" data-id="<?php echo $value->id; ?>" <?php echo ( $value->no == 1 ? "checked" : "" ) ?> /></td>
                                      <td>
                                          <a class="btn btn-primary" target="_blank" href="<?php echo base_url('admin/pdf/'.$value->user_id); ?>">
                                              Ver
                                          </a>
                                      </td>
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
</div>
<script type="text/javascript">

    function getMessage( user_id, course_id, category_id, tutor_id ){
        $(" #value-user_id ").val( user_id );
        $(" #value-course_id ").val( course_id );
        $(" #value-category_id ").val( category_id );
        $(" #value-tutor_id ").val( tutor_id );
        $(" .div-2 ").show(1000);
    }

    $('#messageSend').keyup(function(event) {
        var dataSend = $("#formSend").serialize();
        if (event.which === 13)
        {
            event.preventDefault();
            $.ajax({
                url: '<?php echo site_url("document/saveMessage");?>',
                type : 'POST',
                data : dataSend,
                success: function( response )
                {
                    $(" #messageSend ").val('');
                }
            });
        }
    });
    
    // Chequear si se calificara positivo
    $(document).on("click", ".table tbody tr td .yes", function() {
        //some think
        var id         = $(this).data("id");
        var is_checked = $(this).is(':checked');
        
        $.ajax({
            url: '<?php echo site_url("document/is_approved_yes");?>',
            type : 'POST',
            data : {
                'id' : id,
                'yes' : is_checked
            },
            success: function( response )
            {
                $(".no-"+id).prop("checked",false);
            }
        });
    });

    // Chequear si no se calificara positivo
    $(document).on("click", ".table tbody tr td .no", function() {
        //some think
        var id         = $(this).data("id");
        var is_checked = $(this).is(':checked');
        
        $.ajax({
            url: '<?php echo site_url("document/is_approved_yes");?>',
            type : 'POST',
            data : {
                'id' : id,
                'no' : is_checked
            },
            success: function( response )
            {
                $(".yes-"+id).prop("checked",false);
            }
        });
    });

</script>