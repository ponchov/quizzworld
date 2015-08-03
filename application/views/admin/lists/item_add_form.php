<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/<?php echo $this->post_type;?>/add_item/<?php echo $test_id; ?>/<?php echo $lan; ?>" method="post" enctype="multipart/form-data">  
		  <div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Title</label>
			<div class="col-xs-12 col-sm-7">
				<span class="block input-icon input-icon-right">
					<input type="text" class="form-control required" id="item_title" name="item_title" value="">					
				</span>
			</div>				
		</div>
		
		
		 <div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Description</label>
			<div class="col-xs-12 col-sm-9">
				<span class="block input-icon input-icon-right">					
					<textarea name="description" id="description" rows="10" class="form-control required"></textarea>					
				</span>
			</div>				
		</div>
		

		<div class="form-group">			
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Comments</label>
			<div class="col-xs-12 col-sm-7">
				<span class="block input-icon input-icon-right">			
					<textarea name="comments" id="comments" class="form-control"></textarea>					
				</span>
			</div>				
		</div>
		
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Image</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">					
					<input type="file" name="image" id="image" value="" />				
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
							</span>
						</div>				
					</div>
				<?php
			}
		?>
          <div class="col-md-offset-3 col-sm-offset-3">
				<input type="hidden" name="is_slider" id="is_slider" value="<?php if($is_slider == 1) echo $is_slider; else echo 0;?>" />
				<input type="hidden" name="add_item" value="add_item" />

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

