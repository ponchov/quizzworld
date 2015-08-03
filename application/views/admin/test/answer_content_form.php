<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/answer_content/<?php echo $answereid;?>/<?php echo $test_question_id; ?>/<?php echo $lang_code; ?>" method="post" >  



		  <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Answere</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					
					<?php if(!($lang_code == "en")) echo $en_answer_info->answere; ?>
					<textarea name="answere" id="answere" class="form-control required"><?php if($answer_info) echo $answer_info->answere;?></textarea>					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Marks</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					
					<?php if(!($lang_code == "en")) echo $en_answer_info->marks; ?>
					<input type="text" class="form-control required" id="marks" name="marks" value="<?php if($answer_info) echo $answer_info->marks;?>">

					(Marks all time have to english)					

				</span>

			</div>				

		</div>

		<?php if($answer_info) { ?>

		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Status</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<select name="status" id="status" class="form-control">

					<option value="1" <?php if($answer_info->status == 1) echo "selected";?>>Active</option>

					<option value="2"  <?php if($answer_info->status == 2) echo "selected";?>>Inactive</option>

				  </select>					

				</span>

			</div>				

		</div>

		<?php } ?>



		  <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="edit_answer_content" value="edit_answer_content" />

				<input type="hidden" name="have_answer" value="<?php if($answer_info) echo "1"; else echo "0"; ?>" />

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