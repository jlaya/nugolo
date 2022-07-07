<?php setlocale(LC_TIME, 'es_PA.UTF-8'); ?>
<section class="home-banner-area">
    <!--inicarr-->
    <!-- ******************* -->
    <!-- BEGIN SLIDER MARKUP -->
    <!-- ******************* -->
    <div class="rev_slider_wrapper">
        <!-- the ID here will be used in the inline JavaScript below to initialize the slider -->
        <div id="rev_slider_1" class="rev_slider" data-version="5.4.5" style="display:none">
            <ul> 
               <?php if(file_exists('uploads/frontend/home-banner.jpg')){?>              
                <!-- BEGIN SLIDE -->
                <li data-transition="fade">
                    <!-- SLIDE'S MAIN BACKGROUND IMAGE -->
                    <img src="<?php echo base_url().'uploads/frontend/home-banner.jpg'; ?>" alt="Ocean" class="rev-slidebg">
                    <!-- BEGIN LAYER -->
                    <div class="tp-caption tp-resizeme " 

                    data-frames='[{"delay": 500, "speed": 300, "from": "opacity: 0", "to": "opacity: 1"}, 
                    {"delay": "wait", "speed": 300, "to": "opacity: 0"}]' 

                    data-x="left" 
                    data-y="center" 
                    data-hoffset="0" 
                    data-voffset="0" 
                    data-width="['100%']"
                    data-height="['auto']"

                    ><div class="home-banner-wrap">                
                        <h2><?php echo get_frontend_settings('banner_title'); ?></h2><p><?php echo get_frontend_settings('banner_sub_title'); ?></p>
                         
                    </div>
                </div><!-- END LAYER -->
            </li><!-- END SLIDE -->
        <?php }?>
        <?php if(file_exists('uploads/frontend/home-banner2.jpg')){?>
           <!-- BEGIN SLIDE -->
           <li data-transition="fade">
            <!-- SLIDE'S MAIN BACKGROUND IMAGE -->
            <img src="<?php echo base_url().'uploads/frontend/home-banner2.jpg'; ?>" alt="Sky" class="rev-slidebg">
            <!-- BEGIN LAYER -->
            <div class="tp-caption tp-resizeme" 
            data-frames='[{"delay": 500, "speed": 300, "from": "opacity: 0", "to": "opacity: 1"}, 
            {"delay": "wait", "speed": 300, "to": "opacity: 0"}]' 
            data-x="left" 
            data-y="center" 
            data-hoffset="0" 
            data-voffset="0" 
            data-width="['100%']"
            data-height="['auto']"
            >
            <div class="home-banner-wrap">                
                <h2><?php echo get_frontend_settings('banner_title2'); ?></h2><p><?php echo get_frontend_settings('banner_sub_title2'); ?></p>
            </div>
        </div><!-- END LAYER -->
    </li><!-- END SLIDE -->
<?php }?>
<!-- BEGIN SLIDE -->
<?php if(file_exists('uploads/frontend/home-banner3.jpg')){?>
    <li data-transition="fade">
        <!-- SLIDE'S MAIN BACKGROUND IMAGE -->
        <img src="<?php echo base_url().'uploads/frontend/home-banner3.jpg'; ?>" alt="Sky" class="rev-slidebg">
        <!-- BEGIN LAYER -->
        <div class="tp-caption tp-resizeme" 
        data-frames='[{"delay": 500, "speed": 300, "from": "opacity: 0", "to": "opacity: 1"}, 
        {"delay": "wait", "speed": 300, "to": "opacity: 0"}]' 
        data-x="left" 
        data-y="center" 
        data-hoffset="0" 
        data-voffset="0" 
        data-width="['100%']"
        data-height="['auto']"
        >
        <div class="home-banner-wrap">                
            <h2><?php echo get_frontend_settings('banner_title3'); ?></h2><p><?php echo get_frontend_settings('banner_sub_title3'); ?></p>
        </div>
    </div><!-- END LAYER -->
</li><!-- END SLIDE -->
<?php }?>
</ul>
</div>
</div>
<!--fincarr-->
</section>
<section class="home-fact-area">
    <div class="container-lg">
        <div class="row">
            <?php $courses = $this->crud_model->get_courses(); ?>
            <div class="col-xs-12 col-md-4 col-sm-4 d-flex">
                <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                    <i class="fas fa-bullseye float-left"></i>
                    <div class="text-box">
                        <h4>
                        <?php
                        $status_wise_courses = $this->crud_model->get_status_wise_courses();
                        $number_of_courses = $status_wise_courses['active']->num_rows();
                        //echo $number_of_courses.' '.get_phrase('online_courses'); 
                        echo get_phrase('online_courses'); 
                        ?>
                        </h4>
                        <p><?php echo get_phrase('explore_a_variety_of_fresh_topics');?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                    <i class="fa fa-check float-left"></i>
                    <div class="text-box">
                        <h4><?php echo get_phrase('expert_instruction'); ?></h4>
                        <p><?php echo get_phrase('find_the_right_course_for_you'); ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                    <i class="fa fa-clock float-left"></i>
                    <div class="text-box">
                        <h4><?php echo get_phrase('lifetime_access'); ?></h4>
                        <p><?php echo get_phrase('learn_on_your_schedule'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Seccion para los cursos -->
<section class="course-carousel-area">
    <div class="container-lg">
        <div class="row">
            <div class="col mt-12">
                <h2 class="course-carousel-title"></h2>
                <div class="row">
                    <?php
                    $latest_courses = $this->crud_model->get_top_courses()->result_array();
                    foreach ($latest_courses as $latest_course):?>
                    <div class="col-md-3">
                        <a href="<?php echo site_url('home/course/'.slugify($latest_course['title']).'/'.$latest_course['id']); ?>">
                            <div class="course-box">
                                <div class="course-image">
                                    <img src="<?php echo $this->crud_model->get_course_thumbnail_url($latest_course['id']); ?>" alt="" class="img-fluid">
                                </div>
                                <div class="course-details">
                                    <h5 class="title"><?php echo $latest_course['title']; ?></h5>
                                    <p class="instructors">
                                        <?php
                                        $instructor_details = $this->user_model->get_all_user($latest_course['user_id'])->row_array();
                                        echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?>
                                    </p>
                                    <div class="rating">
                                        <?php
                                        $total_rating =  $this->crud_model->get_ratings('course', $latest_course['id'], true)->row()->rating;
                                        $number_of_ratings = $this->crud_model->get_ratings('course', $latest_course['id'])->num_rows();
                                        if ($number_of_ratings > 0) {
                                            $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                                        }else {
                                            $average_ceil_rating = 0;
                                        }

                                        for($i = 1; $i < 6; $i++):?>
                                        <?php if ($i <= $average_ceil_rating): ?>
                                            <i class="fas fa-star filled"></i>
                                        <?php else: ?>
                                            <i class="fas fa-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    <span class="d-inline-block average-rating"><?php echo $average_ceil_rating; ?></span>
                                </div>
                                <?php if ($latest_course['is_free_course'] == 1): ?>
                                    <p class="price text-right"><?php echo get_phrase('free'); ?></p>
                                <?php else: ?>
                                    <?php if ($latest_course['discount_flag'] == 1): ?>
                                        <p class="price text-right"><small><?php echo currency($latest_course['price']); ?></small><?php echo currency($latest_course['discounted_price']); ?></p>
                                    <?php else: ?>
                                        <p class="price text-right"><?php echo currency($latest_course['price']); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>
</section>
<section class="course-carousel-area">
    <div class="container-lg">
        <div class="row">
            <div class="col mt-12">
                <div class="row">
                    <div class="col-md-6">
                         <h5 class="course-carousel-title">RUTINAS CREADAS <span style="color: #48668E;"> POR INSTRUCTORES EXPERTOS </span> </h5>
                        <p class="description-course" style="text-align: justify;">
                        Si deseas llevar una vida más saludable incluyendo un poco de ejercicio en tu día a día pero no sabes por dónde empezar, nuestro gimnasio virtual es para ti, aquí encontrarás rutinas para cada semana creadas por instructores expertos, nosotros te guiamos en todo el proceso.
                         </p>
                    </div>
                    <div class="col-md-6">
                        <p style="text-align: justify;">
                             <img style="width: 95%;" src="<?php echo base_url('assets/frontend/images/frontend/sector2.jpg'); ?>">
                         </p>
                    </div>
                </div>
                <h5 class="course-carousel-title"></h5>
                <div class="row">
                    <div class="col-md-6">
                        <p style="text-align: justify;">
                            <img style="width: 95%;" src="<?php echo base_url('assets/frontend/images/frontend/sector3.jpg'); ?>">
                         </p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="course-carousel-title">ASESORÍAS <span style="color: #48668E;"> ESPECIALIZADAS</span></h5>
                        <p class="description-course" style="text-align: justify;">
                        Nuestros planes, además de las rutinas incluyen asesorías especializadas en temas de nutrición, psicología deportiva y fisioterapia para ayudarte a alcanzar tus objetivos. Al registrarte te realizamos una valoración inicial para indicarte cual es la rutina ideal para ti.
                         </p>
                    </div>
                </div>
                <h5 class="course-carousel-title"></h5>
                <div class="row">
                    <div class="col-md-6">
                        <p style="text-align: justify;">
                            <img style="width: 95%;margin-top: 15%;" src="<?php echo base_url('assets/frontend/images/frontend/sector1.png'); ?>">
                         </p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="course-carousel-title"></h5>
                         <object type="application/php" data='<?php echo base_url("registro");?>' style="width:100%; height:655px;">
                          <embed src='<?php echo base_url("registro");?>' style="width:100%; height:655px;" frameborder="0" style="border:0;">
                        </object>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php //include('instructor_list.php');?>

<script type="text/javascript">
    function handleWishList(elem) {

        $.ajax({
            url: '<?php echo site_url('home/handleWishList');?>',
            type : 'POST',
            data : {course_id : elem.id},
            success: function(response)
            {
                if (!response) {
                    $('#signInModal').modal('show');
                }else {
                    if ($(elem).hasClass('active')) {
                        $(elem).removeClass('active')
                    }else {
                        $(elem).addClass('active')
                    }
                    $('#wishlist_items').html(response);
                }
            }
        });
    }

    function handleCartItems(elem) {
        url1 = '<?php echo site_url('home/handleCartItems');?>';
        url2 = '<?php echo site_url('home/refreshWishList');?>';
        $.ajax({
            url: url1,
            type : 'POST',
            data : {course_id : elem.id},
            success: function(response)
            {
                $('#cart_items').html(response);
                if ($(elem).hasClass('addedToCart')) {
                    $('.big-cart-button-'+elem.id).removeClass('addedToCart')
                    $('.big-cart-button-'+elem.id).text("<?php echo get_phrase('add_to_cart'); ?>");
                }else {
                    $('.big-cart-button-'+elem.id).addClass('addedToCart')
                    $('.big-cart-button-'+elem.id).text("<?php echo get_phrase('added_to_cart'); ?>");
                }
                $.ajax({
                    url: url2,
                    type : 'POST',
                    success: function(response)
                    {
                        $('#wishlist_items').html(response);
                    }
                });
            }
        });
    }

    function handleEnrolledButton() {
        $.ajax({
            url: '<?php echo site_url('home/isLoggedIn');?>',
            success: function(response)
            {
                if (!response) {
                    $('#signInModal').modal('show');
                }
            }
        });
    }
</script>
