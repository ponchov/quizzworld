<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/answer_edit/<?php echo $answer_info->answereid;?>/<?php echo $test_question_id; ?>/<?php echo $lang_code; ?>/<?php echo $referance;?>" method="post" >  



		    

		  <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Answere</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<textarea name="answere" id="answere" class="form-control required"><?php echo $answer_info->answere;?></textarea>					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Marks</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="marks" name="marks" value="<?php echo $answer_info->marks;?>">					

				</span>

			</div>				

		</div>

		

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



		  <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="edit_answer" value="edit_answer" />
				<input type="hidden" name="testid" value="<?php echo $testid;?>" />

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