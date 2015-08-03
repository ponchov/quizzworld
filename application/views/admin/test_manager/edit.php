<link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="<?php echo base_url(); ?>assets/js/moment.js"></script>

<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>





<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/test_manager/edit/<?php echo $testid; ?>/<?php echo $lang_code; ?>" method="post" enctype="multipart/form-data">  

		  <div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right"></label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right" style="color:#FF0000;">
						<?php echo validation_errors(); ?>				
					</span>
				</div>				
			</div>

		 <div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Title</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<?php if(!($lang_code == "en")) echo $eng_test_info->title; ?>
					<input type="text" class="form-control required" id="title" name="title" value="<?php if($test_info) echo $test_info->title;?>">					
				</span>
			</div>				

		</div>
		<?php
			if($test_info)
			{ 
				$sub_title=get_testMeta($test_info->tests_id,'sub_title');
			}
			
			if(!($lang_code == "en"))
			{
				$eng_sub_title=get_testMeta($eng_test_info->tests_id,'sub_title');
			}
			
		?>
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Sub Title</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<?php if(!($lang_code == "en")) echo $eng_sub_title; ?>
					<textarea name="sub_title" class="form-control required" id="sub_title" ><?php if(!empty($sub_title)) echo $sub_title; ?></textarea>				
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Page Title</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<?php if(!($lang_code == "en")) echo $eng_test_info->page_title; ?>
					<input type="text" class="form-control required" id="page_title" name="page_title" value="<?php if($test_info) echo $test_info->page_title;?>">					
				</span>
			</div>				
		</div>
		
		 <div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Description</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">					
					<?php if(!($lang_code == "en")) echo $eng_test_info->description; ?>
					<textarea name="description" id="description" class="form-control required"><?php if($test_info) echo $test_info->description;?></textarea>					
				</span>
			</div>				
		</div>
		
		<?php if($eng_test_info->is_real_test != 3){?>
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Result Text</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">					
						<?php if(!($lang_code == "en")) echo "<pre>".htmlentities($eng_test_info->result_text)."</pre>"; ?>
						<textarea name="result_text" id="result_text" class="form-control required" rows="6"><?php if($test_info) echo $test_info->result_text;?></textarea>					
					</span>
				</div>				
			</div>
		<?php } ?>

		
		<?php if($this->session->userdata('user_type') != 2){ ?>
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Fb Share Description</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">					
					<?php if(!($lang_code == "en")) echo $eng_test_info->fbshare_des; ?>
					<textarea name="fbshare_des" id="fbshare_des" class="form-control"><?php if($test_info) echo $test_info->fbshare_des;?></textarea>					
				</span>
			</div>				
		</div>

		<?php
		}
		?>
		
		<?php
		if($eng_test_info->is_real_test == 6)
		{
		?>
		
			<?php 
				$button_text=get_testMeta($eng_test_info->tests_id,'button_text');
				 $en_button_text=$button_text;
				if($test_info) $button_text=get_testMeta($test_info->tests_id,'button_text');
			?>
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Button Text</label>
				<div class="col-xs-12 col-sm-5">
					<?php echo $en_button_text;?> <br />
					<span class="block input-icon input-icon-right">
						<input type="text" class="form-control required" id="button_text" name="button_text" value="<?php if($test_info) echo $button_text;?>">				
					</span>
				</div>				
			</div>
		<?php
		}
		?>
		  <div class="col-md-offset-3 col-sm-offset-3">

		  		<input type="hidden" name="testid" value="<?php echo $testid; ?>" />
				<input type="hidden" name="tests_Id" value="<?php if($test_info) echo $test_info->tests_id;  ?>" />
				<input type="hidden" name="lang_code" value="<?php echo $lang_code; ?>" />
				<input type="hidden" name="eng_test_alias" value="<?php echo $eng_test_alias; ?>" />				
				<input type="hidden" name="test_info" value="<?php if($test_info) echo "1"; else echo "0"; ?>" />
				<input type="hidden" name="test_edit" value="test_edit" />
           		<button type="submit" class="btn btn-success btn-lg col-sm-3">Next</button>  

				

          </div> 

		



</form>  

<div style="height:40px; clear:both;"></div>











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



