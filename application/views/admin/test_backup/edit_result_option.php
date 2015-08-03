<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/result_option_edit/<?php echo $result_optionid;?>/<?php echo $test_info->tests_id;?>/<?php echo $lang_code; ?>/<?php echo $referance; ?>" method="post" enctype="multipart/form-data" >  



		    

		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Interval From</label>

			<div class="col-xs-12 col-sm-2 col-md-2">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="interval_from" name="interval_from" value="<?php echo $result_option->interval_from;?>">					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Interval To</label>

			<div class="col-xs-12 col-sm-2 col-md-2">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="interval_to" name="interval_to" value="<?php echo $result_option->interval_to;?>">					

				</span>

			</div>				

		</div>

		

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Result</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					

					<input type="text" class="form-control required" id="result" name="result" value="<?php echo $result_option->result;?>">					

				</span>

			</div>				

		</div>

		

		



		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Result Description</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea class="form-control" name="result_description" id="result_description"><?php echo $result_option->result_description;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Image Upload</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<input type="file" name="test_result_img" id="test_result_img" value="" />

					<?php if($result_option->test_result_img) { ?>	

						<img src="<?php echo base_url(); ?>assets/img/test_result_img/<?php echo $result_option->test_result_img; ?>" style="height:150px; width:200px;" />	

						<input type="hidden" name="pre_img_path" value="assets/img/test_result_img/<?php echo $result_option->test_result_img; ?>" />

					<?php } ?>	

				</span>

				

			</div>				

		</div>

		



		  <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="edit_result_option" value="add_result_option" />

				<input type="hidden" name="test_id" id="test_id" value="<?php echo $test_id;?>" />

				<input type="hidden" name="result_optionid" id="result_optionid" value="<?php echo $result_optionid;?>" />

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