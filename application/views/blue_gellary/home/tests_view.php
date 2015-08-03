<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo trim($config_info->facebook_appid);?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> 



<div class="col-xs-12 col-sm-12 col-md-12" style="padding:0;">
	<div class="col-xs-12 col-sm-8 col-md-8" id="list_left_panel">
		<div class="list_title"><?php echo $tests_info->title; ?></div>	
		<div class="">
			<?php
				$lists=$this->home_model->get_lists($tests_info->testid);
				/*echo "<pre>";
				print_r($lists);*/
				
				foreach($lists as $list)
				{
					
				}
			?>
		
		</div>	
	</div>
	<div class="col-xs-12 col-sm-3 col-md-3 pull-right" id="list_right_panel">
		<h1> Right panel</h1>
	</div>
</div>



