<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/<?php echo $this->post_type;?>/add/<?php echo $lan; ?>" method="post" enctype="multipart/form-data">  
		  <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Video Article Title</label>

			<div class="col-xs-12 col-sm-7">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="title" name="title" value="">					

				</span>

			</div>				

		</div>

		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Subtitle</label>
			<div class="col-xs-12 col-sm-7">
				<span class="block input-icon input-icon-right">
					<textarea name="sub_title" id="sub_title" class="form-control"></textarea>					
				</span>
			</div>				
		</div>
		
		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Video Snippet</label>

			<div class="col-xs-12 col-sm-7">

				<span class="block input-icon input-icon-right">					

					<textarea name="video_snippet" id="video_snippet" class="form-control"></textarea>					

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
		<?php /*?><div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Page Title</label>

			<div class="col-xs-12 col-sm-7">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="page_title" name="page_title" value="">					

				</span>

			</div>				

		</div><?php */?>

		

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Video Categroy</label>

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

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Video Article  Content</label>

			<div class="col-xs-12 col-sm-9">

				<span class="block input-icon input-icon-right">					

					<textarea name="description" id="description" rows="10" class="form-control required"></textarea>					

				</span>

			</div>				

		</div>


		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Is Extranal Video</label>
			<div class="col-xs-12 col-sm-5">
				<input type="checkbox" name="extranal_video" id="extranal_video" value="1" />
			</div>				
		</div>
		<div id="extranal_video_area" style="display:none;">
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Video Type</label>
				<div class="col-xs-12 col-sm-7">
					<select name="video_type" id="video_type" class="form-control required">
						<option value="" selected="selected">Select Type</option>
						<option value="youtube">YouTube</option>
						<option value="vimo">Vimeo</option>
					</select>
				</div>				
			</div>
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right"> Video Url</label>
				<div class="col-xs-12 col-sm-7">
					<input type="text" name="video_url" id="video_url" class="form-control required" value=""  />
				</div>				
			</div>
		</div>
		
		
		
		<div class="form-group" id="video">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Video</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<input type="file" name="video" id="video" value="" />				

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
					<input type="file" name="image_thumb"  value="" />				
				</span>
			</div>				
		</div>





		

          <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="add_video" value="add_video" />

				<button type="submit" class="btn btn-primary">Save </button> 

				<button class="btn btn-danger" onclick="history.back()" type="button">Cancel</button>  

          </div>  

		  

		  

		  

    



</form>  










<script language="javascript">

	jQuery(document).ready(function () {
		jQuery('#add_form').validate({});
	}); // end document.ready
	
	$(document).on('click','#extranal_video',function() {
		if(this.checked)
		{
			$('#video').hide();
			$('#extranal_video_area').show();
		}
		else
		{
			$('#extranal_video_area').hide();
			$('#video').show();
		}
	
	});

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

