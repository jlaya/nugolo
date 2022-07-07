<section class="menu-area">
            <div class="container-xl">
                <div class="row">
                    <div class="col">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="height: 65.5px;">

                            <ul class="mobile-header-buttons">
                                <li><a class="mobile-nav-trigger" href="#mobile-primary-nav">Menu<span></span></a></li>
                                <li><a class="mobile-search-trigger" href="#mobile-search">Search<span></span></a></li>
                            </ul>

                            <a href="<?php echo site_url(''); ?>" class="navbar-brand" href="#"><img src="<?php echo base_url().'assets/frontend/img/logo.png'; ?>" alt="" height="30"></a>
                            <?php include 'menu.php'; ?>
                            <section class="btn-group">
                                <a href="<?php echo base_url('about'); ?>">
                                    <button type="button" class="btn btn-primary button-link">Quienes somos</button>
                                </a>
                                <a href="<?php echo base_url('plans'); ?>">
                                    <button type="button" class="btn btn-primary button-link">Planes</button>
                                </a>
                                <a href="<?php echo base_url('contact'); ?>">
                                    <button type="button" class="btn btn-primary button-link">Contacto</button>
                                </a>
                            </section>

                            <span class="signin-box-move-desktop-helper"></span>
                            <div class="sign-in-box btn-group" style="margin: 0% 0% 0% auto;">

                                <button type="button" class="btn btn-sign-in" data-toggle="modal" data-target="#signInModal"><?php echo get_phrase('log_in'); ?></button>

                                <button type="button" class="btn btn-sign-up" data-toggle="modal" data-target="#signUpModal"><?php echo get_phrase('sign_up'); ?></button>

                            </div> <!--  sign-in-box end -->



                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <style type="text/css">
    .button-link {
        background-color: #f8f9fa !important;
        color: #7d838c !important;
        border-color: transparent !important;
    }
</style>
