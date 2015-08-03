<div id="fb-root"></div>

<script>(function(d, s, id) {

  var js, fjs = d.getElementsByTagName(s)[0];

  if (d.getElementById(id)) return;

  js = d.createElement(s); js.id = id;

  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo trim($config_info->facebook_appid);?>";

  fjs.parentNode.insertBefore(js, fjs);

}(document, 'script', 'facebook-jssdk'));





</script>


<div class="col-sm-12 col-md-12 col-xs-12" id="featured_post">
	<div class="autoplay">
		  <?php
				if($featured_posts)
				{
					foreach($featured_posts as $featured_post)
					{
						?>
						<div class="col-xs-12 col-sm-3 col-md-3" >
							<a href="">
							<img class="img-resposive" style="width:100%;" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $featured_post->image_thumb;  ?>" alt="" />
							</a>
							<div class="featured_caption"><a href=""><?php echo strtoupper($featured_post->title); ?> </a></div>
						</div>
						<?php 
					}
				}
			?>
		</div>
		<div class="col-sm-12"><hr></div>
	
</div>

<?php /*?><div class="col-sm-12 col-md-12 col-xs-12" id="featured_post">
	<?php
		if($featured_posts)
		{
			foreach($featured_posts as $featured_post)
			{
				?>
				<div class="col-xs-12 col-sm-3 col-md-3" >
					<div class="featured_title">
					<?php 
						if($featured_post->post_type == "games")
						{						
							echo "PERSONALITY QUIZZ"; 
						}
						else if($featured_post->post_type == "articles")
						{	
							echo "ARTICLE";
						}
						else if($featured_post->post_type == "videos")
						{	
							echo "VIDEO";
						}
						else if($featured_post->post_type == "lists")
						{	
							echo "LIST";
						}
					?>
					</div>
					<a href="">
					<img class="img-resposive" style="width:100%;" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $featured_post->image_thumb;  ?>" alt="" />
					</a>
					<div class="featured_caption"><a href=""><?php echo strtoupper($featured_post->title); ?> </a></div>
				</div>
				<?php 
			}
		}
	?>
	<div class="col-sm-12"><hr></div>
</div><?php */?>  <!--featured_post-->

<div class="col-xs-12 col-sm-12 col-md-12 " style="padding:5px 0;">
	<div class="col-xs-12 col-sm-9 col-md-9"  style="padding:0;">
		<div class="col-sm-12" style="width:100%; padding-bottom:8px;"><span id="latest_headline">LATEST</span></div>
		<?php
			if($game_list)
			{
				foreach($game_list as $game)
				{
					$caption="PERSONALITY QUIZZ";
					$url=site_url().$game->alias.".html";
					if($game->post_type == "games")
					{
						$caption="PERSONALITY QUIZZ";
						$url=site_url().$game->alias.".html";
					}
					if($game->post_type == "articles")
					{
						$caption="ARTICLE";
						$url=site_url()."articles/".$game->alias.".html";
					}
					if($game->post_type == "videos")
					{
						$caption="VIDEO";
						$url=site_url()."videos/".$game->alias.".html";
					}
					if($game->post_type == "lists")
					{
						$caption="LIST";
						$url=site_url()."lists/".$game->alias.".html";
					}
				?>
					<div class="col-xs-6 col-sm-4 col-md-4">
						<div class="latest_title hidden-xs"><?php echo $caption;?></div>						
							<a href="<?php echo $url;?>">									
								<img class="img-resposive" style="width:100%;" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $game->image_thumb;  ?>" alt="" />
							 </a>
						<div class="latest_title_mob visible-xs"><?php echo $caption;?></div>
					    <div class="latest_games_caption">
							<a href="<?php echo $url;?>">
								<?php echo $game->title;?>
							</a>
						</div>
						
					</div>
				<?php 
				}
			}
		?>
	</div>
	<div class="col-xs-12 col-sm-3 col-md-3" style="padding:0;">
		<div class="col-sm-12 top_headline" style="width:100%; padding-bottom:6px; padding-top:21px;"><span id="top_headline">TOP 4</span></div>
		<div class="col-sm-12" id="right_panel">
			<?php
				if($top_games)
				{
					$i=0;
					foreach($top_games as $top_game)
					{
						$i++;
						$caption="PERSONALITY QUIZZ";
						$url=site_url().$top_game->alias.".html";
						if($top_game->post_type == "games")
						{
							$caption="PERSONALITY QUIZZ";
							$url=site_url().$top_game->alias.".html";
						}
						if($top_game->post_type == "articles")
						{
							$caption="ARTICLE";
							$url=site_url()."articles/".$top_game->alias.".html";
						}
						if($top_game->post_type == "videos")
						{
							$caption="VIDEO";
							$url=site_url()."videos/".$top_game->alias.".html";
						}
						if($top_game->post_type == "lists")
						{
							$caption="LIST";
							$url=site_url()."lists/".$top_game->alias.".html";
						}
					?>
					<div class="col-xs-6 col-sm-10 col-md-10 col-sm-offset-2 col-md-offset-2">
						<a href="">
							<img class="img-resposive" style="width:100%;" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $top_game->image_thumb;  ?>" alt="" />
						</a>
						<div class="top_num hidden-xs"><?php echo $i; ?></div>
						<div class="top_title visible-xs"><?php echo $caption; ?></div>
						 <div class="top_games_caption"><a href=""><?php echo strtoupper($top_game->title); ?></a>  </div>
					</div>
					<?php 
					}
				}
			?>
			
			<div class="col-sm-12 text-center">
				<div class="fb-like-box"  data-width="270" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
			</div>
		</div> <!--right_panel-->
	</div>
</div>








							