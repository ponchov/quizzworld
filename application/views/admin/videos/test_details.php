 <link href="<?php echo base_url();?>assets/css//ekko-lightbox.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/video-js.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/video.js"></script>
 <?php 

	if($this->session->flashdata('success_message'))

	{

	?>

		<div class="alert alert-success">  

		  <a class="close" data-dismiss="alert">x</a>  

		  <strong>Success!</strong><?php echo $this->session->flashdata('success_message');?>  

		</div> 

	<?php

	}

	?>



<div class="row test_detais">
	<?php if($this->session->userdata('user_type') !=4 ) { ?><div><a href="<?php echo site_url(); ?>admin/videos/edit/<?php echo $test_info->testid; ?>/<?php echo $lang_code; ?>/details" target="_blank" class="btn btn-primary pull-right">Edit</a></div><?php } ?>
	<div style="clear:both; height:10px;"></div>
	<h2><?php echo $test_info->title; ?></h2>
   
	<p>
	<?php
		if($test_info->image)

		{

		?>

		<a href="<?php echo base_url(); ?>assets/img/image/<?php echo $test_info->image; ?>" data-toggle="lightbox">

			<img src="<?php echo base_url(); ?>assets/img/image/<?php echo $test_info->image; ?>" height="270" width="950"/>

		</a>

		<?php

		}

		?>
	</p>
	
	<?php if($this->session->userdata('user_type') == 3 || $this->session->userdata('user_type')== 4 ) { ?>
		<div class="comments_area">
			<?php
				$comments=get_testMeta($test_info->tests_id,'comments');
			?>
			<form class="form-horizontal" action="<?php echo site_url(); ?>admin/videos/edit_comments" method="post">
				<div class="form-group">
					<h3 class="col-sm-12">Comments</h3>
					<div class="col-xs-12 col-sm-7">
						<span class="block input-icon input-icon-right">			
							<textarea name="comments" id="comments" class="form-control"><?php if($comments) echo $comments; ?></textarea>					
						</span>
					</div>	
					
					<div class="col-sm-4">
					<input type="hidden" name="lang_code" value="<?php echo $lang_code;?>" />
					<input type="hidden" name="test_id" value="<?php echo $test_info->tests_id?>"  />
					<input type="hidden" name="edit_comments" value="edit_comments" />
					<button type="submit" class="btn btn-primary">Edit</button>
			  </div>
								
				</div>
			</form>
		</div>
	<?php } ?>
     
	 <p><?php echo nl2br($test_info->description); ?></p>
	 <h3><?php echo get_testMeta($test_info->tests_id,'video_snippet');?></h3>
	 
	 <?php
		/*$video_name=get_testMeta($test_info->tests_id,'video');
		$video_info=pathinfo($video_name);
		
		$extension=$video_info['extension'];
		
		if($video_name != '')
		{
		?>
		<video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
		  controls preload="auto" width="720" height="320"
		  poster="<?php echo base_url(); ?>assets/videos/<?php echo $video_name; ?>"
		  data-setup='{"example_option":true}'>
		 <source src="<?php echo base_url(); ?>assets/videos/<?php echo $video_name; ?>" type='video/<?php echo $extension; ?>' />		 
		</video>
		
		<?php
		}*/
		?>
		
		<?php
			$video_type=get_testMeta($test_info->tests_id,'video_type');
			if($video_type == "internal" || $video_type == "" )
			{
				$video_name=get_testMeta($test_info->tests_id,'video');
				$video_info=pathinfo($video_name);
				
				$extension=$video_info['extension'];
				
				if($video_name != '')
				{
					?>
					<video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
						  controls preload="auto" width="" height="200"
						  poster="<?php echo base_url(); ?>assets/videos/<?php echo $video_name; ?>"
						  data-setup='{"example_option":true}'>
						 <source src="<?php echo base_url(); ?>assets/videos/<?php echo $video_name; ?>" type='video/<?php echo $extension; ?>' />		 
						</video>
					<?php 
				}
			}
			else if($video_type == "youtube")
			{
				$video_name=get_testMeta($test_info->tests_id,'video');
				$url =explode("=", $video_name);					
				$total=count($url);
				$youtube_id=$url[$total -1];
				$youtube_url="http://www.youtube.com/embed/".$youtube_id;
				?>
					<iframe class="youtube_video" src="<?php echo $youtube_url;?>" ></iframe>
				<?php 
			}
			else if($video_type == "vimo")
			{
				$video_name=get_testMeta($test_info->tests_id,'video');
				$url =explode("/", $video_name);
				$total=count($url);
				$vimo_id=$url[$total -1];
				?>
				<iframe class="vimeo_video" src="//player.vimeo.com/video/<?php echo $vimo_id; ?>"  frameborder="0" ></iframe>
				<?php 
			}
		
		?>


</div>

	

	
		<?php if($this->session->userdata('user_type') == 4 || $this->session->userdata('user_type') == 1) { ?>

		<form action="<?php echo site_url(); ?>admin/<?php echo $this->post_type;?>/all_image_added" method="post">

			<input type="checkbox" name="all_image_added" id="all_image_added" value="1" <?php if($test_info->all_image_added) echo 'checked="checked"'; ?>   /> All Image Added

			<input type="hidden" name="add_image" value="add_image"  />
			<input type="hidden" name="lang_code" value="<?php echo $lang_code;?>" />
			<input type="hidden" name="test_id" value="<?php echo $test_info->tests_id?>"  />

			<input class="btn btn-primary" type="submit" value="Save"  /> 

		</form>
		<div style="clear:both; height:15px;"></div>
		<?php } ?>

		

		<?php if($this->session->userdata('user_type') == 3 || $this->session->userdata('user_type') == 1) { ?>

		<form action="<?php echo site_url(); ?>admin/<?php echo $this->post_type;?>/all_content_ready" method="post">

			<input type="checkbox" name="all_content_ready" id="all_content_ready" value="1" <?php if($test_info->all_content_ready) echo 'checked="checked"'; ?>   /> All Content Ready

			<input type="hidden" name="content_ready" value="content_ready"  />
			<input type="hidden" name="lang_code" value="<?php echo $lang_code;?>" />
			<input type="hidden" name="test_id" value="<?php echo $test_info->tests_id; ?>"  />

			<input class="btn btn-primary" type="submit" value="Save"  /> 

		</form>

		<?php } ?>

		

	</div>

	



 <script src="<?php echo base_url();?>assets/js/ekko-lightbox.js"></script>



<style type="text/css">

	.test_detais

	{

		margin-bottom:10px;

	}

	#result_text

	{

		float:left;

	}

	#result_text h2

	{

		margin:0;

		padding-left:5px;

	}

	.add_result_text_btn

	{

		font-size:20px;

	}

	

	#result_text_labal

	{

		float:left;

		font-size:16px;

		font-weight:bold;

		padding-top:5px;

	}



</style>



<script type="text/javascript">

	$(document).ready(function ($) {



		// delegate calls to data-toggle="lightbox"

		$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {

			event.preventDefault();

			return $(this).ekkoLightbox({

				onShown: function() {

					if (window.console) {

						return console.log('Checking our the events huh?');

					}

				}

			});

		});





	});

</script>