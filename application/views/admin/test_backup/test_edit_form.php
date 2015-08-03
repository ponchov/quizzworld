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

		<?php 

		if($this->session->userdata('user_type') != 2)

		{

		?>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Alias</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="alias" name="alias" value="<?php echo $test_info->alias;?>">					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Page Title</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="page_title" name="page_title" value="<?php echo $test_info->page_title;?>">					

				</span>

			</div>				

		</div>

		

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

		

		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Description</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<textarea name="description" id="description" class="form-control required"><?php echo $test_info->description;?></textarea>					

				</span>

			</div>				

		</div>

		

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Starting Point</label>

			<div class="col-xs-12 col-sm-3 col-md-3">

				<span class="block input-icon input-icon-right">					

					<input type="text" class="form-control required" id="start_point" name="start_point" value="<?php echo $test_info->start_point;?>">				

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Result Text</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<textarea name="result_text" id="result_text" class="form-control required" rows="6"><?php echo $test_info->result_text;?></textarea>					

				</span>

			</div>				

		</div>

		

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

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Is Real Test</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<input type="checkbox" name="is_real_test" id="is_real_test" value="1" <?php if($test_info->is_real_test == 1)  echo 'checked="checked"'; ?> />					

				</span>

			</div>				

		</div>



		



		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Image Upload</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<input type="file" name="image" id="image" value="" />

					<?php if($test_info->image) { ?>	

						<img src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $test_info->image_thumb; ?>" style="height:150px; width:200px;" />	

						<input type="hidden" name="pre_img_path" value="assets/img/image/<?php echo $test_info->image_thumb; ?>" />
						<input type="hidden" name="pre_img_path2" value="assets/img/thumbs/<?php echo $test_info->image_thumb; ?>" />

					<?php } ?>	

				</span>

			</div>				

		</div>

		<?php

		} 

		?>

		  <div class="col-md-offset-3 col-sm-offset-3">

		  		<input type="hidden" name="tests_id" value="<?php echo $test_info->testid;?>" />

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



