<link rel="favicon" href="<?php echo base_url().'assets/frontend/img/icons/favicon.ico' ?>">
<link rel="apple-touch-icon" href="<?php echo base_url().'assets/frontend/img/icons/icon.png'; ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/css/jquery.webui-popover.min.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/css/select2.min.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/css/slick.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/css/slick-theme.css'; ?>">
<!-- font awesome 5 -->
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/css/fontawesome-all.min.css'; ?>">
<!-- font awesome 4 -->
<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/font-icons/font-awesome-new/css/font-awesome.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/webfonts/gotham-ultra.ttf' ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/css/bootstrap.min.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/css/bootstrap-tagsinput.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/css/main.css'; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/frontend/css/custom-home.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/css/responsive.css'; ?>">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/frontend/landingpage/toastr.css'); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/frontend/revolution/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css'; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/frontend/revolution/fonts/font-awesome/css/font-awesome.css'; ?>">

<!-- REVOLUTION STYLE SHEETS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/frontend/revolution/css/settings.css'; ?>">
<!-- REVOLUTION LAYERS STYLES -->		
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/frontend/revolution/css/layers.css'; ?>">
<!-- REVOLUTION NAVIGATION STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/frontend/revolution/css/navigation.css'; ?>">

<!-- Slider Revolution CSS Files -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/frontend/revolution/css/settings.css'; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/frontend/revolution/css/layers.css'; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/frontend/revolution/css/navigation.css'; ?>">
<!-- jquery -->
<script src="<?php echo base_url('assets/backend/login/jquery-3.3.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/toastr.js'); ?>"></script>

<!--<script src="<?php echo base_url('assets/backend/js/jquery-1.11.0.min.js'); ?>"></script>-->
<script type="text/javascript">
    function removeMenu() {
    if (event.button == 2) {
        parent.frames.location.replace('javascript: parent.dummy1');
    }
    removeMenu();
</script>
<script type="text/javascript">
	$(document).ready(function() {
    
	    var notifications_users = function(){
	    	//se utiliza $.ajax(), a la cual se le pasa un objeto {}, con la información
	       $.ajax({
	           type:"POST", // la variable type guarda el tipo de la peticion GET,POST,..
	           url:"<?php echo base_url('admin/homework/notifications_users'); ?>", //url guarda la ruta hacia donde se hace la peticion
	           success:function(obj){ //success es una funcion que se utiliza si el servidor retorna informacion
	           	var html = "";
       			html += '<p><h5>Se le recuerda que debe participar en las siguiente(s) Actividades, las mismas tiene una fecha de caducida en el cual debe cumplir antes del cierre de los mismos</h5></p>';
       			html += '<ul>';
	           	$.each(obj, function (index, o) {
	           		if( o.is_date == 'true' ){
	           			html += '<li>'+o.name+'</li>';
	           		}
				}); 
       			html += '</ul>';
       			//alert(html);
       			if( obj != null ){
       				toastr.error(html);
       			}
       			
	            },
	           dataType: 'json' // El tipo de datos esperados del servidor. Valor predeterminado: Intelligent Guess (xml, json, script, text, html).
	       });
	    }

        var user_id = "<?php echo $this->session->userdata('user_id'); ?>";

        if( user_id !="" ){

    	    // llamado automatico, se mostra los mensajes en 10 minutos
    	    setInterval(function(){
    	    	notifications_users();
    		    var message_videos = "Se le recuerda que al terminar de ver el paquete debe marcar que ya lo terminó de ver, asi se tendrá mayor control en las Actividades de entrenamiento...";
    		    toastr.warning(message_videos);
    	    }, 600000);
            
        }


	});
</script>
<!-- Modal -->
        <div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content sign-in-modal">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo get_phrase('log_in_to_your_account'); ?>!</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo site_url('login/validate_login/user'); ?>" method="post">
                            <div class="input-group">
                                <span class="input-field-icon"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="<?php echo get_phrase('email'); ?>">
                            </div>
                            <div class="input-group">
                                <span class="input-field-icon"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="<?php echo get_phrase('password'); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary"><?php echo get_phrase('log_in'); ?></button>
                            <div class="forgot-pass">
                                <span></span>
                                <a href="" data-toggle="modal" data-target="#forgotModal" data-dismiss="modal"><?php echo get_phrase('forgot_password'); ?></a>
                            </div>
                        </form>
                        <div class="agreement-text">
                            <?php echo get_phrase('by_signing_up_you_agree_to_our'); ?> <a href="#"><?php echo get_phrase('terms_of_use'); ?></a> <?php echo get_phrase('and'); ?> <a href="#"><?php echo get_phrase('privacy_policy'); ?></a>.
                        </div>
                        <div class="account-have">
                            <?php echo get_phrase('do_not_have_an_account'); ?>? <a href="" data-toggle="modal" data-target="#signUpModal" data-dismiss="modal"><?php echo get_phrase('sign_up'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Modal -->


        <!-- Modal -->
        <div class="modal fade" id="forgotModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content sign-in-modal">
                    <div class="modal-header">
                        <h5 class="modal-title">Forgot Password</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo site_url('login/forgot_password/frontend'); ?>" method="post">
                            <div class="input-group">
                                <input type="email" name = "email" class="form-control forgot-email" placeholder="E-mail">
                            </div>
                            <div class="forgot-pass-btn">
                                <button type="submit" class="btn btn-primary d-inline-block">Reset Password</button>
                                <span>or</span>
                                <a href="" data-toggle="modal" data-target="#signInModal" data-dismiss="modal">Log In</a>
                            </div>
                        </form>
                        <div class="forgot-recaptcha">

                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Modal -->

        <!-- Modal -->
        <div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content sign-in-modal">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo get_phrase('sign_up_and_start_learning'); ?>!</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <object type="application/php" data='<?php echo base_url("registro");?>' style="width:93%; height:655px;">
                          <embed src='<?php echo base_url("registro");?>' style="width:100%; height:590px;" frameborder="0" style="border:0;">
                        </object>
                        <div class="account-have">
                            <?php echo get_phrase('already_have_an_account'); ?>? <a href="" data-toggle="modal" data-target="#signInModal" data-dismiss="modal"><?php echo get_phrase('log_in'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Modal -->

