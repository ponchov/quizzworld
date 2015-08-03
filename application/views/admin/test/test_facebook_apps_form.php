<h3 class="text-center col-sm-10" style="color:#0000FF; font-size:28px; margin-bottom:25px;">Create New Facebook Apps Test</h3>
<div style="clear:both;"></div>
<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/facebook_apps" method="post" enctype="multipart/form-data">  
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Title</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<input type="text" class="form-control required" id="title" name="title" value="">					
				</span>
			</div>				
		</div>


		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Page Title</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<input type="text" class="form-control required" id="page_title" name="page_title" value="">				
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Sub Title</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<input type="text" class="form-control required" id="sub_title" name="sub_title" value="">				
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Description </label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="description" id="description" class="form-control"></textarea>					
				</span>
			</div>

			<div class="col-sm-4">
				<small>Please add 2 funny, engaging sentences which we'll show on facebook promoting this test. i.e.<span style="color:#FF0000;">'Do you know what kind of partner you are? :) Take the test to find out.'</span></small>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Result Text</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">				
					<textarea name="result_text" id="result_text" class="form-control required" rows="6"></textarea>					
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Button Text</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<input type="text" class="form-control required" id="button_text" name="button_text" value="">				
				</span>
			</div>				
		</div>
		
		<?php if($this->session->userdata('user_type') != 2) { ?>
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Number of Posts</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<input type="text" class="form-control required" id="number_of_posts" name="number_of_posts" value="">				
				</span>
			</div>				
		</div>
		
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Number of Photos</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<input type="text" class="form-control required" id="number_of_photos" name="number_of_photos" value="">				
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Background Image</label>
			<div class="col-xs-12 col-sm-5">
				<input type="file" name="image" id="image" value="" />
			</div>			
		</div>
		
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Thumb Image</label>
			<div class="col-xs-12 col-sm-5">
				<input type="file" name="image_thumb" id="image_thumb" value="" />
			</div>			
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Result Background Image</label>
			<div class="col-xs-12 col-sm-5">
				<input type="file" name="result_image" id="result_image" value="" />
			</div>			
		</div>
		
		<?php 
		}
		?>
          <div class="col-md-offset-4 col-sm-offset-4">
				<input type="hidden" name="add_test" value="add_test" />
				<button type="submit" class="btn btn-success col-sm-3 btn-lg">Add</button> 
          </div>  

</form>  


<script language="javascript">
jQuery(document).ready(function () {
	jQuery('#add_form').validate({});
}); // end document.ready

</script>