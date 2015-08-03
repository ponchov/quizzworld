<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/<?php echo $this->post_type;?>/add/<?php echo $lan; ?>" method="post" enctype="multipart/form-data">  
		  <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">List Title</label>

			<div class="col-xs-12 col-sm-7">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="title" name="title" value="">					

				</span>

			</div>				

		</div>

		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">List Subtitle</label>
			<div class="col-xs-12 col-sm-7">
				<span class="block input-icon input-icon-right">
					<textarea name="sub_title" id="sub_title" class="form-control"></textarea>					
				</span>
			</div>				
		</div>
		
		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">List Snippet</label>

			<div class="col-xs-12 col-sm-7">

				<span class="block input-icon input-icon-right">					

					<textarea name="list_snippet" id="list_snippet" class="form-control"></textarea>					

				</span>

			</div>				

		</div>
		
		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Fb Share Description</label>

			<div class="col-xs-12 col-sm-7">

				<span class="block input-icon input-icon-right">					

					<textarea name="fbshare_des" id="fbshare_des" rows="8" class="form-control"></textarea>					

				</span>

			</div>				

		</div>
		
		<!--<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Page Title</label>

			<div class="col-xs-12 col-sm-7">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="page_title" name="page_title" value="">					

				</span>

			</div>				

		</div>-->

		

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">List Category</label>

			<div class="col-xs-12 col-sm-7">

				<select name="category_id" id="category_id" class="form-control">

					<?php 

					

						if($category_list)

						{

							foreach($category_list as $row)

							{

							?>

							<option value="<?php echo $row->category_id; ?>" ><?php echo $row->category_name; ?></option>

							<?php

							

							}

						}

					?>

					

				</select>

			</div>				

		</div>

		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">List Content</label>

			<div class="col-xs-12 col-sm-9">

				<span class="block input-icon input-icon-right">					

					<textarea name="description" id="description" rows="10" class="form-control required"></textarea>					

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
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Thumb Image</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">		
					<input type="file" name="image_thumb" id="" value="" />			
				</span>
			</div>				
		</div>
		
		
          <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="add_list" value="add_list" />

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


