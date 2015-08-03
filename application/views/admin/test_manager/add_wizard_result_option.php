<h3 class="text-center col-sm-10" style="color:#0000FF; font-size:28px; margin-bottom:25px;"><?php echo $this->test_model->addOrdinalNumberSuffix($result_num);?>  Result Option </h3>

<div style="clear:both;"></div>



<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/test_manager/add_wizard_result_option/<?php echo $test_id;?>/<?php echo $lang; ?>/<?php echo $result_num;?>" method="post" enctype="multipart/form-data">  

		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Result</label>
			<div class="col-xs-12 col-sm-5">
				<?php if($default_result) echo $default_result->result; ?>
				<span class="block input-icon input-icon-right">					
					<input type="hidden" name="test_id" id="test_id" value="<?php echo $test_id;?>" />
					<input type="text" class="form-control required" id="result" name="result" value="<?php if($result_info) echo $result_info->result; ?>">					
				</span>
			</div>				

		</div>

		

		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Result Description</label>
			<div class="col-xs-12 col-sm-5">
				<?php if($default_result) echo $default_result->result_description; ?>
				<span class="block input-icon input-icon-right">
					<textarea class="form-control" name="result_description" id="result_description"><?php if($result_info) echo $result_info->result_description; ?></textarea>					
				</span>
			</div>				
		</div>

		<?php /*?><?php

			if($result_num < 2)
			{
				$interval_from=0;
				$interval_to=3;
			}
			else
			{
				$diff=$result_num - 2;
				$interval_from=($result_num * 2) + $diff;
				$interval_to=$interval_from + 2;
			}

		?>

		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Interval From</label>
			<div class="col-xs-12 col-sm-1 col-md-1">
				<?php if($default_result) echo $default_result->interval_from; ?>
				<span class="block input-icon input-icon-right">
					<input type="text" class="form-control required" id="interval_from" name="interval_from" value="<?php echo $interval_from;?>">					
				</span>
			</div>	
			<label for="inputInfo" class="col-xs-12 col-sm-2 control-label no-padding-right">Interval To</label>	

			<div class="col-xs-12 col-sm-1 col-md-1">
				<?php if($default_result) echo $default_result->interval_to; ?>
				<span class="block input-icon input-icon-right">
					<input type="text" class="form-control required" id="interval_to" name="interval_to" value="<?php echo $interval_to;?>">					
				</span>
			</div>			
		</div><?php */?>

		



		

		  <div class="col-md-offset-4 col-sm-offset-4">

				<input type="hidden" name="add_result_option" value="add_result_option" />
				<input type="hidden" name="result_optionid" value="<?php  echo $default_result->result_optionid; ?>"  /> 
				<input type="hidden" name="interval_from" value="<?php  echo $default_result->interval_from; ?>"  /> 
				<input type="hidden" name="interval_to" value="<?php  echo $default_result->interval_to; ?>"  />
				<input type="hidden" name="test_result_img" value="<?php  echo $default_result->test_result_img; ?>"  />
				<input type="hidden" name="font_name" value="<?php  echo $default_result->font_name; ?>"  />
				<input type="hidden" name="font_color" value="<?php  echo $default_result->font_color; ?>"  />
				
				
				<input type="hidden" name="result_info" value="<?php if($result_info) echo "1"; else echo "0"; ?>"  />
				
           		 <button type="submit" class="btn btn-success btn-lg col-sm-3">Save & Next </button> 

				 <?php

				 	/*if($result_num > 1)

					{

						?>

						 <a href="<?php echo site_url();?>admin/tests/test_add_wizard"><button style="margin:auto 10px;" type="button" class="btn btn-primary btn-lg col-sm-2">New Test </button></a>

						<?php

					}*/

				 ?>

				

          </div> 

		



</form>  

















<script language="javascript">



	



// REGISTRATION FORM VALIDATION (THE SHORTER FORM)



jQuery(document).ready(function () {



	jQuery('#add_form').validate({});



}); // end document.ready











</script>