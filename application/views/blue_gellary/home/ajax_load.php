
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
	