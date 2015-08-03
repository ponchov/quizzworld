<div id="fb_results">
	<div onClick="streamPublish()" class="qc-fb-share_res"><img src="<?php echo base_url();?>assets/img/fb-logo.png"> <?php echo $this->lang->line('share_on_fb');?></div> 		
	<div class="">
		<img class="fb_bg_image" src="<?php echo $test_bg_image; ?>" />
	</div>
	
	<div class="fb_test_description">
		<?php 
			$friend_name="<strong style='color:#000000;'>$friend_name</strong>";
			$test_result=$tests_info->result_text;
			echo str_replace('<NAME>',$friend_name,$test_result);
		?>	 
	</div>
	
	<div id="games_again"> 
		<div class="btn btn-default" style="display:block;border-color:#888;margin-bottom:3px; font-weight:bold;">
			<span class="glyphicon glyphicon-repeat" aria-hidden="true"></span><?php echo $this->lang->line('try_again');?>
		</div>
	</div>
	<div onClick="streamPublish()" class="qc-fb-share_res"><img src="<?php echo base_url();?>assets/img/fb-logo.png"> <?php echo $this->lang->line('share_on_fb');?></div>
	<h2 class="text-center" style="margin-bottom:10px;"><?php echo $this->lang->line('leave_comment');?></h2>
</div>
<div id="loading" class="hidden invisible">
	<span><?php echo $this->lang->line('calculating');?></span>
	<div>
		<img style=" margin-bottom:90px;" src="<?php echo base_url(); ?>assets/img/ajax-loader2.gif" />
	</div>
</div>

<script language="javascript">
	function streamPublish(){
		 var a = screen.width / 2 - 277.5,
			f = screen.height / 2 - 580;
			//alert(window.location.href); 
			var url="<?php echo site_url();?><?php echo $tests_info->alias;?>.html?fb_r=<?php echo $id;?>";
			//alert(url);
			//return false;
		window.open("https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(url), "", "width=555px, height=550px,left=" + a + ",top=" + f)
	 }
</script>
