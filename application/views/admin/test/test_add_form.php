<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/test_add/<?php echo $lan; ?>" method="post" enctype="multipart/form-data">  



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
					<textarea name="sub_title" class="form-control required" id="sub_title" ></textarea>				
				</span>
			</div>				
		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Categroy Name</label>

			<div class="col-xs-12 col-sm-5">

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

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Description</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<textarea name="description" id="description" class="form-control required"></textarea>					

				</span>

			</div>				

		</div>

		

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Starting Point</label>

			<div class="col-xs-12 col-sm-3 col-md-3">

				<span class="block input-icon input-icon-right">					

					<input type="text" class="form-control required" id="start_point" name="start_point" value="">				

				</span>

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

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Direct Start</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<input type="checkbox" name="direct_start" id="direct_start" value="1" />					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Test Type</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					
					<input type="radio" name="is_real_test" value="0" checked="checked"  /> Normal Test  <br />
					<input type="radio" name="is_real_test" value="1"  /> Real Test <br />
					<input type="radio" name="is_real_test" value="2" /> Twist Test <br />
					<input type="radio" name="is_real_test" value="3" /> Twist Test
									
				</span>

			</div>				

		</div>

		

		

		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Image Upload</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">			
					<input type="file" name="image" id="image" value="" />				
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Thumb Image Upload</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">			
					<input type="file" name="image_thumb" id="image_thumb" value="" />				
				</span>
			</div>				
		</div>





		

          <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="add_test" value="add_test" />

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