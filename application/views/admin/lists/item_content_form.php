<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/<?php echo $this->post_type;?>/item_content/<?php echo $test_id; ?>/<?php echo $list_itemid; ?>/<?php echo $lang_code; ?>" method="post" enctype="multipart/form-data" >  

		<?php //print_r($question_info); ?>

		 <div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Title</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">					
					<?php if(!($lang_code == "en")) echo $eng_item_info->item_title; ?>
					<input type="text" class="form-control required" id="item_title" name="item_title" value="<?php if($item_info) echo $item_info->item_title; ?>">						
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Description</label>
			<div class="col-xs-12 col-sm-9">
				<span class="block input-icon input-icon-right">	
				<?php if(!($lang_code == "en")) echo $eng_item_info->description; ?>				
					<textarea name="description" id="description" rows="10" class="form-control required"><?php if($item_info) echo $item_info->description; ?></textarea>					
				</span>
			</div>				
		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Image Upload</label>

			<div class="col-xs-12 col-sm-5">

				<span style="color:#FF0000;">(Image should be 660x230) </span>

				<span class="block input-icon input-icon-right">					

					<input type="file" name="image" id="image" value="" />	

					<?php if($item_info) { ?>	
						<?php if($item_info->image) { ?>
						<img src="<?php echo base_url(); ?>assets/img/image/thumb_<?php echo $item_info->image; ?>" style="height:150px; width:200px;" />	
						<input type="hidden" name="pre_img_path" value="<?php echo $item_info->image; ?>" />
						<input type="hidden" name="pre_imgpath" value="assets/img/image/<?php echo $item_info->image; ?>" />
						<input type="hidden" name="pre_imgpath2" value="assets/img/image/thumb_<?php echo $item_info->image; ?>" />
						<?php } ?>

					<?php } else { ?>	
						<?php if($eng_item_image) { ?>
						<img src="<?php echo base_url(); ?>assets/img/image/<?php echo $eng_item_image; ?>" style="height:150px; width:200px;" />	
						<?php } ?>

					<?php } ?>	

					<input type="hidden" name="eng_question_image" value="<?php echo $eng_item_image; ?>" />		

				</span>

			</div>				

		</div>

		

	          <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="add_item_content" value="add_item_content" />

				<input type="hidden" name="has_item" value="<?php if($item_info) echo "1"; else echo "0"; ?>" />

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

