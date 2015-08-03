<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/graphic_edit/<?php echo $test_info->testid;?>/<?php echo $lang_code; ?>/<?php echo $referance;?>" method="post" enctype="multipart/form-data">  



		  <div class="form-group">

				<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right"></label>

				<div class="col-xs-12 col-sm-5">

					<span class="block input-icon input-icon-right" style="color:#FF0000;">

						<?php echo validation_errors(); ?>					

					</span>

				</div>				

			</div>

		 

		  <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Image Upload</label>

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

		  <div class="col-md-offset-3 col-sm-offset-3">

		  		<input type="hidden" name="tests_id" value="<?php echo $test_info->tests_id;?>" />

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



