<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js">

<div id="fb-root"></div>

<script>(function(d, s, id) {

  var js, fjs = d.getElementsByTagName(s)[0];

  if (d.getElementById(id)) return;

  js = d.createElement(s); js.id = id;

  js.src = "//connect.facebook.net/<?php echo $this->fb_localize;?>/all.js#xfbml=1&appId=<?php echo trim($config_info->facebook_appid);?>";

  fjs.parentNode.insertBefore(js, fjs);

}(document, 'script', 'facebook-jssdk'));</script>



</div>





	<div class="container">
		<div style="margin-top:20px;"></div>
		<div class="col-xs-12 col-md-12 col-sm-12">
			<div class="well">

					<?php

					if($this->session->flashdata('success_message'))

					{

					?>

						<div class="alert alert-success">  

						  <a class="close" data-dismiss="alert">x</a>  

						  <strong><?php echo $this->lang->line('success');?></strong><?php echo $this->session->flashdata('success_message');?>  

						</div> 

					<?php

					}

					

					?>

				<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>contact-us.html" method="post" >  

					 <div class="form-group">

						<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right"><?php echo $this->lang->line('name');?></label>

						<div class="col-xs-12 col-sm-5">

							<span class="block input-icon input-icon-right">					

								<input type="text" class="form-control required" id="name" name="name" value="">				

							</span>

						</div>				

					</div>

					

					<div class="form-group">

						<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right"><?php echo $this->lang->line('email');?></label>

						<div class="col-xs-12 col-sm-5">

							<span class="block input-icon input-icon-right">

								<input type="text" class="form-control required" id="email" name="email" value="">					

							</span>

						</div>				

					</div>



					

					<div class="form-group">

						<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right"><?php echo $this->lang->line('comments');?></label>

						<div class="col-xs-12 col-sm-5">

							<span class="block input-icon input-icon-right">

								<textarea name="comments" id="comments" class="form-control required"></textarea>					

							</span>

						</div>				

					</div>

					

					

					   <div class="col-md-offset-3 col-sm-offset-3">

							<input type="hidden" name="add_contact" value="add_contact" />

							<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('send');?> </button> 

							<button class="btn btn-danger" onclick="history.back()" type="button"><?php echo $this->lang->line('cancel');?></button>  

					  </div>  

			

			</form>

			</div>
		</div>
	</div>





<script language="javascript">

	jQuery(document).ready(function () {

		jQuery('#add_form').validate({

			rules: {

					email: {

						required: true,

						email:true

						}

					}

		});

	}); 

</script>



<style type="text/css">

.error{

	color:#FF0000;

}

</style>

