<ol class="breadcrumb bc-3">
    <li class = "active">
        <a href="#">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="<?php echo site_url('admin/users'.$para); ?>"><?php echo get_phrase($name); ?></a> </li>
    <li><a href="#" class="active"><?php echo get_phrase('add_'.$name); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
				<div class="panel-title">
					<?php echo get_phrase($name.'_add_form'); ?>
				</div>
			</div>
			<div class="panel-body">
                <div class="row">
                    <form class="" id="userform" action="<?php echo site_url('admin/users/add'.$rol); ?>" method="post" enctype="multipart/form-data">
                    <div class="col-md-8">

                            <div class="panel-group" id="accordion-test" data-toggle="collapse">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="" data-toggle="collapse" data-parent="#accordion"  href="#collapseTwo">
                                                <?php echo get_phrase('basic_info'); ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                                <div class="form-group">
                                                    <label class="form-label"><?php echo get_phrase('first_name'); ?> <span>*</span></label>
                                                    <div class="controls">
                                                        <input type="text" name = "first_name" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label"><?php echo get_phrase('last_name'); ?> <span>*</span></label>
                                                    <div class="controls">
                                                        <input type="text" name = "last_name" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                <?php echo get_phrase('login_credentials'); ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                                <div class="form-group">
                                                    <label class="form-label"><?php echo get_phrase('email'); ?> <span>*</span></label>
                                                    <div class="controls">
                                                        <input type="email" name = "email" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label"><?php echo get_phrase('password'); ?> <span>*</span></label>
                                                    <div class="controls">
                                                        <input type="password" name = "password" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                <?php echo get_phrase('social_information'); ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                                <div class="form-group">
                                                    <label class="form-label"><?php echo get_phrase('facebook'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" name = "facebook_link" class="form-control" >
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label"><?php echo get_phrase('twitter'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" name = "twitter_link" class="form-control" >
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label"><?php echo get_phrase('linkedin'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" name = "linkedin_link" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                                <?php echo get_phrase('biography'); ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label class="form-label"><?php echo get_phrase('biography'); ?></label>
                                                    <div class="controls">
                                                        <textarea rows="5" class="form-control wysihtml5" data-stylesheet-url="<?php echo base_url('assets/backend/css/wysihtml5-color.css');?>"
                                                            name="biography" placeholder="<?php echo get_phrase('biography'); ?>"
                                                            id="sample_wysiwyg" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default <?php if($rol_edit!='/3'):?>hidden<?php endif;?>">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                                <?php echo get_phrase('payment_info'); ?> <span style="color: red; font-size: 12px;">(<?php echo get_phrase('required_for_instructors'); ?>)</span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFive" class=" panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                                <div class="form-group">
                                                    <label class="form-label"><?php echo get_phrase('paypal_client_id'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" name = "paypal_client_id" class="form-control" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group hidden">
                                                    <label class="form-label"><?php echo get_phrase('stripe_public_key'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" name = "stripe_public_key" class="form-control" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group hidden">
                                                    <label class="form-label"><?php echo get_phrase('stripe_secret_key'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" name = "stripe_secret_key" class="form-control" value="">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <div class="form-group">
                                <label class="form-label"><?php echo get_phrase('user_image');?></label>

                                <div class="controls">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                            <img src="<?php echo base_url('uploads/user_image/placeholder.png');?>" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="fileinput-new"><?php echo get_phrase('select_image'); ?></span>
                                                <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                                                <input type="file" name="user_image" accept="image/*">
                                            </span>
                                            <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <span>* Campos requeridos</span>
                    <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('add_user'); ?></button>
                            <span>&nbsp;* Campos requeridos</span>
                        
                        </div>
                    </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
