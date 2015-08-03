<?php

if($this->session->flashdata('success_message'))

{

?>

	<div class="alert alert-success">  

	  <a class="close" data-dismiss="alert">x</a>  

	  <strong>Success!</strong><?php echo $this->session->flashdata('success_message');?>  

	</div> 

<?php

}



?>

<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/ads_edit/<?php echo $test_id;?>" method="post" enctype="multipart/form-data">  

		 

		
	<?php if($test_info->is_real_test == 2){ ?>		
		
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense Twist Top</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<textarea name="test_top_adsense" id="test_top_adsense" class="form-control" rows="6"><?php echo $config_info->test_top_adsense;?></textarea>					
					</span>
				</div>				
			</div>
			
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense Twist Middle</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<textarea name="test_middle_adsense" id="test_middle_adsense" class="form-control" rows="6"><?php echo $config_info->test_middle_adsense;?></textarea>					
					</span>
				</div>				
			</div>
			
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense Twist Bottom</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<textarea name="test_bottom_adsense" id="test_bottom_adsense" class="form-control" rows="6"><?php echo $config_info->test_bottom_adsense;?></textarea>					
					</span>
				</div>				
			</div>
		
		<?php }  else if($test_info->is_real_test == 3){ ?>
		
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense 3apps Top</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<textarea name="test_top_adsense" id="test_top_adsense" class="form-control" rows="6"><?php echo $config_info->test_top_adsense;?></textarea>					
					</span>
				</div>				
			</div>
			
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense 3apps Middle</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<textarea name="test_middle_adsense" id="test_middle_adsense" class="form-control" rows="6"><?php echo $config_info->test_middle_adsense;?></textarea>					
					</span>
				</div>				
			</div>
			
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense 3apps Bottom</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<textarea name="test_bottom_adsense" id="test_bottom_adsense" class="form-control" rows="6"><?php echo $config_info->test_bottom_adsense;?></textarea>					
					</span>
				</div>				
			</div>
		
		<?php }  else if($test_info->is_real_test == 5){ ?>
		
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense Face Test Top</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<textarea name="test_top_adsense" id="test_top_adsense" class="form-control" rows="6"><?php echo $config_info->test_top_adsense;?></textarea>					
					</span>
				</div>				
			</div>
			
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense Face Test Middle</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<textarea name="test_middle_adsense" id="test_middle_adsense" class="form-control" rows="6"><?php echo $config_info->test_middle_adsense;?></textarea>					
					</span>
				</div>				
			</div>
			
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense Face Test Bottom</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<textarea name="test_bottom_adsense" id="test_bottom_adsense" class="form-control" rows="6"><?php echo $config_info->test_bottom_adsense;?></textarea>					
					</span>
				</div>				
			</div>
		
		<?php } else { ?>
		

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Test Top Adsense</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="test_top_adsense" id="test_top_adsense" class="form-control" rows="6"><?php echo $config_info->test_top_adsense;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Test Middle Adsense </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="test_middle_adsense" id="test_middle_adsense" class="form-control" rows="6"><?php echo $config_info->test_middle_adsense;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Test Middle Adsense2 </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="test_middle_adsense2" id="test_middle_adsense2" class="form-control" rows="6"><?php echo $config_info->test_middle_adsense2;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Test Bottom Adsense </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="test_bottom_adsense" id="test_bottom_adsense" class="form-control" rows="6"><?php echo $config_info->test_bottom_adsense;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Test Sky Left Adsense </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="test_sky_left_adsense" id="test_sky_left_adsense" class="form-control" rows="6"><?php echo $config_info->test_sky_left_adsense;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Test Sky Right Adsense </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="test_sky_right_adsense" id="test_sky_right_adsense" class="form-control" rows="6"><?php echo $config_info->test_sky_right_adsense;?></textarea>					

				</span>

			</div>				

		</div>
		
		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Question Top Adsense </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="question_top_adsense" id="question_top_adsense" class="form-control" rows="6"><?php echo $config_info->question_top_adsense;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Question Top Adsense2 </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="question_top_adsense2" id="question_top_adsense2" class="form-control" rows="6"><?php echo $config_info->question_top_adsense2;?></textarea>					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Question Bottom Adsense </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="question_bottom_adsense" id="question_bottom_adsense" class="form-control" rows="6"><?php echo $config_info->question_bottom_adsense;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Question Bottom Adsense2 </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="question_bottom_adsense2" id="question_bottom_adsense2" class="form-control" rows="6"><?php echo $config_info->question_bottom_adsense2;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Question Sky Left Adsense </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="question_sky_left_adsense" id="question_sky_left_adsense" class="form-control" rows="6"><?php echo $config_info->question_sky_left_adsense;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Question Sky Right Adsense </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="question_sky_right_adsense" id="question_sky_right_adsense" class="form-control" rows="6"><?php echo $config_info->question_sky_right_adsense;?></textarea>					

				</span>

			</div>				

		</div>

		

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right"> Result Top Adsense </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="result_adsense" id="result_adsense" class="form-control" rows="6"><?php echo $config_info->result_adsense;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right"> Result Middle Adsense </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="result_middle_adsense" id="result_middle_adsense" class="form-control" rows="6"><?php echo $config_info->result_middle_adsense;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right"> Result Middle Adsense2 </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="result_middle_adsense2" id="result_middle_adsense2" class="form-control" rows="6"><?php echo $config_info->result_middle_adsense2;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right"> Result Bottom Adsense </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="result_bottom_adsense" id="result_bottom_adsense" class="form-control" rows="6"><?php echo $config_info->result_bottom_adsense;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right"> Result Sky Left Adsense </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="result_sky_left_adsense" id="result_sky_left_adsense" class="form-control" rows="6"><?php echo $config_info->result_sky_left_adsense;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right"> Result Sky Right Adsense </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="result_sky_right_adsense" id="result_sky_right_adsense" class="form-control" rows="6"><?php echo $config_info->result_sky_right_adsense;?></textarea>					

				</span>

			</div>				

		</div>
		
		<?php }  ?>

		

		

		  <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="edit_config" value="edit_config" />

           		 <button type="submit" class="btn btn-primary">Save </button>  

				 

          </div> 

		



</form>  











<script language="javascript">



	



// REGISTRATION FORM VALIDATION (THE SHORTER FORM)



jQuery(document).ready(function () {



	jQuery('#add_form').validate({});



}); // end document.ready











</script>