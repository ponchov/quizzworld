<div class="container">

	<div class="row">
		<div id="main_container" class="col-xs-12 col-sm-10 col-md-8 " style="float:none !important;">
			<div class="well" >
			<h1 class="text-center"><?php echo $this->lang->line('not_found');?></h1>
			</div>
			<div class="row text-center" style="text-align:center;">
				<a href="<?php echo site_url();?>">
					<button style="font-size:30px;"  type="button" class="btn btn-lg btn-success start_btn"><?php echo $this->lang->line('home_page');?></button>
				</a>
			</div>

			<br>
			<div class="text-center"><img class="col-xs-12" src="<?php echo base_url();?>assets/img/error.jpg" alt="Error"></div>
		</div>
		
	</div>
</div>


<style type="text/css">
	#main_container {
		margin:auto;
		float:none;
	}
</style>