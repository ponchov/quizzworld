<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/users/edit/<?php echo $user_info->userid;?>" method="post" enctype="multipart/form-data">  

<?php //print_r($language_list); ?>

<div class="form-group">

				<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right"></label>

				<div class="col-xs-12 col-sm-5">

					<span class="block input-icon input-icon-right" style="color:#FF0000;">

						<?php echo validation_errors(); ?>					

					</span>

				</div>				

			</div>

		  <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">First Name</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="first_name" name="first_name" value="<?php echo $user_info->first_name;?>">					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Last Name</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="last_name" name="last_name" value="<?php echo $user_info->last_name;?>">					

				</span>

			</div>				

		</div>

		

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Telephone</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">	

					<input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo $user_info->telephone;?>">				

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Email</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<input type="text" class="form-control required" id="email" name="email" value="<?php echo $user_info->email;?>">				

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Password</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<input type="password" class="form-control" id="password" name="password" value="">				

				</span>

			</div>				

		</div>


		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Access Language</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<?php 
					
					if($user_info->access_language) $access_language=explode(',',$user_info->access_language);
					else $access_language=array();
					
					if($language_list)
					{
						foreach($language_list as $language)
						{
							?>
								<input  class="required" <?php if(in_array($language->language_code,$access_language)) echo 'checked="checked"';?> type="checkbox" name="access_language[]"  value="<?php echo $language->language_code; ?>" />  <?php echo ucfirst($language->language_name); ?>	
							<?php 
						}
					}
				?>			

				</span>

			</div>				

		</div>
		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">User Type</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<select name="user_type" id="user_type" class="form-control required">

						<option value="" selected="selected">-- Select User Type --</option>

						<option value="1" <?php if($user_info->user_type == 1) echo "selected"; ?>>Admin</option>

						<option value="2" <?php if($user_info->user_type == 2) echo "selected"; ?>>Operator</option>

						<option value="3" <?php if($user_info->user_type == 3) echo "selected"; ?>>Editor</option>

						<option value="3" <?php if($user_info->user_type ==4) echo "selected"; ?>>Graphics Designer</option>

					</select>				

				</span>

			</div>				

		</div>

		

		



		

          <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="edit_user" value="edit_user" />

				<input type="hidden" name="edit_id" value="<?php echo $user_info->userid;?>" />

				<button type="submit" class="btn btn-primary">Save </button> 

				<button class="btn btn-danger" onclick="history.back()" type="button">Cancel</button>  

          </div> 		



</form>  











<script language="javascript">



	



// REGISTRATION FORM VALIDATION (THE SHORTER FORM)



jQuery(document).ready(function () {



	jQuery('#add_form').validate({

			rules: {

				email: {

					required: true,

					email:true

					}

				}

	});



}); // end document.ready











</script>