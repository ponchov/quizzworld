<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/<?php echo $this->post_type;?>/item_edit/<?php echo $item_info->list_itemid;?>/<?php echo $test_id; ?>/<?php echo $lang_code;?>/<?php echo $referance;?> " method="post" enctype="multipart/form-data">  
		  <div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Title</label>
			<div class="col-xs-12 col-sm-7">
				<span class="block input-icon input-icon-right">
					<input type="text" class="form-control required" id="item_title" name="item_title" value="<?php echo $item_info->item_title;?>">					
				</span>
			</div>				
		</div>
		
		
		 <div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Description</label>
			<div class="col-xs-12 col-sm-9">
				<span class="block input-icon input-icon-right">					
					<textarea name="description" id="description" rows="10" class="form-control required"><?php echo $item_info->description;?></textarea>					
				</span>
			</div>				
		</div>
		
		<div class="form-group">			
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Comments</label>
			<div class="col-xs-12 col-sm-7">
				<span class="block input-icon input-icon-right">			
					<textarea name="comments" id="comments" class="form-control"><?php echo $item_info->comments;?></textarea>					
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Status</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<select name="status" id="status" class="form-control">

					<option value="1" <?php if($item_info->status == 1) echo "selected";?>>Active</option>

					<option value="2"  <?php if($item_info->status == 0) echo "selected";?>>Inactive</option>

				  </select>					

				</span>

			</div>				

		</div>
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Image</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">					
					<input type="file" name="image" id="image" value="" />
					<?php
						if($item_info->image)
						{
						?>
						<img src="<?php echo base_url(); ?>assets/img/image/<?php echo $item_info->image; ?>" height="150"  />	
						<?php
						}
					?>				
				</span>
			</div>				
		</div>
		<?php
		$is_slider=get_testMeta($test_id,'is_slider');
		if($is_slider == 1)
		{
		?>
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Without Eyebrows Image</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">					
					<input type="file" name="image2" id="image2" value="" />
					<?php
						if($item_info->image)
						{
						?>
						<img src="<?php echo base_url(); ?>assets/img/image/<?php echo $item_info->image2; ?>" height="150"  />	
						<?php
						}
					?>				
				</span>
			</div>				
		</div>
		<?php
		}
		?>
          <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="edit_item" value="edit_item" />
				<input type="hidden" name="referance" value="<?php echo $referance;?>" />
				<input type="hidden" name="list_item_id" value="<?php echo $item_info->list_item_id; ?>" />

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
<script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
<script language="javascript">
	// Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	var config = {
			height: 400,
			codeSnippet_theme: 'Monokai',
			filebrowserBrowseUrl: '<?php echo base_url();?>assets/filemanager/index.html',
			
			toolbarGroups: [
				
				
				{ name: 'insert' },
				{ name: 'colors' },
				{ name: 'links' },
				{ name: 'mode' },
				//'/',
				{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
				{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
				{ name: 'styles' },
				
			]
			
			

			// Remove the redundant buttons from toolbar groups defined above.
			
		};
	CKEDITOR.replace( 'description',config );
	
</script>

