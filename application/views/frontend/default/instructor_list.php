<?php
$instructor_ids = $this->crud_model->get_course_instuctor_id('simple_array');

$instructor_details = $this->user_model->get_all_user_in($instructor_ids)->result_array();
//echo "<pre>";print_r($instructor_details);echo "</pre>";die;
//echo "<pre>";print_r($instructor_ids);echo "</pre>";die;
?>
<section class="course-carousel-area">
	<div class="container-lg">
		<div class="row">
			<div class="col">
				<h2 class="course-carousel-title"><?php echo get_phrase('popular_instructor'); ?></h2></h2>
				<div class="row">
					<?php foreach($instructor_details as $key=>$instru): ?>	
						<div class="col-12 col-md-2 ">
							<a href="<?php echo site_url('home/instructor/'.$instru['id']); ?>">
								<div class="course-box">
									<div class="text-center"><br><br>
										<img src="<?php echo $this->user_model->get_user_image_url($instru['id']);?>" alt="<?php echo $instru['first_name'].' '.$instru['last_name'];?>" class="img-fluid w-50">
									</div>
									<div class="course-details">
										<h5 class="title  text-center"><?php echo $instru['first_name'].' '.$instru['last_name'];?></h5>
										<p class="instructors text-center" style="text-transform: uppercase;" >
											<?php $curso=$this->crud_model->get_instructor_wise_courses($instru['id'])->result_array(); ?>
											<?php $cu="";
											foreach($curso as $key=>$cur):
												if($key<4):
													$cu.= $cur['title'].', ';
												endif;
											endforeach;
											echo substr($cu,0,-2);
											?>	
										</p>
										<div class="rating text-center">
											<?php
											$course_ids = $this->crud_model->get_instructor_wise_courses($instru['id'], 'simple_array');
											$this->db->select('user_id');
											$this->db->distinct();
											$this->db->where_in('course_id', $course_ids);
											echo '<strong>'.number_format($this->db->get('enroll')->num_rows()).'</strong> '.get_phrase('students');?><br><?php echo '<strong>'.number_format(sizeof($course_ids)).'</strong> '; ?><?php echo get_phrase('courses').'<br><br>'; ?>    
										</div>
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

