<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/question_content/<?php echo $test_id; ?>/<?php echo $test_questionid; ?>/<?php echo $lang_code; ?>" method="post" enctype="multipart/form-data" >  

		<?php //print_r($question_info); ?>

		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Question</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					
					<?php if(!($lang_code == "en")) echo $eng_question_info->question; ?>
					<input type="text" class="form-control required" id="question" name="question" value="<?php if($question_info) echo $question_info->question; ?>">						

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Image Upload</label>

			<div class="col-xs-12 col-sm-5">

				<span style="color:#FF0000;">(Image should be 660x230) </span>

				<span class="block input-icon input-icon-right">					

					<input type="file" name="image" id="image" value="" />	

					<?php if($question_info) { ?>	
						<?php if($question_info->image) { ?>
						<img src="<?php echo base_url(); ?>assets/img/image/<?php echo $question_info->image; ?>" style="height:150px; width:200px;" />	
						<input type="hidden" name="pre_img_path" value="<?php echo $question_info->image; ?>" />
						<input type="hidden" name="pre_imgpath" value="assets/img/image/<?php echo $question_info->image; ?>" />
						<input type="hidden" name="pre_imgpath2" value="assets/img/image/thumb_<?php echo $question_info->image; ?>" />
						<?php } ?>

					<?php } else { ?>	
						<?php if($eng_question_image) { ?>
						<img src="<?php echo base_url(); ?>assets/img/image/<?php echo $eng_question_image; ?>" style="height:150px; width:200px;" />	
						<?php } ?>

					<?php } ?>	

					<input type="hidden" name="eng_question_image" value="<?php echo $eng_question_image; ?>" />		

				</span>

			</div>				

		</div>

		

	          <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="add_question_content" value="add_question_content" />

				<input type="hidden" name="have_question" value="<?php if($question_info) echo "1"; else echo "0"; ?>" />

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