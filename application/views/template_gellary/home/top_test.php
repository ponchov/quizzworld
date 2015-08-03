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



<div class="row">

	<div id="main_container" class="col-xs-12 col-sm-10 col-md-8 ">

		<?php if($config_info->adsense) { ?> <div class="adsense text-center"><?php echo htmlspecialchars_decode($config_info->adsense);?></div> <?php } ?>

<?php

	if($game_list)

	{

		$i=0;

		foreach($game_list as $game)

		{

			$i++;

			?>

				<?php

					if($i == 4)

					{

						if($config_info->adsense_middle) 

						{ 

						?> 

						<div class="adsense text-center" style="margin-top:15px; margin-bottom:15px;"><?php echo htmlspecialchars_decode($config_info->adsense_middle); ?></div>

						<?php

						}

						 

					}

				?>

				<div class="well">

					<h2 class="tests_title"><a href="<?php echo site_url();?><?php echo $game->alias.".html";?>"><?php echo $game->title;?></a></h2>

					<p class="tests_des"><?php echo $game->description;?></p>					

					<div class="row text-center" style="text-align:center;">

					<a  href="<?php echo site_url();?>start/<?php echo $game->alias.".html";?>">

						<button style="font-size:30px;"  type="button" class="btn btn-lg btn-success col-xs-8 col-md-4 col-sm-4 start_btn">

							<?php echo $this->lang->line('start_btn');?>

						</button>

					</a>

					</div>

					<div class="row  col-xs-12 col-md-5 col-sm-5 fb_like_share">

						<div class="fb-like hidden-xs hidden-sm" data-href="<?php echo site_url();?><?php echo $game->alias.".html";?>" data-width="420" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>

						<div class="fb-like visible-xs visible-sm" data-href="<?php echo site_url();?><?php echo $game->alias.".html";?>" data-width="220" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>

					</div>

				</div>



			<?php

		}

		

		?>

			<?php if($config_info->adsense_bottom) { ?> <div class="adsense text-center" style="margin-top:15px;"><?php echo htmlspecialchars_decode($config_info->adsense_bottom);?></div> <?php } ?>

			<div style="clear:both; height:35px;"></div>

			

			

		<?php 

	}

	

?>

		<div style="clear:both;"></div>

		<div class="fb-like-box visible-lg visible-md"  data-width="750" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>

		<div class="fb-like-box visible-sm"  data-width="420" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>

		<div class="fb-like-box visible-xs"  data-width="270" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>

		

	</div>

</div>

</div>





					

							