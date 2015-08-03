<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/result_content/<?php echo $result_optionid; ?>/<?php echo $test_id; ?>/<?php echo $lang_code; ?>" method="post" enctype="multipart/form-data">  



		    <?php //echo $lang_code; ?>

		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Interval From66</label>

			<div class="col-xs-12 col-sm-2 col-md-2">

				<span class="block input-icon input-icon-right">
					<?php if(!($lang_code == "en")) echo $eng_result_option->interval_from; ?>
					<input type="text" class="form-control required" id="interval_from" name="interval_from" value="<?php if($result_option) echo $result_option->interval_from; ?>">					

				</span>

			</div>	

			<div class="col-sm-5 col-md-5">(interval all time have to english) </div>			

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Interval To</label>

			<div class="col-xs-12 col-sm-2 col-md-2">

				<span class="block input-icon input-icon-right">
				<?php if(!($lang_code == "en")) echo $eng_result_option->interval_to; ?>
					<input type="text" class="form-control required" id="interval_to" name="interval_to" value="<?php if($result_option) echo $result_option->interval_to; ?>">					

				</span>

			</div>	

			<div class="col-sm-5 col-md-5">(interval all time have to english) </div>			

		</div>

		

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Result</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					
					<?php if(!($lang_code == "en")) echo $eng_result_option->result; ?>
					<input type="hidden" name="test_id" id="test_id" value="<?php echo $test_id;?>" />					

					<input type="text" class="form-control required" id="result" name="result" value="<?php if($result_option) echo $result_option->result; ?>">					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Result Description</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					
					<?php if(!($lang_code == "en")) echo $eng_result_option->result_description; ?>
					<textarea class="form-control" name="result_description" id="result_description"><?php if($result_option) echo $result_option->result_description; ?></textarea>					

				</span>

			</div>				

		</div>

		<?php if($test_info->is_real_test == 3) { ?>
			<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Image Upload</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<?php if($lang_code =='en') { ?>
						<input type="file" name="test_result_img" id="test_result_img" />				
						<?php if($result_option) { ?>
							<?php if($result_option->test_result_img) { ?>	
								<img src="<?php echo base_url(); ?>assets/img/test_result_img/<?php echo $result_option->test_result_img; ?>" style="height:150px; width:200px;" />	
								<input type="hidden" name="pre_img_path" value="assets/img/test_result_img/<?php echo $result_option->test_result_img; ?>" />
							<?php } ?>
						<?php } else { ?>
							<?php if($eng_result_image) { ?>	
								<img src="<?php echo base_url(); ?>assets/img/test_result_img/<?php echo $eng_result_image; ?>" style="height:150px; width:200px;" />
							<?php } ?>
						<?php }  ?>
						<input type="hidden" name="eng_result_image" value="<?php echo $eng_result_image; ?>" />	
					<?php } else { ?> 
						<?php if($eng_result_image) { ?>	
							<img src="<?php echo base_url(); ?>assets/img/test_result_img/<?php echo $eng_result_image; ?>" style="height:150px; width:200px;" />
							
						<?php } ?>
					<?php }  ?>				
				</span>
			</div>				
		</div>
		<?php } else { ?>	
			<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Image Upload</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<input type="file" name="test_result_img" id="test_result_img" />				
					<?php if($result_option) { ?>
						<?php if($result_option->test_result_img) { ?>	
							<img src="<?php echo base_url(); ?>assets/img/test_result_img/<?php echo $result_option->test_result_img; ?>" style="height:150px; width:200px;" />	
							<input type="hidden" name="pre_img_path" value="assets/img/test_result_img/<?php echo $result_option->test_result_img; ?>" />
						<?php } ?>
					<?php } else { ?>
						<?php if($eng_result_image) { ?>	
							<img src="<?php echo base_url(); ?>assets/img/test_result_img/<?php echo $eng_result_image; ?>" style="height:150px; width:200px;" />
						<?php } ?>
					<?php }  ?>
					<input type="hidden" name="eng_result_image" value="<?php echo $eng_result_image; ?>" />					
				</span>
			</div>				
		</div>
		<?php } ?>	

		

		

		



		  <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="result_content_option" value="result_content_option" />

				<input type="hidden" name="have_result" value="<?php if($result_option) echo "1"; else echo "0"; ?>"  />

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