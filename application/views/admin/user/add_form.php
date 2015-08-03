<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/users/add" method="post" enctype="multipart/form-data">  

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

					<input type="text" class="form-control required" id="first_name" name="first_name" value="<?php echo set_value('first_name'); ?>">					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Last Name</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="last_name" name="last_name" value="<?php echo set_value('last_name'); ?>">					

				</span>

			</div>				

		</div>

		

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Telephone</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">	

					<input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo set_value('telephone'); ?>">				

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Email</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<input type="text" class="form-control required" id="email" name="email" value="<?php echo set_value('email'); ?>">				

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Username</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<input type="text" class="form-control required" id="username" name="username" value="<?php echo set_value('username'); ?>">				

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Password</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<input type="password" class="form-control required" id="password" name="password" value="">				

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Confirm Password</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<input type="password" class="form-control required" id="confirm_password" name="confirm_password" value="">				

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Access Language</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

					<?php 
				if($language_list)
				{
					foreach($language_list as $language)
					{
						?>
							<input class="required" type="checkbox" name="access_language[]"  value="<?php echo $language->language_code; ?>" />  <?php echo ucfirst($language->language_name); ?>	
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

						<option value="1">Admin</option>

						<option value="2">Operator</option>

						<option value="3">Editor</option>

						<option value="4">Graphics Designer</option>

					</select>				

				</span>

			</div>				

		</div>

		

		



		

          <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="add_user" value="add_user" />

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

				},

			rules: {

				password: "",

				confirm_password: {

				  equalTo: "#password"

				}

			  }

				

	});



}); // end document.ready











</script>