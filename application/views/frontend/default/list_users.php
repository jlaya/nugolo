<?php
$instructor_ids = $this->crud_model->get_course_instuctor_id('simple_array');

$instructor_details = $this->user_model->get_all_user_in_list();
//echo "<pre>";print_r($instructor_details);echo "</pre>";die;
//echo "<pre>";print_r($instructor_ids);echo "</pre>";die;
?>
<section class="course-carousel-area">
	<div class="container-lg">
		<div class="row mt-2">
			<div class="col">
				<h2 hidden="" class="course-carousel-title"><?php echo get_phrase('popular_instructor'); ?></h2></h2>
				<div class="row">
					<?php foreach($instructor_details as $key=>$instru): ?>	
						<div class="col-12 col-md-3 col-lg-2 ">
							<a href="<?php echo site_url('home/instructor/'.$instru['id']); ?>">
								<div class="course-box">
									<div class="text-center"><br><br>
										<img src="<?php echo $this->user_model->get_user_image_url($instru['id']);?>" alt="<?php echo $instru['first_name'].' '.$instru['last_name'];?>" class="img-fluid w-50">
										<br>
										<?php echo $instru['role']; ?>
									</div>
									<div class="course-details">
										<h5 class="title  text-center"><?php echo $instru['first_name'].' '.$instru['last_name'];?></h5>
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
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

