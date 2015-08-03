 <link href="<?php echo base_url();?>assets/css//ekko-lightbox.css" rel="stylesheet">
 <script src="<?php echo base_url();?>assets/js/ekko-lightbox.js"></script>
<?php
if($this->session->flashdata('success_message'))
{
?>
	<div class="alert alert-success">  
	  <a class="close" data-dismiss="alert">x</a>  
	  <strong>Success!</strong><?php echo $this->session->flashdata('success_message');?>  
	</div> 
<?php
}

?>
<h1>Templates</h1>
<div class="col-sm-12" id="template_area" style="">
<?php
	if($template_list)
	{
		foreach($template_list as $template)
		{
			$template_caption="template_caption";
			$template_box="template_box";
			if($template->status == 1) 
			{
				$template_caption="template_caption_active";
				$template_box="template_box_active";
			}	
			$template_name=str_replace('_',' ',$template->template_name);	
			$template_name=ucwords($template_name);
		?>
		<div class="col-sm-4">
			<div class="<?php echo $template_box; ?>">
				<a href="<?php echo base_url(); ?>assets/templates/<?php echo $template->template_name; ?>/<?php echo $template->thumbs; ?>" data-toggle="lightbox">
					<img  class="img-responsive" src="<?php echo base_url(); ?>assets/templates/<?php echo $template->template_name; ?>/<?php echo $template->thumbs; ?>" alt="<?php echo $template_name; ?>"  />
				</a>
				<div class="<?php echo $template_caption; ?>">
					<div class="pull-left template_name"><?php  if($template->status == 1) echo "Active:" ?> <?php  echo $template_name; ?></div>
					<div class="pull-right">
						<?php 
						if(!$template->status == 1)
						{
						?>
						<form action="<?php echo site_url(); ?>admin/site_config/template_manager" method="post">
							<input type="hidden" name="template_id" value="<?php echo $template->template_id; ?>"   />
							<input type="hidden" name="set_template" value="set_template" />
							<input class="btn btn-primary" type="submit" value="Active" />							
						</form>
						<?php 
						}
						?>
						
					</div>
				</div>
			</div>
		</div>
		<?php 
		}
	}
?>

</div>


<style type="text/css">
	#template_area
	{
		background:#F8F8F8;
		padding:15px;
	}
	
	.template_box img
	{
		border:2px solid #cccccc;
	}
	
	.template_box_active img
	{
		border:2px solid #008000;
	}
	
	#template_box
	{
		height:340px;
	}
	.template_caption
	{
		position:absolute;
		background:#cccccc;
		bottom:0;
		width:92%;
		padding:5px;
		height:40px;
	}
	
	.template_caption_active
	{
		position:absolute;
		background:#008000;
		bottom:0;
		width:92%;
		padding:5px;
		height:40px;
		color:#FFFFFF;
	}
	.btn
	{
		padding:4px 12px;
	}
	
	.template_name
	{
		padding-top:5px;
	}
</style>


<script type="text/javascript">

	$(document).ready(function ($) {



		// delegate calls to data-toggle="lightbox"

		$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {

			event.preventDefault();

			return $(this).ekkoLightbox({

				onShown: function() {

					if (window.console) {

						return console.log('Checking our the events huh?');

					}

				}

			});

		});





	});

</script>