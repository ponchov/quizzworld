<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=211665475703856";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<h1 class="text-center">Funny Game</h1>

<hr />

<?php
	if($game_list)
	{
		foreach($game_list as $game)
		{
			?>
				<div class="row well  col-sm-8 col-md-8 col-sm-offset-2  col-md-offset-2 tests_list">
					<h2 class="tests_title"><?php echo $game->title;?></h2>
					<p class="tests_des"><?php echo $game->description;?></p>					
					<div class="row text-center col-sm-12" style="text-align:center;"><a  href="<?php echo site_url();?><?php echo $game->alias.".html";?>"><button  type="button" class="btn btn-lg btn-success col-sm-2 col-sm-offset-5">Start</button></a></div>
					<div class="fb-like row col-xs-12 col-sm-12 col-md-12" data-href="<?php echo site_url();?><?php echo $game->alias.".html";?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
				</div>
				<div class="row" style="height:25px; clear:both;"></div>
			<?php
		}
	}
	
?>

<?php /*?><div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
<?php */?>

<style type="text/css">
	.tests_des {
		font-size:20px;
	}
	.tests_title {
		font-size:30px;
		color:#438EB9;
		text-align:center;
	}
	.fb-like{
		text-align:center;
	}

	
</style>
								
							