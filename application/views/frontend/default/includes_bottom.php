

<?php 
   // Load models
   require_once "application/models/Question_model.php";
   $instance = new Question_model();
   $obj  = $instance->question_info();
   #$pull = $instance->exists_pull( "pull", $this->session->userdata('user_id') );
   $pay_users = $instance->exists_users_detail( $this->session->userdata('user_id') );
   ?>
<script src="<?php echo base_url().'assets/frontend/js/vendor/modernizr-3.5.0.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/vendor/jquery-3.2.1.min.js'; ?>"></script>
<script src="<?php echo base_url('assets/backend/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js'); ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/popper.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/bootstrap.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/slick.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/select2.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/tinymce.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/multi-step-modal.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/jquery.webui-popover.min.js'; ?>"></script>
<script src="https://content.jwplatform.com/libraries/O7BMTay5.js"></script>
<script src="<?php echo base_url().'assets/frontend/js/main.js'; ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
<script src="<?php echo base_url().'assets/frontend/js/bootstrap-tagsinput.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/custom.js'; ?>"></script>
<!-- SHOW TOASTR NOTIFIVATION -->
<?php if ($this->session->flashdata('flash_message') != ""):?>
<script type="text/javascript">
   toastr.success('<?php echo $this->session->flashdata("flash_message");?>');
</script>
<?php endif;?>
<?php if ($this->session->flashdata('error_message') != ""):?>
<script type="text/javascript">
   toastr.error('<?php echo $this->session->flashdata("error_message");?>');
</script>
<?php endif;?>
<!-- Slider Revolution core JavaScript files -->
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/jquery.themepunch.tools.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/jquery.themepunch.revolution.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.actions.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.carousel.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.kenburn.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.layeranimation.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.migration.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.navigation.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.parallax.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.slideanims.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/frontend/revolution/js/extensions/revolution.extension.video.min.js'; ?>"></script>
<?php require_once "application/views/backend/admin/question/modal/modal_question.php"; ?>


