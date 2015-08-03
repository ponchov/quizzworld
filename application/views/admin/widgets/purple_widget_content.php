<form class="form-horizontal" action="<?php echo site_url();?>admin/widgets/purple_widget_content/<?php echo $en_widget_info->purple_widgetid;?>/<?php echo $lang; ?>" method="post" enctype="multipart/form-data">
 	
	<div class="form-group">
		<label for="inputInfo" class="col-xs-12 col-sm-2  control-label no-padding-right">Status</label>
		<div class="col-xs-12 col-sm-5">
			<select name="status" id="status" class="form-control">
				<option value="1" <?php if($widget_info->status == 1) echo "selected"; ?> >Active</option>
				<option value="0" <?php if($widget_info->status == 0) echo "selected"; ?> >Inactive</option>
			</select>				
		</div>				
	</div>
	
	<div class="form-group">
		<label for="inputInfo" class="col-xs-12 col-sm-2  control-label no-padding-right">Type</label>
		<div class="col-xs-12 col-sm-5">
			<select name="test_type" id="test_type" class="form-control">
				<option value="">Select Type</option>
				<option value="latest_test_category" <?php if($widget_info->test_type == "latest_test_category") echo "selected"; ?> >Latest test in certain category</option>
				<option value="specific_test" <?php if($widget_info->test_type == "specific_test") echo "selected"; ?> >Specific test</option>
				<option value="recent_test" <?php if($widget_info->test_type == "recent_test") echo "selected"; ?> >Recent test all together</option>
				<option value="external_link" <?php if($widget_info->test_type == "external_link") echo "selected"; ?> >External link</option>				
			</select>				
		</div>				
	</div>
	
	<div class="form-group template" style="">
		<label for="inputInfo" class="col-xs-12 col-sm-2  control-label no-padding-right">Template</label>
		<div class="col-xs-12 col-sm-5">
			<select name="template" id="template" class="form-control">
				<option value="">Select Template</option>
				<option value="personal" <?php if($widget_info->template == "personal") echo "selected"; ?> >Personal Test</option>
				<option value="2" <?php if($widget_info->template == 2) echo "selected"; ?>>Twist Test</option>
				<option value="3" <?php if($widget_info->template == 3) echo "selected"; ?>>Name Test</option>
				<option value="5" <?php if($widget_info->template == 5) echo "selected"; ?>>Face Test</option>
				<option value="6" <?php if($widget_info->template == 6) echo "selected"; ?>>Facebook Apps</option>
			</select>				
		</div>				
	</div>
  
  <div class="form-group specific_test" style="">
		<label for="inputInfo" class="col-xs-12 col-sm-2  control-label no-padding-right">Test Id</label>
		<div class="col-xs-12 col-sm-5">
			<input type="text" class="form-control" name="specific_test_id" id="specific_test_id" value="<?php echo $widget_info->specific_test_id;?>" />			
		</div>				
  </div>

  <div class="form-group extranal" style="">		
		<div class="col-sm-1">&nbsp;</div>
		<div class="col-sm-1 text-right"><label>Url</label></div>
		<div class="col-sm-3"><input type="text" class="form-control"  name="url" placeholder="Url" value="<?php echo $widget_info->url;?>" ></div>
		<div class="col-sm-1 text-right">Title</div>
		<div class="col-sm-3"><input type="text" class="form-control"  name="title" placeholder="Title" value="<?php echo $widget_info->title;?>" ></div>
		<?php if($widget_info->image) {?><div class="col-sm-1 text-right"><img src="<?php echo base_url();?>assets/img/thumbs/<?php echo $widget_info->image;?>" width="50" /></div><?php } ?>
		<div class="col-sm-2"><input type="file" name="image" /></div>
		<input type="hidden" name="pre_path" value="<?php echo $widget_info->image;?>" />
						
  </div>
  
  <div class="form-group">
  		<label for="inputInfo" class="col-xs-12 col-sm-2  control-label no-padding-right">&nbsp;</label>
		<div class="col-xs-12 col-sm-5">
		  <input type="hidden" name="save_widget_content" value="save_widget_content" />
		  <input type="hidden" name="purple_widgetid" value="<?php echo $en_widget_info->purple_widgetid;?>" />
		  <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
	  </div>
  </div>
  
</form>
<br /> <br /> <br />



			
			
			
			
<script language="javascript">
	$(document).ready(function() {
		
		var current_test_type="<?php echo $widget_info->test_type ?>";
		
		if(current_test_type == "latest_test_category")
			{
				$('.specific_test').hide();
				$('.extranal').hide();
				$('.template').show();				
			}
			
			if(current_test_type == "specific_test")
			{
				$('.extranal').hide();
				$('.template').hide();
				$('.specific_test').show();				
			}
			
			if(current_test_type == "external_link")
			{
				$('.template').hide();
				$('.specific_test').hide();
				$('.extranal').show();
			}
			if(current_test_type == "recent_test")
			{
				$('.template').hide();
				$('.specific_test').hide();
				$('.extranal').hide();
			}
			
			if(current_test_type == "")
			{
				$('.template').hide();
				$('.specific_test').hide();
				$('.extranal').hide();
			}
		
		$(document).on('change','#test_type',function(e){
			var test_type=$(this).val();
			
			if(test_type == "latest_test_category")
			{
				$('.specific_test').hide();
				$('.extranal').hide();
				$('.template').show();				
			}
			
			if(test_type == "specific_test")
			{
				$('.extranal').hide();
				$('.template').hide();
				$('.specific_test').show();				
			}
			
			if(test_type == "external_link")
			{
				$('.template').hide();
				$('.specific_test').hide();
				$('.extranal').show();
			}
			if(test_type == "recent_test")
			{
				$('.template').hide();
				$('.specific_test').hide();
				$('.extranal').hide();
			}
			
			
		});
	});
</script>