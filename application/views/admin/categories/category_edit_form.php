<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/categories/category_edit/<?php echo $category_info->category_id;?>" method="post" >  



		    

		  <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Category Name</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="category_name" name="category_name" value="<?php echo $category_info->category_name;?>">  					

				</span>

			</div>				

		</div>

		

		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Description</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="description" name="description" value="<?php echo $category_info->description;?>"> 					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Section </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">
					<select name="post_type" id="post_type" class="form-control">
						<option value="games" <?php if($category_info->post_type == 'games') echo 'selected';?>>Personality Quiz</option>
						<option value="articles" <?php if($category_info->post_type == 'articles') echo 'selected';?>>Articles</option>
						<option value="lists" <?php if($category_info->post_type == 'lists') echo 'selected';?>>Lists</option>
						<option value="videos" <?php if($category_info->post_type == 'videos') echo 'selected';?>>videos</option>	
					</select>			

				</span>

			</div>				

		</div>

		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Status</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<select name="status" id="status" class="form-control">

					<option value="1" <?php if($category_info->status == 1) echo "selected";?>>Active</option>

					<option value="0"  <?php if($category_info->status == 0) echo "selected";?>>Inactive</option>

				  </select>					

				</span>

			</div>				

		</div>



		  <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="edit_category" value="edit_category" />

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