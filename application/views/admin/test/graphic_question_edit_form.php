<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/graphic_question_edit/<?php echo $question_info->test_questionid;?>/<?php echo $test_id; ?>/<?php echo $lang_code; ?>/<?php echo $referance;?>" method="post" enctype="multipart/form-data" >  



		    

		  

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Image Upload</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<span style="color:#FF0000;">(Image should be 660x230) </span>			

					<input type="file" name="image" id="image" value="" />

					<?php if($question_info->image) { ?>	

						<img src="<?php echo base_url(); ?>assets/img/image/<?php echo $question_info->image; ?>" style="height:150px; width:200px;" />	

						<input type="hidden" name="pre_img_path" value="<?php echo $question_info->image; ?>" />

					<?php } ?>	

				</span>

			</div>				

		</div>		

		 



		  <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="edit_question" value="edit_question" />

				<input type="hidden" name="referance" value="<?php echo $referance;?>" />

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