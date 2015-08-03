<h3 class="text-center col-sm-10" style="color:#0000FF; font-size:28px; margin-bottom:25px;">Create New Test</h3>

<div style="clear:both;"></div>
<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/twist_test_add_wizard" method="post" enctype="multipart/form-data">  
		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Title</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="title" name="title" value="">					

				</span>

			</div>				

		</div>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Description </label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea name="description" id="description" class="form-control"></textarea>						

				</span>

			</div>

			<div class="col-sm-4">

				<small>Please add 2 funny, engaging sentences which we'll show on facebook promoting this test. i.e.<span style="color:#FF0000;">'Do you know what kind of partner you are? :) Take the test to find out.'</span></small>

			</div>				

		</div>

		<?php if($this->session->userdata('user_type') != 2) { ?>

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Page Title</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="page_title" name="page_title" value="">					

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

		

		

		<?php 

		}

		?>


          <div class="col-md-offset-4 col-sm-offset-4">

				<input type="hidden" name="add_twist_test" value="add_twist_test" />

				<button type="submit" class="btn btn-success col-sm-3 btn-lg">Next </button> 

          </div>  


</form>  

<script language="javascript">
// REGISTRATION FORM VALIDATION (THE SHORTER FORM)
jQuery(document).ready(function () {
	jQuery('#add_form').validate({});

}); // end document.ready

</script>