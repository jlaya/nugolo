<?php
  $token =  date('Y-m-dH:i:s').md5(rand(100000000, 200000000));
?>

<ol class="breadcrumb bc-3">
  <li class = "active">
      <a href="<?php echo site_url('admin/dashboard'); ?>">
          <i class="entypo-folder"></i>
          <?php echo get_phrase('dashboard'); ?>
      </a>
  </li>
  <li><a href="<?php echo site_url('admin/courses'); ?>" class=""><?php echo get_phrase('courses'); ?></a> </li>
  <li><a href="#" class="active"><?php echo get_phrase('add_courses'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />
<div class="row">
<div class="col-md-12">
	<div class="panel panel-primary" data-collapsed="0">
          <div class="panel-heading">
			<div class="panel-title">
        <?php echo get_phrase('add_course_form'); ?>
			</div>
		</div>
		<div class="panel-body">
              <div class="row">
                  <div class="col-md-6">
                      <form class="" action="<?php echo site_url('admin/course_actions/add'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="token" value="<?php echo $token ?>">
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="form-group">
                                  <label class="form-label"><?php echo get_phrase('title'); ?></label>
                                  <div class="controls">
                                      <input type="text" name = "title" class="form-control" required>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="form-label"><?php echo get_phrase('short_description'); ?></label>
                                  <div class="controls">
                                      <textarea type="text" rows="5" name = "short_description" class="form-control" required></textarea>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="form-label"><?php echo get_phrase('description'); ?></label>
                                  <div class="controls">
                                      <textarea rows="5" class="form-control wysihtml5" data-stylesheet-url="<?php echo base_url('assets/backend/css/wysihtml5-color.css');?>"
                    name="description" placeholder="<?php echo get_phrase('description'); ?>"
                    id="sample_wysiwyg1"></textarea>
                                  </div>
                              </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-11 col-sm-11 col-xs-11" id = "requirement_area">
                              <div class="form-group">
                                  <label class="form-label"><?php echo get_phrase('requirements'); ?></label>
                                  <div class="controls">
                                      <input type="text" name = "requirements[]" class="form-control" required>
                                  </div>
                              </div>

                              <div id = "blank_requirement_field">
                                  <div class="form-group">
                                      <div class="controls">
                                          <input type="text" name = "requirements[]" class="form-control">
                                          <button type="button" class = "btn btn-default" name="button" onclick="removeRequirement(this)" style="float: right;margin-right: -68px;margin-top: -37px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-1 col-sm-1 col-xs-1"  style="margin-top: 24px; float: right; margin-left: 0; padding-left: 0;">
                              <button type="button" class = "btn btn-default" name="button" onclick="appendRequirement()" style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-11 col-sm-11 col-xs-11" id = "outcomes_area">
                              <div class="form-group">
                                  <label class="form-label"><?php echo get_phrase('outcomes'); ?></label>
                                  <div class="controls">
                                      <input type="text" name = "outcomes[]" class="form-control" required>
                                  </div>
                              </div>

                              <div id = "blank_outcome_field">
                                  <div class="form-group">
                                      <div class="controls">
                                          <input type="text" name = "outcomes[]" class="form-control">
                                          <button type="button" class = "btn btn-default" name="button" onclick="removeOutcome(this)" style="float: right;margin-right: -68px;margin-top: -37px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-1 col-sm-1 col-xs-1"  style="margin-top: 24px; float: left; margin-left: 0; padding-left: 0;">
                              <button type="button" class = "btn btn-default" name="button" onclick="appendOutcome()" style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                          </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">

                              <div class="form-group">
                                <label class="container"><?php echo get_phrase('free_course'); ?>
                                  <input type="checkbox" name = "is_free_course" id = "is_free_course" value="1" onchange="isFreeCourseChecked(this)">
                                  <span class="checkmark"></span>
                                </label>
                              </div>

                              <div class="form-group">
                                  <label class="form-label"><?php echo get_phrase('price').' ('.currency_code_and_symbol().')'; ?></label>
                                  <div class="controls">
                                      <input type="number" id = "price" name = "price" class="form-control" required onkeyup="calculateDiscountPercentage($('#discounted_price').val())" min="0" required>
                                  </div>
                              </div>

                              <div class="form-group">
                                <label class="container"><?php echo get_phrase('has_discount'); ?>
                                  <input type="checkbox" name = "discount_flag" value="1">
                                  <span class="checkmark"></span>
                                </label>
                              </div>

                              <div class="row">
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                  <div class="form-group">
                                      <label class="form-label"><?php echo get_phrase('discounted_price').' ('.currency_code_and_symbol().')'; ?></label>
                                      <div class="controls">
                                          <input type="number" name = "discounted_price" id ="discounted_price" class="form-control" onkeyup="calculateDiscountPercentage(this.value)" min="0">
                                      </div>
                                  </div>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                  <div class="form-group">
                                    <label class="form-label"></label>
                                      <div class="controls" style="margin-top: 5px;">
                                          <input type="text" class="form-control" name = "discounted_percentage" id = "discounted_percentage" readonly value="0%">
                                      </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="form-label"><?php echo get_phrase('category'); ?></label>
                            <div class="controls">
                                <select class="form-control" id="category_id" name="category_id" onchange="ajax_get_sub_category(this.value)" required>
                                    <option value=""><?php echo get_phrase('select_a_category'); ?></option>
                                    <?php
                                        $categories = $this->crud_model->get_categories();
                                        foreach ($categories->result_array() as $category):?>
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                    <?php endforeach; ?>


                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><?php echo get_phrase('sub_category'); ?></label>
                            <div class="controls">
                                <select class="form-control" id="sub_category_id" name="sub_category_id" required>
                                    <option value=""><?php echo get_phrase('select_a_category_first'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><?php echo get_phrase('level'); ?></label>
                            <div class="controls">
                                <select class="form-control" id="level" name="level"required>
                                    <option value="beginner"><?php echo get_phrase('beginner'); ?></option>
                                    <option value="advanced"><?php echo get_phrase('advanced'); ?></option>
                                    <option value="intermediate"><?php echo get_phrase('intermediate'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><?php echo get_phrase('language_made_in'); ?></label>
                            <div class="controls">
                                <select class="form-control" id="language_made_in" name="language_made_in" required>
                                    <?php
                                        $fields = $this->db->list_fields('language');
                                        foreach ($fields as $field):
                                        $current_default_language	=	$this->db->get_where('settings' , array('key'=>'language'))->row()->value;?>
                                        <?php if ($field == 'phrase_id' || $field == 'phrase') continue;?>
                                        <option value="<?php echo $field;?>"
                                            <?php if ($current_default_language == $field)echo 'selected';?>> <?php echo ucfirst($field);?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><?php echo get_phrase('course_overview_provider'); ?></label>
                            <div class="controls">
                                <select class="form-control" id="course_overview_provider" name="course_overview_provider">
                                    <option value="youtube"><?php echo get_phrase('youtube'); ?></option>
                                    <option value="vimeo"><?php echo get_phrase('vimeo'); ?></option>
                                    <option value="html5"><?php echo get_phrase('HTML5'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><?php echo get_phrase('course_overview_url'); ?></label>
                            <div class="controls">
                                <input type="text" name = "course_overview_url" class="form-control">
                                <small class="btn btn-primary" style="color: white;" data-toggle="modal" data-target="#exampleModal">Carga de Video(s)</small>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="container"><?php echo get_phrase('is_top_course'); ?>
                            <input type="checkbox" value="1" name = "is_top_course">
                            <span class="checkmark"></span>
                          </label>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><?php echo get_phrase('course_thumbnail');?></label>

                            <div class="controls">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                        <img src="<?php echo base_url('uploads/thumbnails/thumbnail.png');?>" alt="..." required>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="fileinput-new"><?php echo get_phrase('select_image'); ?></span>
                                            <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                                            <input type="file" name="course_thumbnail" accept="image/*">
                                        </span>
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
                                    </div>
                                </div>
                            </div>
                            <label class="form-label" style="color: red; font-weight: bold;"><?php echo get_phrase('note').': '.get_phrase('thumbnail_size_should_be_600_X_600');?></label>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><?php echo get_phrase('meta_keywords'); ?></label>
                            <div class="controls">
                                <input type="text" name="meta_keywords" value="" class="form-control tagsinput" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="form-label"><?php echo get_phrase('meta_description'); ?></label>
                            <div class="controls">
                                <textarea type="text" rows="5" name = "meta_description" class="form-control"></textarea>
                            </div>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-offset-4 col-md-3 col-sm-12 col-xs-12">
                      <div class="form-group">
                          <button class = "btn btn-block btn-success" type="submit" name="button"><?php echo get_phrase('add_course'); ?></button>
                      </div>
                    </div>
                  </div>

                  </form>
              </div>
		</div>
	</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Carga de Video(s)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <object type="application/php" data='<?php echo base_url("Video/multi_media/$token") ?>'  style="width:100%; height:241px;">
          <embed src='<?php echo base_url("Video/multi_media/$token") ?>'  style="width:100%; height:600px;" frameborder="0" style="border:0;">
        </object>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar ventana</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var blank_outcome = jQuery('#blank_outcome_field').html();
  var blank_requirement = jQuery('#blank_requirement_field').html();
  jQuery(document).ready(function() {
      jQuery('#blank_outcome_field').hide();
      jQuery('#blank_requirement_field').hide();
  });
  function appendOutcome() {
      jQuery('#outcomes_area').append(blank_outcome);
  }
  function removeOutcome(outcomeElem) {
      jQuery(outcomeElem).parent().parent().remove();
  }

  function appendRequirement() {
      jQuery('#requirement_area').append(blank_requirement);
  }
  function removeRequirement(requirementElem) {
      jQuery(requirementElem).parent().parent().remove();
  }

  function ajax_get_sub_category(category_id) {
      console.log(category_id);
      $.ajax({
          url: '<?php echo site_url('admin/ajax_get_sub_category/');?>' + category_id ,
          success: function(response)
          {
              jQuery('#sub_category_id').html(response);
          }
      });
  }

  function priceChecked(elem){
      if (jQuery('#discountCheckbox').is(':checked')) {

          jQuery('#discountCheckbox').prop( "checked", false );
      }else {

          jQuery('#discountCheckbox').prop( "checked", true );
      }
  }

  function topCourseChecked(elem){
      if (jQuery('#isTopCourseCheckbox').is(':checked')) {

          jQuery('#isTopCourseCheckbox').prop( "checked", false );
      }else {

          jQuery('#isTopCourseCheckbox').prop( "checked", true );
      }
  }

  function isFreeCourseChecked(elem) {

    if (jQuery('#'+elem.id).is(':checked')) {
        $('#price').prop('required',false);
    }else {
      $('#price').prop('required',true);
    }
  }

  function calculateDiscountPercentage(discounted_price) {
      if (discounted_price > 0) {
          var actualPrice = jQuery('#price').val();
          if ( actualPrice > 0) {
              var reducedPrice = actualPrice - discounted_price;
              var discountedPercentage = (reducedPrice / actualPrice) * 100;
              if (discountedPercentage > 0) {
                  jQuery('#discounted_percentage').val(discountedPercentage.toFixed(2) + "%");

              }else {
                  jQuery('#discounted_percentage').val('<?php echo '0%'; ?>');
              }
          }
      }
  }
</script>

<style media="screen">
body {
  overflow-x: hidden;
}
</style>
