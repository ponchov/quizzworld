<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/categories/category_add" method="post" >  



           

		  <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Category Name</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="category_name" name="category_name" value="">					

				</span>

			</div>				

		</div>

		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Description</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="description" name="description" value=""> 					

				</span>

			</div>				

		</div>
		
		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Section </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">
					<select name="post_type" id="post_type" class="form-control">
						<option value="games">Personality Quiz</option>
						<option value="articles">Articles</option>
						<option value="lists">Lists</option>
						<option value="videos">videos</option>	
					</select>			

				</span>

			</div>				

		</div>





		

          <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="add_category" value="add_category" />

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