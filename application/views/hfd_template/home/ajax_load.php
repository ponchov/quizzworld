
		<?php
			if($game_list)
			{
				foreach($game_list as $game)
				{
					$caption=$this->lang->line('personality_quizz');
					$url=site_url().$game->alias.".html";
					if($game->post_type == "games")
					{
						$caption=$this->lang->line('personality_quizz');
						$url=site_url().$game->alias.".html";
					}
					if($game->post_type == "articles")
					{
						$caption=$this->lang->line('article');
						$url=site_url()."article/".$game->alias.".html";
					}
					if($game->post_type == "videos")
					{
						$caption=$this->lang->line('video');
						$url=site_url()."videos/".$game->alias.".html";
					}
					if($game->post_type == "lists")
					{
						$caption=$this->lang->line('list');;
						$url=site_url()."list/".$game->alias.".html";
					}
				?>
					<div class="col-xs-6 col-sm-6 col-md-6 latest_item_box">
						<div class="latest_title hidden-xs"><?php echo $caption;?></div>
						<div class="">						
							<a href="<?php echo $url;?>">									
								<img class="img-responsive img-rounded_custom" style="" src="<?php echo base_url(); ?>assets/img/thumbs/<?php echo $game->image_thumb;  ?>" alt="" />
							 </a>
						</div>
						<div class="latest_title_mob visible-xs"><?php echo $caption;?></div>
					    <div class="latest_games_caption">
							<a href="<?php echo $url;?>">
								<?php echo $game->title;?>
							</a>
							<div class="latest_description hidden-xs">
								<?php 
									 $sub_title=get_testMeta($game->tests_id,'sub_title');
								?>
								<a href="<?php echo $url;?>"><?php if(!empty($sub_title)) echo nl2br($sub_title); ?></a>
							</div>
						</div>
						
					</div>
				<?php 
				}
			}
		?>
	