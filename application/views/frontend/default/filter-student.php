<?php $users = $this->crud_model->getUsers(); ?>
<?php
    $userdata = $this->session->userdata();
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">
                <form action="<?php echo base_url('admin/previewPdf'); ?>" method="GET">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if( $userdata['role_id'] == 1 ){ ?>
                            <label for="student">Estudiante</label>
                            <select class="form-control select2" name="user_id">
                                <option value="0">Todos</option>
                                <?php foreach ($users as $key => $value) { ?>
                                <option value="<?php echo $value->id; ?>">
                                    <?php echo $value->first_name. ' ' . $value->last_name; ?>
                                </option>
                                <?php } ?>
                            </select>
                            <?php }else{ ?>
                                <input type="hidden" name="user_id" value="<?php echo $userdata['user_id']; ?>">
                            <?php } ?>
                            <button type="submit" class="btn btn-primary">Generar informe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>