<form action="<?php echo site_url();?>admin/widgets/edit/<?php echo $widget_info->widget_id;?>" method="post" enctype="multipart/form-data">
 <div class="form-group">
	<label for="exampleInputPassword1">Title</label>
	<div class="row">
	<div class="col-sm-6">
	<input type="text" class="form-control " id="title" name="title" value="<?php echo $widget_info->title;?>">
	</div>
	</div>
 </div>
  <div class="form-group">
		<label for="exampleInputEmail1" style="margin-left:40px;"><b>Size of Widget</b></label>
		<div style="clear:both;"></div>
		<div class="col-sm-1"> <label for="exampleInputEmail1">Columns</label></div>
		<div  class="col-sm-2">
			<input type="number" class="form-control" id="columns" name="columns" placeholder="Columns" value="<?php echo $widget_info->columns;?>" >
		</div>
		<div class="col-sm-1"> <label for="exampleInputEmail1">Rows</label></div>
		<div  class="col-sm-2">
			<input type="number" class="form-control" id="rows" name="rows" placeholder="Rows" value="<?php echo $widget_info->rows;?>" >
		</div>
		<div style="clear:both;"></div>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" id="have_external_links" name="have_external_links" value="1" <?php if($widget_info->have_external_links == 1) echo 'checked';?> > <b>External Links</b>
    </label>
  </div>
  <div class="form-group" id="extranals">
  	<div class="expternals">
		<?php
			$external_links=$this->widget_model->get_widget_links($widget_info->widgetid,$widget_info->lang_code,2);
			if($external_links)
			{
				foreach($external_links as $external_link)
				{
				?>
				<div class="row form-group">
					<div class="col-sm-1">&nbsp;</div>
					<div class="col-sm-1 text-right"><label>Link</label></div>
					<div class="col-sm-3"><input type="text" class="form-control"  name="external_link[]" placeholder="Link" value="<?php echo $external_link->url;?>" ></div>
					<div class="col-sm-1 text-right">Title</div>
					<div class="col-sm-3"><input type="text" class="form-control"  name="external_title[]" placeholder="Title" value="<?php echo $external_link->title;?>" ></div>
					<div class="col-sm-1 text-right"><img src="<?php echo base_url();?>assets/img/thumbs/<?php echo $external_link->image;?>" width="50" /></div>
					<div class="col-sm-2"><input type="file" name="external_image[]" /></div>
					<input type="hidden" name="pre_path[]" value="<?php echo $external_link->image;?>" />
				</div>
				<?php
				}
			}
			else
			{
			?>
			<div class="row form-group">
				<div class="col-sm-1">&nbsp;</div>
				<div class="col-sm-1 text-right"><label>Link</label></div>
				<div class="col-sm-3"><input type="text" class="form-control"  name="external_link[]" placeholder="Link" value="" ></div>
				<div class="col-sm-1 text-right">Title</div>
				<div class="col-sm-3"><input type="text" class="form-control"  name="external_title[]" placeholder="Title" value="" ></div>
				<div class="col-sm-1 text-right">Image</div>
				<div class="col-sm-2"><input type="file" name="external_image[]" /></div>
				<input type="hidden" name="pre_path[]" value="" />
			</div>
			<?php
			}
		?>
		
		
	</div>
	<a id="add_ext_line" class="btn btn-primary" href="">+Add line</a>
  </div>
  
  
  
  <div class="checkbox">
    <label>
      <input type="checkbox" id="have_direct_link" name="have_direct_link" value="1" <?php if($widget_info->have_direct_link == 1) echo 'checked';?> > <b>Direct Links</b>
    </label>
  </div>
  <div class="form-group" id="directs">
  	<div class="directs">
		<?php
		$direct_links=$this->widget_model->get_widget_links($widget_info->widgetid,$widget_info->lang_code,1);
		if($direct_links)
		{
		 	foreach($direct_links as $direct_link)
			{
			?>
			<div class="row form-group">
				<div class="col-sm-1">&nbsp;</div>
				<div class="col-sm-1 text-right"><label>Link</label></div>
				<div class="col-sm-3"><input type="text" class="form-control"  name="direct_link[]" placeholder="Link" value="<?php echo $direct_link->url?>" ></div>
				<div class="col-sm-1 text-right">Title</div>
				<div class="col-sm-3"><input type="text" class="form-control"  name="direct_title[]" placeholder="Title" value="<?php echo $direct_link->title?>" ></div>
				<div class="col-sm-1 text-right"><img src="<?php echo base_url();?>assets/img/thumbs/<?php echo $direct_link->image;?>" width="50" /></div>
				<div class="col-sm-2"><input type="file" name="direct_image[]" /></div>
				<input type="hidden" name="pre_path2[]" value="" />
			</div>
			<?php
			}
		}
		else
		{
		?>
		<div class="row form-group">
			<div class="col-sm-1">&nbsp;</div>
			<div class="col-sm-1 text-right"><label>Link</label></div>
			<div class="col-sm-3"><input type="text" class="form-control"  name="direct_link[]" placeholder="Link" value="" ></div>
			<div class="col-sm-1 text-right">Title</div>
			<div class="col-sm-3"><input type="text" class="form-control"  name="direct_title[]" placeholder="Title" value="" ></div>
			<div class="col-sm-1 text-right">Image</div>
			<div class="col-sm-2"><input type="file" name="direct_image[]" /></div>
			<input type="hidden" name="pre_path2[]" value="" />
		</div>
		<?php
		}
		?>
		
	</div>
	<a id="add_direct_line" class="btn btn-primary" href="">+Add line</a>
  </div>
  
  
  <div class="checkbox">
    <label>
      <input type="checkbox" name="is_override" value="1" <?php if($widget_info->is_override == 1) echo 'checked';?> > <b>OVERRIDE MANUAL</b>
    </label>
  </div>
  
   <div class="form-group">
	<label for="exampleInputPassword1">Test Ids</label>
	<div class="row">
		<div class="col-sm-6">
			<input type="text" class="form-control" id="test_ids" name="test_ids" value="<?php echo $widget_info->test_ids;?>">
		</div>
	</div>
 </div>
 <div class="checkbox">
    <label>
      <input type="checkbox" name="include_templates" value="1" <?php if($widget_info->include_templates == 1) echo 'checked';?> > <b>Fill rest of widget with random links.</b>
    </label>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1" style="">Template to be Shown</label>
   	<div>
		<div  class="col-sm-6">
			<?php
				$items=array();
				if($widget_info->items) $items=json_decode($widget_info->items,true);
				//print_r($items);
				//if(array_key_exists("6",$items)) echo 'checked';
			?>
			<div class="col-sm-offset-2 col-sm-12">
				  <div class="checkbox col-sm-6">
					<label>
					  <input name="item[6]" type="checkbox" value="6" <?php if(array_key_exists("6",$items)) echo 'checked';?>> Facebook App 
					</label>
				  </div>
				  <div class="col-sm-6">
				  	<label>Items</label>
					<input type="text" name="items[6]" value="<?php  if(array_key_exists("6",$items)) echo $items[6];?>" />
				  </div>
				  <div style="clear:both;"></div>
				  <div class="checkbox col-sm-6">
					<label>
					  <input name="item[3]" type="checkbox" value="3" <?php if(array_key_exists("3",$items)) echo 'checked';?>> Name Test (3apps)
					</label>
				  </div>
				  <div class="col-sm-6">
				  	<label>Items</label>
					<input type="text" name="items[3]" value="<?php if(array_key_exists("3",$items)) echo $items[3];?>" />
				  </div>
				  <div style="clear:both;"></div>
				  
				  
				  <div class="checkbox col-sm-6">
					<label>
					  <input name="item[0]" type="checkbox" value="0" <?php if(array_key_exists("0",$items)) echo 'checked';?>> Personal Test
					</label>
				  </div>
				   <div class="col-sm-6">
				  	<label>Items</label>
					<input type="text" name="items[0]" value="<?php if(array_key_exists("0",$items)) echo $items[0];?>" />
				  </div>
				  <div style="clear:both;"></div>
				  
				  <div class="checkbox col-sm-6">
					<label>
					  <input name="item[2]" type="checkbox" value="2" <?php if(array_key_exists("2",$items)) echo 'checked';?>> Twist Test
					</label>
				  </div>
				  <div class="col-sm-6">
				  	<label>Items</label>
					<input type="text" name="items[2]" value="<?php if(array_key_exists("2",$items)) echo $items[2];?>" />
				  </div>
				  <div style="clear:both;"></div>
				  
				  <div class="checkbox col-sm-6">
					<label>
					  <input name="item[4]" type="checkbox" value="4" <?php if(array_key_exists("4",$items)) echo 'checked';?>> How old Test
					</label>
				  </div>
				  <div class="col-sm-6">
				  	<label>Items</label>
					<input type="text" name="items[4]" value="<?php  if(array_key_exists("4",$items)) echo $items[4];?>" />
				  </div>
				  <div style="clear:both;"></div>
				  
				  <div class="checkbox col-sm-6">
					<label>
					  <input name="item[1]" type="checkbox" value="1" <?php if(array_key_exists("1",$items)) echo 'checked';?>> Real Knowladge
					</label>
				  </div>
				  <div class="col-sm-6">
				  	<label>Items</label>
					<input type="text" name="items[1]" value="<?php if(array_key_exists("1",$items)) echo $items[1];?>" />
				  </div>
				  <div style="clear:both;"></div>
				  
				  <div class="checkbox col-sm-6">
					<label>
					  <input name="item[5]" type="checkbox" value="5" <?php if(array_key_exists("5",$items)) echo 'checked';?>> Face Test
					</label>
				  </div>
				  <div class="col-sm-6">
				  	<label>Items</label>
					<input type="text" name="items[5]" value="<?php  if(array_key_exists("5",$items)) echo $items[5];?>" />
				  </div>
				  <div style="clear:both;"></div>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
  </div>
  <div class="form-group">
	<label for="exampleInputPassword1">Status</label>
	<div class="row">
	<div class="col-sm-6">
	<select name="status" id="status"  class="form-control ">
		<option value="1" <?php if($widget_info->status == 1) echo 'selected';?> >Active</option>
		<option value="0"  <?php if($widget_info->status == 0) echo 'selected';?>>Inactive</option>
	</select>
	
	</div>
	</div>
 </div>
  
  <input type="hidden" name="save_widget" value="save_widget" />
  <input type="hidden" name="widgetid" value="<?php echo $widget_info->widgetid;?>" />
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<br /> <br /> <br />



			
			
			
			
<script language="javascript">
	$(document).ready(function() {
		if($('#have_external_links').prop('checked')==true)
		{
			$('#extranals').show();
		}
		else
		{
			$('#extranals').hide();
		}
		$('#have_external_links').on('click',function(e){
			if($(this).prop('checked')==true)
			{
				$('#extranals').show();
			}
			else
			{
				$('#extranals').hide();
			}
		});
		
		
		$(document).on('click','#add_ext_line',function(e){
			e.preventDefault();
			var new_line='<div class="row form-group"><div class="col-sm-1 text-center btn btn-danger remove_extranal">X</div><div class="col-sm-1 text-right"><label>Link</label></div><div class="col-sm-3"><input type="text" class="form-control"  name="external_link[]" placeholder="Link" value="" ></div>';
			new_line+='<div class="col-sm-1 text-right">Title</div><div class="col-sm-3"><input type="text" class="form-control"  name="external_title[]" placeholder="Title" value="" ></div>';
			new_line+='<div class="col-sm-1 text-right">Image</div><div class="col-sm-2"><input type="file" name="external_image[]" /></div></div><input type="hidden" name="pre_path[]" value="" />';
			$('.expternals').append(new_line);
		});
		
		
		$(document).on('click','.remove_extranal',function(e){
			e.preventDefault();
			$(this).parent('.row').remove();
		});
		
		
		//------- manage direct links
		if($('#have_direct_link').prop('checked')==true)
		{
			$('#directs').show();
		}
		else
		{
			$('#directs').hide();
		}
		$('#have_direct_link').on('click',function(e){
			if($(this).prop('checked')==true)
			{
				$('#directs').show();
			}
			else
			{
				$('#directs').hide();
			}
		});
		
		
		$(document).on('click','#add_direct_line',function(e){
			e.preventDefault();
			var new_line='<div class="row form-group"><div class="col-sm-1 text-center btn btn-danger remove_direct">X</div><div class="col-sm-1 text-right"><label>Link</label></div><div class="col-sm-3"><input type="text" class="form-control"  name="direct_link[]" placeholder="Link" value="" ></div>';
			new_line+='<div class="col-sm-1 text-right">Title</div><div class="col-sm-3"><input type="text" class="form-control"  name="direct_title[]" placeholder="Title" value="" ></div>';
			new_line+='<div class="col-sm-1 text-right">Image</div><div class="col-sm-2"><input type="file" name="direct_image[]" /></div></div><input type="hidden" name="pre_path2[]" value="" />';
			$('.directs').append(new_line);
		});
		
		
		$(document).on('click','.remove_direct',function(e){
			e.preventDefault();
			$(this).parent('.row').remove();
		});
	});
</script>