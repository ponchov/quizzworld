<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/categories/category_content/<?php echo $categoryid; ?>/<?php echo $lang_code; ?>" method="post" >  

		    <?php 			
			/*echo "<pre>";
			print_r($en_category_info); */
			?>

		  <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Category Name</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">
					<?php if(!($lang_code == "en")) echo $en_category_info->category_name; ?>
					<input type="text" class="form-control required" id="category_name" name="category_name" value="<?php if($category_info) echo $category_info->category_name;?>">  					

				</span>

			</div>				

		</div>

		

		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Description</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">
					<?php if(!($lang_code == "en")) echo $en_category_info->description; ?>

					<input type="text" class="form-control required" id="description" name="description" value="<?php if($category_info) echo $category_info->description;?>"> 					

				</span>

			</div>				

		</div>

		<?php if($category_info) { ?>

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

		<?php } ?>



		  <div class="col-md-offset-3 col-sm-offset-3">
				<input type="hidden" name="post_type" value="<?php echo $en_category_info->post_type;?>" />
				<input type="hidden" name="edit_category_content" value="edit_category_content" />

				<input type="hidden" name="cat_info" value="<?php if($category_info) echo "1"; else echo "0"; ?>"  />

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