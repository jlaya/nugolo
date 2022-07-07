 <style>
    .demo-container {
        width: 100%;
        max-width: 350px;
        margin: 50px auto;
    }
    .input-effect{margin-top: 0.5rem}
    .input {
      background-color: #fff;
      border:none;
      border-bottom: 1px solid #505763; 
      font: 15px/24px "Lato", Arial, sans-serif; 
      color: #333; 
      width: 100%; 
      box-sizing: border-box; 
      letter-spacing: 1px;
      margin:0 -10px;
  }
  :focus{outline: none;}
  .effect-16 ~ .focus-border{position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background-color: #2b3e5c; transition: 0.4s;}
  .effect-16:focus ~ .focus-border,
  .has-content.effect-16 ~ .focus-border{width: 100%; transition: 0.4s;}
  .effect-16 ~ label{position: absolute; left: 0; width: 100%; top: 9px; color: #aaa; transition: 0.3s; z-index: -1; letter-spacing: 0.5px;}
  .effect-16:focus ~ label, .has-content.effect-16 ~ label{top: -16px; font-size: 12px; color: #2b3e5c; transition: 0.3s;}
  .titlecard{text-transform: capitalize; font-weight: bolder; color: #2b3e5c !important; font-size: 12px;}
</style>       
        <!--<section class="footer-top-widget-area">
            <div class="container-xl">
                <div class="row">
                     <div class="col-md-3 col-sm-6">
                        <div class="footer-widget link-widget">
                            <ul>
                                <li><a href=""><b>Udemy for Business</b></a></li>
                                <li><a href=""><b>Become an Instructor</b></a></li>
                                <li><a href="">Mobile Apps</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-widget link-widget">
                            <ul>
                                <li><a href="<?php echo site_url('home/about_us'); ?>"><?php echo get_phrase('about_us'); ?></a></li>
                                <li><a href="<?php echo site_url('home/blog'); ?>"><?php echo get_phrase('blog'); ?></a></li>
                            </ul>
                        </div>
                    </div>-->
                    <!-- <div class="col-md-offest-6 col-md-3 col-sm-6 pull-right">
                        <div class="footer-widget language-widget text-right">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="languageButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-globe"></i>English
                                </button>
                                <div class="dropdown-menu" aria-labelledby="languageButton">
                                    <a class="dropdown-item" href="#">English</a>
                                    <a class="dropdown-item" href="#">Deutsch</a>
                                    <a class="dropdown-item" href="#">Español</a>
                                    <a class="dropdown-item" href="#">Français</a>
                                    <a class="dropdown-item" href="#">Français</a>
                                    <a class="dropdown-item" href="#">Italiano</a>
                                    <a class="dropdown-item" href="#">日本語</a>
                                    <a class="dropdown-item" href="#">한국어</a>
                                    <a class="dropdown-item" href="#">Nederlands</a>
                                    <a class="dropdown-item" href="#">Polski</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->

        <footer class="footer-area" id="wrap">
            <div class="container-xl " id="main">
                <div class="row align-items-center" style="margin-top: 6px; height: 100%;" >
                    <div class="col-md-6">
                        <div class="row align-items-center" style="height: 100%;">
                            <div class="col-xl-3 col-md-12 col-lg-3 copyright-img">
                             <a href=""><img src="<?php echo base_url().'assets/frontend/img/logo.png'; ?>" alt="" class="d-inline-block" width="110"></a>
                            </div>
                            <div class="col-xl-6 col-md-12 col-lg-8 copyright-text">
                             <a href="<?php echo get_settings('footer_link'); ?>" target="_blank"><?php echo get_settings('footer_text'); ?></a>&nbsp;&copy <?php echo date('Y')?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <ul class="nav justify-content-md-end footer-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('about'); ?>"><?php echo get_phrase('about'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('home/privacy'); ?>"><?php echo get_phrase('privacy_policy'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('home/terms'); ?>"><?php echo get_phrase('terms_&_condition'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('login'); ?>" target="_blank">
                                    <?php echo get_phrase('admin'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>



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
                          <embed src='<?php echo base_url("registro");?>' style="width:93%; height:655px;" frameborder="0" style="border:0;">
                        </object>
                        <div class="account-have">
                            <?php echo get_phrase('already_have_an_account'); ?>? <a href="" data-toggle="modal" data-target="#signInModal" data-dismiss="modal"><?php echo get_phrase('log_in'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Modal -->



        <!-- PAYMENT MODAL -->
        <!-- Modal -->
        <?php
        $paypal_info = json_decode(get_settings('paypal'), true);
        $stripe_info = json_decode(get_settings('stripe_keys'), true);
        $paguelo_info = json_decode(get_settings('paguelofacil'), true);
        if ($paypal_info[0]['active'] == 0) {
            $paypal_status = 'disabled';
        }else {
            $paypal_status = '';
        }
        if ($stripe_info[0]['active'] == 0) {
            $stripe_status = 'disabled';
        }else {
            $stripe_status = '';
        }
        if ($paguelo_info[0]['active'] == 0) {
            $paguelo_info = 'disabled';
        }else {
            $paguelo_info = '';
        }
        ?>
        <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content payment-in-modal">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo get_phrase('Paguelo_Facil'); ?>!</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form"  method="post" id="paguelofacil" action="#">
                                    <input type="hidden" class = "total_price_of_checking_out" name="total_price_of_checking_out" value="">
                                    <div class=" demo-container">                                        
                                        <div class="card-wrapper"></div>                                                                                <div class="form-container active">
                                            <br>
                                            <div class="row">
                                                <div class="text-muted titlecard"><?php echo get_phrase('datacard'); ?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 input-effect">
                                                    <input class="effect-16 input required" required="" type="text" placeholder="<?php echo (get_phrase('number'));?>" name="number">
                                                    <label><?php echo get_phrase('number'); ?></label>
                                                    <span class="focus-border">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 input-effect">
                                                    <input class="effect-16 input required" required type="text" placeholder="<?php echo (get_phrase('name'));?>" name="first-name">
                                                    <label><?php echo get_phrase('first_name'); ?></label>
                                                    <span class="focus-border">
                                                    </span>
                                                </div>
                                                <div class="col-md-6 input-effect">
                                                    <input class="effect-16 input required" required type="text" placeholder="<?php echo (get_phrase('last_name')); ?>" name="last-name">
                                                    <label><?php echo get_phrase('last_name'); ?></label>
                                                    <span class="focus-border">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 input-effect">
                                                    <input class="effect-16 input required"  required type="text" placeholder="<?php echo (get_phrase('expiry')); ?>" name="expiry">
                                                    <label><?php echo get_phrase('expiry'); ?></label>
                                                    <span class="focus-border">
                                                    </span>
                                                </div>                                            
                                                <div class="col-md-6 input-effect">
                                                    <input class="effect-16 input required"  required type="text" placeholder="<?php echo (get_phrase('cvc')); ?>" name="cvc">
                                                    <label><?php echo get_phrase('cvc'); ?></label>
                                                    <span class="focus-border">
                                                    </span>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="text-muted titlecard"><?php echo get_phrase('datacontact'); ?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 input-effect">
                                                    <input class="effect-16 input required" required type="text" placeholder="<?php echo (get_phrase('phone'));?>" name="phone">
                                                    <label><?php echo get_phrase('phone'); ?></label>
                                                    <span class="focus-border">
                                                    </span>
                                                </div>
                                                <div class="col-md-6 input-effect">
                                                    <input class="effect-16 input required" required type="email" placeholder="<?php echo (get_phrase('email')); ?>" name="email">
                                                    <label><?php echo get_phrase('email'); ?></label>
                                                    <span class="focus-border">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 input-effect">
                                                    <input class="effect-16 input required" required type="text" placeholder="<?php echo (get_phrase('address'));?>" name="address">
                                                    <label><?php echo get_phrase('address'); ?></label>
                                                    <span class="focus-border">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row text-center helptext"></div>
                                    <br>
                                    <button type="button" onclick="actionsubmit()" id="btnpaguelofacil" class="btn btn-primary btnpaguelofacil stripe" <?php echo $paguelo_info; ?>><?php echo get_phrase('Pagar'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Modal -->

    <!-- Modal -->
    <div class="modal fade multi-step" id="EditRatingModal" tabindex="-1" role="dialog" aria-hidden="true" reset-on-close="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content edit-rating-modal">
                <div class="modal-header">
                    <h5 class="modal-title step-1" data-step="1"><?php echo get_phrase('step').' 1'; ?></h5>
                    <h5 class="modal-title step-2" data-step="2"><?php echo get_phrase('step').' 2'; ?></h5>
                    <h5 class="m-progress-stats modal-title">
                        &nbsp;of&nbsp;<span class="m-progress-total"></span>
                    </h5>

                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="m-progress-bar-wrapper">
                    <div class="m-progress-bar">
                    </div>
                </div>
                <div class="modal-body step step-1">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="modal-rating-box">
                                    <h4 class="rating-title"><?php echo get_phrase('how_would_you_rate_this_course_overall'); ?>?</h4>
                                    <fieldset class="your-rating">

                                        <input type="radio" id="star5" name="rating" value="5" />
                                        <label class = "full" for="star5"></label>

                                        	<!-- <input type="radio" id="star4half" name="rating" value="4 and a half" />
                                                <label class="half" for="star4half"></label> -->

                                                <input type="radio" id="star4" name="rating" value="4" />
                                                <label class = "full" for="star4"></label>

                                        	<!-- <input type="radio" id="star3half" name="rating" value="3 and a half" />
                                                <label class="half" for="star3half"></label> -->

                                                <input type="radio" id="star3" name="rating" value="3" />
                                                <label class = "full" for="star3"></label>

                                        	<!-- <input type="radio" id="star2half" name="rating" value="2 and a half" />
                                                <label class="half" for="star2half"></label> -->

                                                <input type="radio" id="star2" name="rating" value="2" />
                                                <label class = "full" for="star2"></label>

                                        	<!-- <input type="radio" id="star1half" name="rating" value="1 and a half" />
                                                <label class="half" for="star1half"></label> -->

                                                <input type="radio" id="star1" name="rating" value="1" />
                                                <label class = "full" for="star1"></label>

                                        	<!-- <input type="radio" id="starhalf" name="rating" value="half" />
                                                <label class="half" for="starhalf"></label> -->

                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="modal-course-preview-box">
                                            <div class="card">
                                                <img class="card-img-top img-fluid" id = "course_thumbnail_1" alt="">
                                                <div class="card-body">
                                                    <h5 class="card-title" class = "course_title_for_rating" id = "course_title_1"></h5>
                                                    <p class="card-text" id = "instructor_details">

                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-body step step-2">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="modal-rating-comment-box">
                                            <h4 class="rating-title"><?php echo get_phrase('write_a_public_review'); ?></h4>
                                            <textarea id = "review_of_a_course" name = "review_of_a_course" placeholder="<?php echo get_phrase('describe_your_experience_what_you_got_out_of_the_course_and_other_helpful_highlights').'. '.get_phrase('what_did_the_instructor_do_well_and_what_could_use_some_improvement') ?>?" maxlength="65000" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="modal-course-preview-box">
                                            <div class="card">
                                                <img class="card-img-top img-fluid" id = "course_thumbnail_2" alt="">
                                                <div class="card-body">
                                                    <h5 class="card-title" class = "course_title_for_rating" id = "course_title_2"></h5>
                                                    <p class="card-text">
                                                        -
                                                        <?php
                                                        $admin_details = $this->user_model->get_admin_details()->row_array();
                                                        echo $admin_details['first_name'].' '.$admin_details['last_name'];
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="course_id" id = "course_id_for_rating" value="">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary next step step-1" data-step="1" onclick="sendEvent(2)"><?php echo get_phrase('next'); ?></button>
                            <button type="button" class="btn btn-primary previous step step-2 mr-auto" data-step="2" onclick="sendEvent(1)"><?php echo get_phrase('previous'); ?></button>
                            <button type="button" class="btn btn-primary publish step step-2" onclick="publishRating($('#course_id_for_rating').val())" id = ""><?php echo get_phrase('publish'); ?></button>
                        </div>
                    </div>
                </div>
            </div><!-- Modal -->
            <script type="text/javascript">
                function actionsubmit(){
					 $('.helptext').html('<div class="loading text-center" style="margin: 0 auto"><img width="20%" src="https://upload.wikimedia.org/wikipedia/commons/9/92/Loading_icon_cropped.gif" alt="loading" /><br/>Un momento, por favor...</div>');
                    var dataString = $('#paguelofacil').serialize();
                    $.ajax({
                        type : 'POST',
                        url  : '<?php echo site_url('home/paguelofacil'); ?>',
                        data : dataString,
                        dataType: "JSON",
                        success : function(response) {
                            console.log(response);
                            if(response.error!==0){
                                $('.helptext').html('<div class="text-danger col-md-12"><strong>'+response.mensaje+' '+'</strong></div>');
                            }else{
								$('.helptext').html('');
                                var cuerpo='<div class="text-center"><i class="fa fa-check fa-2x text-success"></i>&nbsp;Pago procesado correctamente</div>';
                                $('#paymentModal .modal-body').html(cuerpo);
                                setTimeout(function(){
                                    $(location).attr('href','my_courses');
                                }, 2000);
                                                      
                            }
                        }
                    });
                }
            </script>
            <script type="text/javascript">
                function publishRating(course_id) {
                    var review = $('#review_of_a_course').val();
                    var starRating = 0;
                    $('input:radio[name="rating"]:checked').each(function() {
                        starRating = $('input:radio[name="rating"]:checked').val();
                    });

                    $.ajax({
                        type : 'POST',
                        url  : '<?php echo site_url('home/rate_course'); ?>',
                        data : {course_id : course_id, review : review, starRating : starRating},
                        success : function(response) {
                            console.log(response);
                            $('#EditRatingModal').modal('hide');
                            location.reload();
                        }
                    });
                }
            </script>
            <script src="<?php echo base_url().'assets/frontend/js/card.js'; ?>"></script>
            <script>
                var card = new Card({
                    form: '#paguelofacil',
                    container: '.card-wrapper',

                    formSelectors: {
                        nameInput: 'input[name="first-name"], input[name="last-name"]'
                    }
                });
            </script>
<?php if ($this->session->userdata('course_tab') == 'draft'):?>
<script>
     $('.draft').trigger('click');
</script>
<?php elseif ($this->session->userdata('course_tab') == 'create'):?>
<script>
     $('.create').trigger('click');
</script>
<?php elseif ($this->session->userdata('course_tab') == 'active'):?>
<script>
     $('.active').trigger('click');
</script>
	<?php 
$this->session->set_userdata('course_tab', '');
endif;?>
            