<?php
$instructor_details = $this->user_model->get_all_user($instructor_id)->row_array();
$social_links  = json_decode($instructor_details['social_links'], true);
$course_ids = $this->crud_model->get_instructor_wise_courses($instructor_id, 'simple_array');

?>
<section class="instructor-header-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="instructor-name"><?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?></h1>
                <h2 class="instructor-title"><?php echo $instructor_details['title']; ?></h2>
            </div>
        </div>
    </div>
</section>

<section class="instructor-details-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="instructor-left-box text-center">
                    <div class="instructor-image">
                        <img src="<?php echo $this->user_model->get_user_image_url($instructor_details['id']);?>" alt="" class="img-fluid">
                    </div>
                    <div class="instructor-social">
                        <ul>
                            <li><a href="<?php echo $social_links['twitter']; ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="<?php echo $social_links['facebook']; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="<?php echo $social_links['linkedin']; ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="instructor-right-box">

                    <div class="biography-content-box view-more-parent">
                        <!-- <div class="view-more" onclick="viewMore(this,'hide')"><b><?php echo get_phrase('show_full_biography'); ?></b></div> -->
                        <div class="biography-content">
                            <?php echo $instructor_details['biography']; ?>
                        </div>
                    </div>

                    <div class="instructor-stat-box">
                        <ul>
                            <?php if(sizeof($course_ids)>0):?>
                            <li>
                                <div class="small"><?php echo get_phrase('total_student'); ?></div>
                                <div class="num">
                                    <?php
                                    $this->db->select('user_id');
                                    $this->db->distinct();
                                    $this->db->where_in('course_id', $course_ids);
                                    echo $this->db->get('enroll')->num_rows();?>
                                </div>
                            </li>

                            <li>
                                <div class="small"><?php echo get_phrase('courses'); ?></div>
                                <div class="num"><?php echo sizeof($course_ids); ?></div>
                            </li>
                            <li>
                                <div class="small"><?php echo get_phrase('reviews'); ?></div>
                                <div class="num"><?php echo $this->crud_model->get_instructor_wise_course_ratings($instructor_id, 'course')->num_rows(); ?></div>
                            </li>
                        <?php endif;?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<?php 
$course_ids = $this->crud_model->get_instructor_wise_courses($instructor_id)->result_array();
if(sizeof($course_ids)>0):
?>

<section class="category-instructor-list row">
    <div class="col-md-2"></div>
    <div class="category-course-list col-md-8">
        <hr>
        <ul>
           <?php foreach($course_ids as $course):
                         $instructor_details = $this->user_model->get_all_user($course['user_id'])->row_array();?>
                        <li>
                            <div class="course-box-2">
                                <div class="course-image">
                                    <a href="<?php echo site_url('home/course/'.slugify($course['title']).'/'.$course['id']) ?>">
                                        <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course['id']); ?>" alt="" class="img-fluid">
                                    </a>
                                </div>
                                <div class="course-details">
                                    <a href="<?php echo site_url('home/course/'.slugify($course['title']).'/'.$course['id']); ?>" class="course-title"><?php echo $course['title']; ?></a>
                                    <a href="<?php echo site_url('home/instructor/'.$instructor_details['id']) ?>" class="course-instructor">
                                        <span class="instructor-name"><?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?></span> -
                                    </a>
                                    <div class="course-subtitle">
                                        <?php echo $course['short_description']; ?>
                                    </div>
                                    <div class="course-meta">
                                        <span class=""><i class="fas fa-play-circle"></i>
                                            <?php
                                                $number_of_lessons = $this->crud_model->get_lessons('course', $course['id'])->num_rows();
                                                echo $number_of_lessons.' '.get_phrase('lessons');
                                             ?>
                                        </span>
                                        <span class=""><i class="far fa-clock"></i>
                                            <?php echo $this->crud_model->get_total_duration_of_lesson_by_course_id($course['id']); ?>
                                        </span>
                                        <span class=""><i class="fas fa-closed-captioning"></i><?php echo ucfirst(get_phrase($course['language'])); ?></span>
                                        <span class=""><i class="fa fa-level-up"></i><?php echo ucfirst(get_phrase($course['level'])); ?></span>
                                    </div>
                                </div>
                                <div class="course-price-rating">
                                    <div class="course-price">
                                        <?php if ($course['is_free_course'] == 1): ?>
                                            <span class="current-price"><?php echo get_phrase('free'); ?></span>
                                        <?php else: ?>
                                            <?php if($course['discount_flag'] == 1): ?>
                                                <span class="current-price"><?php echo currency($course['discounted_price']); ?></span>
                                                <span class="original-price"><?php echo currency($course['price']); ?></span>
                                            <?php else: ?>
                                                <span class="current-price"><?php echo currency($course['price']); ?></span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="rating">
                                        <?php
                                            $total_rating =  $this->crud_model->get_ratings('course', $course['id'], true)->row()->rating;
                                            $number_of_ratings = $this->crud_model->get_ratings('course', $course['id'])->num_rows();
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
                                    <div class="rating-number">
                                        <?php echo $this->crud_model->get_ratings('course', $course['id'])->num_rows().' '.get_phrase('ratings'); ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-md-2"></div>
</section>
<?php endif;