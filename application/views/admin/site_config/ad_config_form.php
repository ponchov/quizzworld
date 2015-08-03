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

<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/site_config/ad_config" method="post" enctype="multipart/form-data">  

		 

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">DFP Ad</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="dfp_ad" id="dfp_ad" class="form-control" rows="6"><?php echo $config_info->dfp_ad;?></textarea>					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Home Top Adsense</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="adsense" id="adsense" class="form-control" rows="6"><?php echo $config_info->adsense;?></textarea>					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Home Middle Adsense</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="adsense_middle" id="adsense_middle" class="form-control" rows="6"><?php echo $config_info->adsense_middle;?></textarea>					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Home Bottom Adsense </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="adsense_bottom" id="adsense_bottom" class="form-control" rows="6"><?php echo $config_info->adsense_bottom;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Home Sky Left Adsense </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="adsense_sky_left" id="adsense_sky_left" class="form-control" rows="6"><?php echo $config_info->adsense_sky_left;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Home Sky Right Adsense </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="adsense_sky_right" id="adsense_sky_right" class="form-control" rows="6"><?php echo $config_info->adsense_sky_right;?></textarea>					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Test Top Adsense </label>

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

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Test Sidebar top <!--Sky Left Adsense--> </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="test_sky_left_adsense" id="test_sky_left_adsense" class="form-control" rows="6"><?php echo $config_info->test_sky_left_adsense;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Test Sidebar Bottom <!--Sky Right Adsense--> </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="test_sky_right_adsense" id="test_sky_right_adsense" class="form-control" rows="6"><?php echo $config_info->test_sky_right_adsense;?></textarea>					

				</span>

			</div>				

		</div>
		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Test ASWm  </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="test_wm_adsense" id="test_wm_adsense" class="form-control" rows="6"><?php echo $config_info->test_wm_adsense;?></textarea>					

				</span>

			</div>				

		</div>
		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Test Tabola  </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="test_tabo_adsense" id="test_tabo_adsense" class="form-control" rows="6"><?php echo $config_info->test_tabo_adsense;?></textarea>					

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

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Question Middle </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="question_bottom_adsense2" id="question_bottom_adsense2" class="form-control" rows="6"><?php echo $config_info->question_bottom_adsense2;?></textarea>					

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

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Question Sidebar Top <!--Sky Left Adsense--> </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="question_sky_left_adsense" id="question_sky_left_adsense" class="form-control" rows="6"><?php echo $config_info->question_sky_left_adsense;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Question Sidebar Bottom <!--Sky Right Adsense--> </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="question_sky_right_adsense" id="question_sky_right_adsense" class="form-control" rows="6"><?php echo $config_info->question_sky_right_adsense;?></textarea>					

				</span>

			</div>				

		</div>
		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Question ASWm </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="question_wm_adsense" id="question_wm_adsense" class="form-control" rows="6"><?php echo $config_info->question_wm_adsense;?></textarea>					

				</span>

			</div>				

		</div>
		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Question Tabola </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="question_tabo_adsense" id="question_tabo_adsense" class="form-control" rows="6"><?php echo $config_info->question_tabo_adsense;?></textarea>					

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

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right"> Result Sidebar Top <!--Sky Left Adsense--> </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="result_sky_left_adsense" id="result_sky_left_adsense" class="form-control" rows="6"><?php echo $config_info->result_sky_left_adsense;?></textarea>					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right"> Result Sidebar Bottom <!--Sky Right Adsense--> </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="result_sky_right_adsense" id="result_sky_right_adsense" class="form-control" rows="6"><?php echo $config_info->result_sky_right_adsense;?></textarea>					

				</span>

			</div>				

		</div>
		
		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right"> Result ASWm </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="result_wm_adsense" id="result_wm_adsense" class="form-control" rows="6"><?php echo $config_info->result_wm_adsense;?></textarea>					

				</span>

			</div>				

		</div>
		
		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right"> Result Tabola </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="result_tabo_adsense" id="result_tabo_adsense" class="form-control" rows="6"><?php echo $config_info->result_tabo_adsense;?></textarea>					

				</span>

			</div>				

		</div>

		

		

		

		

		  <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="edit_config" value="edit_config" />

           		 <button type="submit" class="btn btn-primary">Save </button>  

				 

          </div> 

		



</form>  


<div style="height:40px;"></div>










<script language="javascript">



	



// REGISTRATION FORM VALIDATION (THE SHORTER FORM)



jQuery(document).ready(function () {



	jQuery('#add_form').validate({});



}); // end document.ready











</script>