<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Neon - Admin template" />
    <meta name="author" content="Creativeitem" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link name="favicon" type="image/x-icon" href="<?php echo base_url().'assets/favicon.ico' ?>" rel="shortcut icon" />
    <title>Nugolo</title>

    <!-- font -->
    <link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,500,500i,600,700,800,900|Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">


    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/backend/login/plugins-css.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/backend/login/typography.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/backend/login/style.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/backend/login/responsive.css'); ?>" />


    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/neon-core.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/neon-theme.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/neon-forms.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/font-icons/entypo/css/entypo.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/custom.css'); ?>">
    <style type="text/css">
        .gray-bg {
            background: #171038;
        }
        #login_area{
            background-color: #FFF;
        }
    </style>
</head>

<body>

    <div class="wrapper">

        <section class="gray-bg height-100vh d-flex align-items-center page-section-ptb ">
            <div class="container">
                <div class="row no-gutters justify-content-center">
                    <div class="col-lg-4 col-md-6 login-fancy-bg bg-overlay-black-40" style="background: url(assets/backend/login/login_bg.jpg);">
                        <div class="login-fancy pos-r d-flex">
                            <div class="text-center w-100 align-self-center">
                                <img src="<?php echo base_url('assets/frontend/naveicon.png'); ?>" height="40" />
                                <h2 class="text-white mb-20">NUGOLO</h2>
                                <h4 class="text-white mb-20" hidden=""><?php echo get_settings('slogan'); ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 white-bg">
                        <div class="login-fancy pb-40 clearfix" id = "login_area">
                            <h3 class="mb-30"><?php echo get_phrase('login'); ?></h3>
                            <form class="" action="<?php echo site_url('login/validate_login'); ?>" method="post">
                                <div class="section-field mb-20">
                                    <label class="mb-10" for="name"><?php echo get_phrase('email'); ?>* </label>
                                    <input id="email" class="web form-control" type="email" placeholder="<?php echo get_phrase('email'); ?>" name="email" required>
                                </div>
                                <div class="section-field mb-20">
                                    <label class="mb-10" for="Password"><?php echo get_phrase('password'); ?>* </label>
                                    <input id="Password" class="Password form-control" type="password" placeholder="<?php echo get_phrase('password'); ?>" name="password" required>
                                </div>
                                <button type="submit" class="btn btn-blue"><?php echo get_phrase('login'); ?></button>
                            </form>

                            <div class="section-field">
                                <div class="remember-checkbox mb-30">
                                    <a href="#" class="float-right" id = "forgot_password_button" onclick="toggleView(this)"><?php echo get_phrase('forgot_password'); ?>?</a>

                                    <a href="<?php echo base_url();?>" class="float-left">
                                        <i class="entypo-left-open"></i><?php echo get_phrase('back_to_website'); ?></a>
                                </div>
                            </div>
                        </div>

                        <div class="login-fancy pb-40 clearfix" id = "forgot_password_area" style="display: none;">
                            <h3 class="mb-30"><?php echo get_phrase('forgot_password'); ?></h3>
                            <form class="" action="<?php echo site_url('login/forgot_password/backend'); ?>" method="post">
                                <div class="section-field mb-20">
                                    <label class="mb-10" for="name"><?php echo get_phrase('email'); ?>* </label>
                                    <input id="forgot_password_email" class="web form-control" type="email" placeholder="<?php echo get_phrase('email'); ?>" name="email" onkeyup="verify_email();" required>
                                </div>
                                <button type="submit" class="btn btn-blue"><?php echo get_phrase('send_mail'); ?></button>
                            </form>

                            <div class="section-field">
                                <div class="remember-checkbox mb-30">
                                    <a href="#" class="float-right" id = "login_button" onclick="toggleView(this)"><?php echo get_phrase('back_to_login'); ?>?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- jquery -->
    <script src="<?php echo base_url('assets/backend/login/jquery-3.3.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/backend/js/toastr.js'); ?>"></script>
    <script type="text/javascript">
        function toggleView(elem) {
            if (elem.id === 'forgot_password_button') {
                $('#login_area').hide();
                $('#forgot_password_area').show();
            }else if (elem.id === 'login_button') {
                $('#login_area').show();
                $('#forgot_password_area').hide();
            }
        }

        function verify_email() {
            var email = $("#forgot_password_email").val();
            $.ajax({
                url: '<?php echo site_url('admin/verify_email');?>',
                dataType : 'json',
                type : 'POST',
                data : {
                    'email' : email
                },
                success: function( response )
                {

                }
            });

        }

    </script>
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
</body>
</html>
