<link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="<?php echo base_url(); ?>assets/js/moment.js"></script>

<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<link href="<?php echo base_url(); ?>assets/css/video-js.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/video.js"></script>




<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/<?php echo $this->post_type;?>/test_content/<?php echo $testid; ?>/<?php echo $lang_code; ?>" method="post" enctype="multipart/form-data">  

		  <div class="form-group">

				<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right"></label>

				<div class="col-xs-12 col-sm-5">

					<span class="block input-icon input-icon-right" style="color:#FF0000;">

						<?php echo validation_errors(); ?>					

					</span>

				</div>				

			</div>

		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Video Article Title</label>

			<div class="col-xs-12 col-sm-7">

				<span class="block input-icon input-icon-right">
					<?php if(!($lang_code == "en")) echo $eng_test_info->title; ?>
					<input type="text" class="form-control required" id="title" name="title" value="<?php if($test_info) echo $test_info->title;?>">					

				</span>

			</div>				

		</div>
		
		<?php
			if($test_info)
			{ 
				$sub_title=get_testMeta($test_info->tests_id,'sub_title');
			}
			
			if(!($lang_code == "en"))
			{
				$eng_sub_title=get_testMeta($eng_test_info->tests_id,'sub_title');
			}
			
		?>
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Subitle</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<?php if(!($lang_code == "en")) echo $eng_sub_title; ?>
					<textarea name="sub_title" class="form-control" id="sub_title" ><?php if(!empty($sub_title)) echo $sub_title; ?></textarea>				
				</span>
			</div>				
		</div>
		

		<?php 

		if($this->session->userdata('user_type') != 2)

		{

		?>
		
		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Video Snippet </label>

			<div class="col-xs-12 col-sm-7">

				<span class="block input-icon input-icon-right">					
					<?php if(!($lang_code == "en")) echo get_testMeta($eng_test_info->tests_id,'video_snippet'); ?>
					<textarea name="video_snippet" id="video_snippet" class="form-control"><?php if($test_info) echo get_testMeta($test_info->tests_id,'video_snippet');?></textarea>					

				</span>

			</div>				

		</div>
		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Fb Share Description</label>

			<div class="col-xs-12 col-sm-7">

				<span class="block input-icon input-icon-right">					
					<?php if(!($lang_code == "en")) echo $eng_test_info->fbshare_des; ?>
					<textarea name="fbshare_des" id="fbshare_des" rows="8" class="form-control"><?php if($fbshare_des) echo $test_info->fbshare_des;?></textarea>					

				</span>

			</div>				

		</div>

		<?php if($test_info){ ?>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Alias</label>

			<div class="col-xs-12 col-sm-7">

				<span class="block input-icon input-icon-right">					
					<input type="text" class="form-control required" id="alias" name="alias" value="<?php if($test_info) echo $test_info->alias;?>">				
				</span>

			</div>				

		</div>

		<?php } ?>

		<?php /*?><div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Page Title</label>

			<div class="col-xs-12 col-sm-7">

				<span class="block input-icon input-icon-right">
					<?php if(!($lang_code == "en")) echo $eng_test_info->page_title; ?>
					<input type="text" class="form-control required" id="page_title" name="page_title" value="<?php if($test_info) echo $test_info->page_title;?>">					

				</span>

			</div>				

		</div><?php */?>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Video Categroy</label>

			<div class="col-xs-12 col-sm-7">

				<select name="category_id" id="category_id" class="form-control">

					<?php 

					

						if($category_list)

						{

							foreach($category_list as $row)

							{

							?>

							<option value="<?php echo $row->category_id; ?>"<?php if($test_info) {if($test_info->category_id == $row->category_id) echo "selected"; }?> ><?php echo $row->category_name; ?></option>

							<?php

							

							}

						}

					?>

					

				</select>

			</div>				

		</div>

		
		
		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Video Article  Content</label>

			<div class="col-xs-12 col-sm-9">

				<span class="block input-icon input-icon-right">					
					<?php if(!($lang_code == "en")) echo $eng_test_info->description; ?>
					<textarea name="description" id="description" rows="10" class="form-control required"><?php if($test_info) echo $test_info->description;?></textarea>					

				</span>

			</div>				

		</div>
		
		

		

		
		<?php
			if($test_info)
			{ 
				$video_type=get_testMeta($test_info->tests_id,'video_type');
			}
			else
			{
				$video_type=get_testMeta($eng_test_info->tests_id,'video_type');
			}
			
		?>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Is Extranal Video</label>
			<div class="col-xs-12 col-sm-5">
				<input type="checkbox" name="extranal_video" id="extranal_video" value="1" />
			</div>				
		</div>
		<div id="extranal_video_area" style="display:none;">
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Video Type</label>
				<div class="col-xs-12 col-sm-7">
					<select name="video_type" id="video_type" class="form-control required">
						<option value="" selected="selected">Select Type</option>
						<option value="youtube" <?php if($video_type=="youtube") echo "selected"; ?>>YouTube</option>
						<option value="vimo" <?php if($video_type=="vimo") echo "selected"; ?>>Vimeo</option>
					</select>
				</div>				
			</div>
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right"> Video Url</label>
				<div class="col-xs-12 col-sm-7">
					<?php 
						if($test_info)
						{
							$video_url=get_testMeta($test_info->tests_id,'video');
						}
						else
						{
							$video_url=get_testMeta($eng_test_info->tests_id,'video');
						}
						 
					?>
					<input type="text" name="video_url" id="video_url" class="form-control required" value="<?php if($video_type =="youtube" || $video_type == "vimo") echo $video_url; ?>"  />
				</div>				
			</div>
		</div>

		
		
		<div class="form-group" id="video">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Video</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">			
					<input type="file" name="video" id="video" value="" />					
					<?php
						if($video_type =="internal" || $video_type=="")
						{
							if($test_info) 
							{
								
								$video_name=get_testMeta($test_info->tests_id,'video');								
								
								if($video_name != '')
								{
								$video_info=pathinfo($video_name);
								$extension=$video_info['extension'];
								?>
								<video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
								  controls preload="auto" width="300" height="200"
								  poster="<?php echo base_url(); ?>assets/videos/<?php echo $video_name; ?>"
								  data-setup='{"example_option":true}'>
								 <source src="<?php echo base_url(); ?>assets/videos/<?php echo $video_name; ?>" type='video/<?php echo $extension; ?>' />		 
								</video>
								<input type="hidden" name="pre_video_path" value="assets/videos/<?php echo $video_name; ?>" />
								<?php
								}
							}
							else
							{
								$video_name=get_testMeta($eng_test_info->tests_id,'video');
								
								if($video_name != '')
								{
								$video_info=pathinfo($video_name);
								$extension=$video_info['extension'];
								?>
								<video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
								  controls preload="auto" width="300" height="200"
								  poster="<?php echo base_url(); ?>assets/videos/<?php echo $video_name; ?>"
								  data-setup='{"example_option":true}'>
								 <source src="<?php echo base_url(); ?>assets/videos/<?php echo $video_name; ?>" type='video/<?php echo $extension; ?>' />		 
								</video>
								
								<?php
								}
							}
						} //video_type
					?>
					<input type="hidden" name="en_video" value="<?php echo get_testMeta($eng_test_info->tests_id,'video'); ?>" />

				</span>

			</div>				

		</div>
		
		<?php 
			if($this->session->userdata('user_type') == 3) { 
				if($test_info)
				{
					$comments=get_testMeta($test_info->tests_id,'comments');
				}
				else
				{
					$comments="";
				}
						 
		
		?>
		<div class="form-group">
			
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Comments</label>
			<div class="col-xs-12 col-sm-7">
				<span class="block input-icon input-icon-right">			
					<textarea name="comments" id="comments" class="form-control"><?php if($comments) echo $comments; ?></textarea>					
				</span>
			</div>				
		</div>
		<?php } ?>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Image Upload</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">					
					<input type="file" name="image" id="image" value="" />
					<?php if($test_info) { ?>	
						<?php if($test_info->image) { ?>
							<img src="<?php echo base_url(); ?>assets/img/image/<?php echo $test_info->image; ?>" style="height:150px; width:200px;" />							
							<input type="hidden" name="pre_img_path" value="assets/img/image/<?php echo $test_info->image; ?>" />
						<?php } ?>

					<?php } else { ?>	
						<?php if($eng_test_image) { ?>
				 		 	<img src="<?php echo base_url(); ?>assets/img/image/<?php echo $eng_test_image; ?>" style="height:150px; width:200px;" />
						<?php } ?>
					 

					<?php } ?>

					<input type="hidden" name="en_image" value="<?php echo $eng_test_image; ?>" />

				</span>

			</div>				

		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Thumb Image Upload</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">					
					<input type="file" name="image_thumb" id="image_thumb" value="" />
					<?php if($test_info) { ?>	
						<?php if($test_info->image_thumb) { ?>
							<img src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $test_info->image_thumb; ?>" style="height:150px; width:200px;" />							
							<input type="hidden" name="pre_img_path2" value="assets/img/thumbs/<?php echo $test_info->image_thumb; ?>" />
						<?php } ?>

					<?php } else { ?>	
						<?php if($eng_test_image) { ?>
				 		 	<img src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $eng_test_image_thumb; ?>" style="height:150px; width:200px;" />
						<?php } ?>
					 

					<?php } ?>

					<input type="hidden" name="en_image_thumb" value="<?php echo $eng_test_image_thumb; ?>" />

				</span>

			</div>				

		</div>

		<?php

		} 

		?>

		  <div class="col-md-offset-3 col-sm-offset-3">
		  		<input type="hidden" name="testid" value="<?php echo $testid; ?>" />
				<input type="hidden" name="lang_code" value="<?php echo $lang_code; ?>" />
				<input type="hidden" name="eng_test_alias" value="<?php echo $eng_test_alias; ?>" />
				<input type="hidden" name="test_info" value="<?php if($test_info) echo "1"; else echo "0"; ?>" />
				<?php if($test_info) { ?><input type="hidden" name="test_id" value="<?php echo $test_info->tests_id; ?>" /><?php } ?>
				<input type="hidden" name="test_content" value="test_content" />
           		<button type="submit" class="btn btn-primary">Save </button>  
				<button class="btn btn-danger" onclick="history.back()" type="button">Cancel</button>  
          </div> 

		



</form>  










<script language="javascript">

	jQuery(document).ready(function () {
		jQuery('#add_form').validate({});
	}); // end document.ready
	
	$(document).ready(function(){
		<?php
		if($video_type == 'youtube' || $video_type == 'vimo')
		{
			?>
			$('#extranal_video').attr('checked',true);
			$('#video').hide();
			$('#extranal_video_area').show();
			<?php
		}
		?>
	});
	
	$(document).on('click','#extranal_video',function() {
		if(this.checked)
		{
			$('#video').hide();
			$('#extranal_video_area').show();
		}
		else
		{
			$('#extranal_video_area').hide();
			$('#video').show();
		}
	
	});

</script>
<script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
<script language="javascript">
	// Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	var config = {
			height: 400,
			codeSnippet_theme: 'Monokai',
			filebrowserBrowseUrl: '<?php echo base_url();?>assets/filemanager/index.html',
			
			toolbarGroups: [
				
				
				{ name: 'insert' },
				{ name: 'colors' },
				{ name: 'links' },
				{ name: 'mode' },
				//'/',
				{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
				{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
				{ name: 'styles' },
				
			]
			
			

			// Remove the redundant buttons from toolbar groups defined above.
			
		};
	CKEDITOR.replace( 'description',config );
	
</script>

