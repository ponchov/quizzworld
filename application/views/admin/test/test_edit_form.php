<link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="<?php echo base_url(); ?>assets/js/moment.js"></script>

<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>





<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/test_edit/<?php echo $test_info->testid;?>/<?php echo $lan; ?>/<?php echo $referance;?>" method="post" enctype="multipart/form-data">  


		
		  <div class="form-group">

				<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right"></label>

				<div class="col-xs-12 col-sm-5">

					<span class="block input-icon input-icon-right" style="color:#FF0000;">

						<?php echo validation_errors(); ?>					

					</span>

				</div>				

			</div>

		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Title</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="title" name="title" value="<?php echo $test_info->title;?>">					

				</span>

			</div>				

		</div>

		<?php if($this->session->userdata('user_type') != 2){?>

		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Alias</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<input type="text" class="form-control required" id="alias" name="alias" value="<?php echo $test_info->alias;?>">				
				</span>
			</div>				
 		</div>
	<?php } ?>
		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Page Title</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="page_title" name="page_title" value="<?php echo $test_info->page_title;?>">					

				</span>

			</div>				

		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Sub Title</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="sub_title" class="form-control " id="sub_title" ><?php echo get_testMeta($test_info->tests_id,'sub_title');?></textarea>				
				</span>
			</div>				
		</div>
		
	<?php if($this->session->userdata('user_type') != 2){?>
		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Categroy Name</label>

			<div class="col-xs-12 col-sm-5">

				<select name="category_id" id="category_id" class="form-control">

					<?php 

					

						if($category_list)

						{

							foreach($category_list as $row)

							{

							?>

							<option value="<?php echo $row->category_id; ?>"<?php if($test_info->category_id == $row->category_id) echo "selected";?> ><?php echo $row->category_name; ?></option>

							<?php

							

							}

						}

					?>

					

				</select>

			</div>				

		</div>

		   <?php if($test_info->is_real_test != 3){?>
				<div class="form-group">
					<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Starting Point</label>
					<div class="col-xs-12 col-sm-3 col-md-3">
						<span class="block input-icon input-icon-right">			
							<input type="text" class="form-control required" id="start_point" name="start_point" value="<?php echo $test_info->start_point;?>">				
						</span>
					</div>				
				</div>
			<?php } ?>
		<?php } ?>
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Description</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">				
					<textarea name="description" id="description" class="form-control required"><?php echo $test_info->description;?></textarea>					
				</span>
			</div>				
		</div>
		 <?php if($test_info->is_real_test != 3){?>
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Result Text</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">		
						<textarea name="result_text" id="result_text" class="form-control required" rows="6"><?php echo $test_info->result_text;?></textarea>					
					</span>
				</div>				
			</div>
		<?php } ?>
		
	<?php if($this->session->userdata('user_type') != 2){?>
		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Fb Share Description</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<textarea name="fbshare_des" id="fbshare_des" class="form-control"><?php echo $test_info->fbshare_des;?></textarea>					

				</span>

			</div>				

		</div>



		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Flags</label>

			<div class="col-xs-12 col-sm-5" style="line-height:40px;">

				<span class="block input-icon input-icon-right">					

					<?php

						$pre_flags=$test_info->flags;

						$pre_flag_ids=array();

						if($pre_flags) $pre_flag_ids=unserialize($pre_flags);

						if($flags)

						{

							foreach($flags as $flag)

							{

								?>

								<input type="checkbox" name="flags[]" value="<?php echo $flag->flag_id;?>" <?php if(in_array($flag->flag_id,$pre_flag_ids)) echo 'checked="checked"';?> /> <?php echo  $flag->flag;?> &nbsp; &nbsp;

								<?php

							}

						}

					?>					

				</span>

			</div>				

		</div>
		
		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Test Type</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					
					<input type="radio" name="is_real_test" value="0" <?php if($test_info->is_real_test == 0) echo "checked";?>  /> Personal Test  <br />
					<input type="radio" name="is_real_test" value="1" <?php if($test_info->is_real_test == 1) echo "checked";?> /> Real Test <br />
					<input type="radio" name="is_real_test" value="2" <?php if($test_info->is_real_test == 2) echo "checked";?> /> Twist Test <br />
					<input type="radio" name="is_real_test" value="3" <?php if($test_info->is_real_test == 3) echo "checked";?> /> 3apps Test <br />
					<input type="radio" name="is_real_test" value="4" <?php if($test_info->is_real_test == 4) echo "checked";?> /> How Old  <br />
					<input type="radio" name="is_real_test" value="5" <?php if($test_info->is_real_test == 5) echo "checked";?> /> Face Test <br />
					<input type="radio" name="is_real_test" value="6" <?php if($test_info->is_real_test == 6) echo "checked";?> /> Face facbook Apps
									
				</span>

			</div>				

		</div>
		
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Test Banners</label>
			<div class="col-xs-12 col-sm-5">
				<select name="banner_ids[]"  class="form-control" multiple="multiple" style="height:150px;">
					<?php
						$template="personal";
						if($test_info->is_real_test == 0) $template="personal";
						if($test_info->is_real_test == 1) $template="real";
						if($test_info->is_real_test == 2) $template="twist";
						if($test_info->is_real_test == 3) $template="3apps";
						if($test_info->is_real_test == 4) $template="how_old";
						if($test_info->is_real_test == 5) $template="face_test";
						if($test_info->is_real_test == 6) $template="facebook_apps";
						
						$banners=$this->test_model->get_banners($template);
						
						$banner_ids=$this->test_model->get_test_banner_ids($test_info->tests_id);
						if($banners)
						{
							foreach($banners as $banner)
							{
								?>
									<option value="<?php echo $banner->banner_id;?>" <?php if(in_array($banner->banner_id,$banner_ids)) echo "selected";?>><?php echo $banner->title;?></option>
								<?php
							}
						}
					?>
			    </select>
			</div>			
		</div>


		<?php
		//if($test_info->is_real_test == 3)
		//{
		?>
		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">&nbsp;</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

								<input type="checkbox" name="featured" value="3" <?php if($test_info->featured == 3) echo 'checked="checked"';?> />  Is Promoted?

				</span>

			</div>				

		</div>
		<?php
		//}
		?>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Image Upload </label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">				
					<input type="file" name="image" id="image" value="" />
					<?php if($test_info->image) { ?>	
						<img src="<?php echo base_url(); ?>assets/img/image/<?php echo $test_info->image; ?>" style="height:150px; width:200px;" />	
						<input type="hidden" name="pre_img_path" value="assets/img/image/<?php echo $test_info->image; ?>" />
					<?php } ?>	
				</span>
			</div>				
		</div>
		
		<?php
		if($lan == 'en')
		{
		?>
		
		
		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Thumb Image Upload</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">				
					<input type="file" name="image_thumb" id="image_thumb" value="" />
					<?php if($test_info->image_thumb) { ?>	

						<img src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $test_info->image_thumb; ?>" style="height:150px; width:200px;" />
						<input type="hidden" name="pre_img_path2" value="assets/img/thumbs/<?php echo $test_info->image_thumb; ?>" />
					<?php } ?>	

				</span>

			</div>				

		</div>
		<?php
		}
		?>
		
		<?php if($test_info->is_real_test == 6) { ?>
			<?php  $result_bg_image=get_testMeta($test_info->tests_id,'fb_apps_result_image');?>
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Facebook Apps result Image</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">				
						<input type="file" name="result_bg_image" id="result_bg_image" value="" />
						<?php if($result_bg_image) { ?>
							<img src="<?php echo base_url(); ?>assets/img/test_result_img/<?php echo $result_bg_image; ?>" style="height:150px; width:200px;" />
							<input type="hidden" name="pre_img_path3" value="assets/img/test_result_img/<?php echo $result_bg_image; ?>" />
						<?php } ?>
					</span>
				</div>	
			</div>
			<?php
		if($lan == 'en')
		{
		?>
			<?php  $test_view_img=get_testMeta($test_info->tests_id,'test_view_img');?>
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Test view Image</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">				
						<input type="file" name="test_view_img" id="test_view_img" value="" />
						<?php if($test_view_img) { ?>
							<img src="<?php echo base_url(); ?>assets/img/image/<?php echo $test_view_img; ?>" style="height:150px; width:200px;" />
							<input type="hidden" name="pre_img_path4" value="assets/img/image/<?php echo $test_view_img; ?>" />
						<?php } ?>
					</span>
				</div>	
			</div>
			<?php
			}
			?>
			<?php  $button_text=get_testMeta($test_info->tests_id,'button_text');?>
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Button Text</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<input type="text" class="form-control required" id="button_text" name="button_text" value="<?php echo $button_text;?>">				
					</span>
				</div>				
			</div>
			
			
			<?php
			if($lan == 'en')
			{
			?>
			<?php  $number_of_posts=get_testMeta($test_info->testid,'number_of_posts');?>
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Number of Posts</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<input type="text" class="form-control required" id="number_of_posts" name="number_of_posts" value="<?php echo $number_of_posts;?>">				
					</span>
				</div>				
			</div>
			
			<?php  $number_of_photos=get_testMeta($test_info->testid,'number_of_photos');?>
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Number of Photos</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<input type="text" class="form-control required" id="number_of_photos" name="number_of_photos" value="<?php echo $number_of_photos;?>">				
					</span>
				</div>				
			</div>
			<?php
			}
			?>
		<?php } ?>
		
		<?php

		} 

		?>

		  <div class="col-md-offset-3 col-sm-offset-3">

		  		<input type="hidden" name="tests_id" value="<?php echo $test_info->testid;?>" />
				<input type="hidden" name="testId" value="<?php echo $test_info->tests_id;?>" />
				

				<input type="hidden" name="edit_test" value="edit_test" />

           		 <button type="submit" class="btn btn-primary">Save </button>  

				<button class="btn btn-danger" onclick="history.back()" type="button">Cancel</button>  

          </div> 

		



</form>  











<script language="javascript">



// REGISTRATION FORM VALIDATION (THE SHORTER FORM)



jQuery(document).ready(function () {



	jQuery('#add_form').validate({});



}); // end document.ready









</script>



<script type="text/javascript">

		$(function () {

				$('#datetimepicker').datetimepicker();

		});

</script>



