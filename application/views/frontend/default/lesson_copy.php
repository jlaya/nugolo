<?php
    header('X-Frame-Options: SAMEORIGIN');
    $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
    $more_videos = $this->Media_model->get_media($course_details['token']);

    if( isset(explode(":", $_SERVER["REQUEST_URI"])[1]) ){
        $video = explode(":", $_SERVER["REQUEST_URI"])[1];
    }else if(isset($more_videos[0]->url)){
        $video = $more_videos[0]->url;
    }else{
    	$video = "";
    }

    setlocale(LC_TIME, 'es_PA.UTF-8');
?>
<script type="text/javascript">

  function get_video(url) {
      
      var real_url = window.location +"/"+url;
      window.location = real_url;

  }
</script>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Videos</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="author" content="<?php echo get_settings('author') ?>" />
	<link name="favicon" type="image/x-icon" href="<?php echo base_url().'assets/favicon.png' ?>" rel="shortcut icon" />
	<?php include 'includes_top.php';?>

</head>
<body class="gray-bg">
	<?php
	if ($this->session->userdata('user_login')) {
		include 'logged_in_header.php';
	}else {
		include 'logged_out_header.php';
	}
	?>
	<br><br>
	<section class="course-content-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Videos asociados -->
                        <div class="about-instructor-box">
                        	<?php if( count($more_videos) > 0 ){ ?>
                            <div class="about-instructor-title">
                                + Videos
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="about-instructor-image">
                                        <?php foreach ($more_videos as $key => $value) { ?>
                                          <ul class="more-videos">
                                              <li>
                                                <a onclick='get_video("<?php echo $value->url; ?>")' style="cursor: pointer;">
                                                  <?php echo $value->title; ?>
                                                </a>
                                              </li>
                                          </ul>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="about-instructor-details view-more-parent">
                                        <!------------- PLYR.IO ------------>
                                  <link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">

                                  <div class="plyr__video-embed" id="player">
                                      <div class="show-media-video">
                                          <iframe  type="text/html"  height="500" src="<?php echo $video ?>?origin=<?php echo base_url() ?>&iv_load_policy=3&modestbranding=1&playsinline=0&showinfo=0&rel=0&enablejsapi=1&widgetid=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
                                      </div>
                                  </div>

                                  <script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
                                  <script>const player = new Plyr('#player');</script>
                                <!------------- PLYR.IO ------------>
                                    </div>
                                </div>
                            </div>
                        	<?php }else{ ?>
                        		<div class="about-instructor-title">
	                                No se encuentra ning&uacute;n recurso asociado
	                            </div>
                        	<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

	<?php
	include 'footer.php';
	include 'includes_bottom.php';
	include 'modal.php';
	?>
</body>
</html>
