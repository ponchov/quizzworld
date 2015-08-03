<?php
if($ads_info->test_top_adsense)
{
?>
<div class="add_top">
	<?php echo htmlspecialchars_decode($ads_info->test_top_adsense);?>
</div>
<?php
}
?>

<!--<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);
 
  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };
 
  return t;
}(document, "script", "twitter-wjs"));</script>-->

<div class="" id="result_area">
	<div class="col-xs-12 col-sm-12 col-md-3 hidden-xs hidden-sm">
		<?php
			/*if($ads_info->result_sky_left_adsense)
			{
			?>
			<div class="result_add_left">
				<?php echo htmlspecialchars_decode($config_info->result_sky_left_adsense);?>
			</div>
			<?php
			}*/
		?>
	</div>
	
	
	<div class="col-xs-12 col-sm-12 col-md-6 result_image">
		<div id="results">
			<h5 id="analyzingLabel" class="bodyfont" style="font-size: Medium; text-align: center; visibility: hidden;"></h5>
			<?php
			if($error_message)
			{
				?>
				<p style="color:#FF0000;"><?php echo $error_message;?></p>
				<?php
			}
			?>
			<div id="thumbContainer" class="center-block" style="padding-left: 0px; position: relative;">
				<img id="thumbnail" src="<?php echo base_url(); ?><?php echo $file_name; ?>" class="img-responsive center-block" onerror=" this.onerror = null;this.src = 'Images/placeholder.png'; "/>
				<div id="faces">
					<div></div>
				</div>
			</div>
			
			

			
			 <?php 
			 	 //$twitter_url=site_url().$test_info->alias.".html?r=".$id;
				$twitter_url=site_url().$test_info->alias.".html";
			  ?> 
			<div id="share_buttons">
				
				<div class="fb_share">
					<div class="fb-share-button" data-href="<?php echo site_url();?><?php echo $test_info->alias;?>.html" data-layout="button_count"></div>
					<a class="twitter-share-button"  href="https://twitter.com/intent/tweet?text=#FaceTestRobot analyze your picture and show your results.">
						Tweet
					</a>
					
				</div>
			</div>
			<p id="keep_photo" class="help-block center-block bodyfont" style="padding:0px 10px; font-size:12px; margin-top:5px; ">We are improving and your feedback is valuable! Add comments below and share with your friends.</p>
			<p id="keep_photo" class="help-block center-block bodyfont" style="padding:0px 10px; font-size:12px; margin-top:8px;t">P.S. We don't keep the photo</p>
			
			
			
			

			
			
			<?php
			$middle_ads=0;
			if($ads_info->test_middle_adsense) $middle_ads=$middle_ads+1;
			if($ads_info->test_middle_adsense2) $middle_ads=$middle_ads+1;
			
			if($middle_ads > 0)
			{
			?>
			<div>
				<?php
				if($ads_info->test_middle_adsense)
				{
				?>
				<div class="<?php if($middle_ads == 2) echo 'col-xs-12 col-sm-6 col-md-6';?>"> <?php echo htmlspecialchars_decode($ads_info->test_middle_adsense);?></div>
				<?php
				}
				?>	
				
				<?php
				if($ads_info->test_middle_adsense2)
				{
				?>
				<div class="<?php if($middle_ads == 2) echo 'col-xs-12 col-sm-6 col-md-6';?>"> <?php echo htmlspecialchars_decode($ads_info->test_middle_adsense2);?></div>
				<?php
				}
				?>
			</div>
			<?php
			}
			?>
			<div style="clear:both;"></div>
		
			<a href="<?php echo site_url(); ?><?php echo $test_info->alias; ?>.html">
				<button class="btn btn-default center-block action" style="margin-top: 20px; background-color: rgb(174, 117, 11);border-radius:0">
					<span>
						<img src="<?php echo base_url(); ?>assets/templates/agechecker/images/photo-icon.png" style="width: 25px; height: 25px" />
					</span>
					<?php echo $this->lang->line('try_another_photo');?>
				</button>
			</a>
			
			<div class="" style="padding-top:10px;">	
				<?php 
					if($result_set)
					{
						foreach($result_set as $row)
						{
						?>
							<p>
								<b><?php echo $row->result; ?> :</b> <?php echo $row->result_description; ?> 
							</p>
						<?php 							
						}
					}
				?>
			</div>
			
			<div style="clear:both; height:10px;"></div>
			<div id="fb_comments" >
					
					<div class="fb-comments"  data-width="100%" data-href="<?php echo site_url();?><?php echo $test_info->alias.".html";?>" data-numposts="5" data-colorscheme="light"></div>
	
			</div>
			
			<?php if($banner_list){ ?>
				<div class="" style="padding-top:10px;">
				<div class="col-sm-12 banner_headline"><?php echo $this->lang->line('you_may_like');?></div>
				<?php 
					foreach($banner_list as $row)
					{
						?>
						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="banner_item_box">
								<a target="_blank" href="<?php echo $row->url;?>">						
									<div class="">						
											<img class="img-responsive img-rounded" style="" src="<?php echo base_url(); ?><?php echo $row->image;  ?>" alt="" />
									</div>
									<div class="banner_titles">
										<div class="banner_title">
											<?php echo $row->title;?>
										</div>
										<div class="banner_brand_title">
											<?php echo $row->brand_title;?>
										</div>
									</div>
								</a>
							</div>
						</div>
						<?php 
					}
					
				?>
			</div>
			<?php } ?>
			<div style="clear:both;"></div>
			<div id="jsonEventDiv" style="margin-top: 30px;" hidden>
				<pre id="jsonEvent" style="text-align: left"></pre>
			</div>
		</div>
		<?php /*?><div class="result_fb_share">			
			<div class="fb-like" data-href="<?php echo $config_info->facebook_url;?>" data-width="320" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
		</div><?php */?>
		
		

	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-3  hidden-xs hidden-sm">
		<?php
			/*if($config_info->result_sky_right_adsense)
			{
			?>
			<div class="result_add_right">
				<?php echo htmlspecialchars_decode($config_info->result_sky_right_adsense);?>
			</div>
			<?php
			}*/
		?>
	</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12" id="result_bottom_add">
	<?php
	if($ads_info->test_bottom_adsense)
	{
	?>
	<div class="add_bottom">
		<?php echo htmlspecialchars_decode($ads_info->test_bottom_adsense);?>
	</div>
	<?php
	}
	?>
</div>

<div id="my_Modal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">	
			<div class="modal-header" style="border:none; padding-top:2px">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
			</div>
			<div class="modal-body text-center" style="padding-top:0px;">
					<div class="pop_resultImg"><img class="img-responsive center-block" src="<?php echo base_url(); ?><?php echo $file_name; ?>" alt="Result Image"  /> </div>
					

					
					<div class="col-xs-9 col-sm-6 col-md-6 facebook_share_botton col-sm-offset-2 col-md-offset-2 modal_fb_share">
						<div class="qc-fb-share fb_sharebtn" onClick="streamPublish()">
							<img src="<?php echo base_url();?>assets/img/fb-logo.png">
							<?php echo $this->lang->line('share_on_fb');?>
						</div>
					</div>
					
					<div class="col-xs-3 col-sm-2 col-md-2 twitter_share_botton" style="padding-top:5px;">
						<a onclick="twitterPublish()" style="cursor:pointer;">
							<img class="img-rounded twitter_share_img" src="<?php echo base_url();?>assets/img/twitter_share.png">
						</a>
					</div>
					
					
			
					<div style="clear:both;"></div>

			</div>

		</div><!-- /.modal-content -->

	</div><!-- /.modal-dialog -->

</div> <!-- /my_Modal-->

<div id="my_Modal2" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">	

			<div class="modal-header   text-center" style="border:none; padding-top:10px">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>			</div>
			<div id="myModalLabel " class="modal-title qc-popup-title"><?php echo $this->lang->line('get_new_quiz');?></div>
			<div class="modal-body   text-center">			  
					<div style="width:100px; margin:auto;">
						<div  class="fb-like" data-href="<?php echo $config_info->facebook_url;?>" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div>
					</div>
					<p data-dismiss="modal"  style="text-decoration:underline; cursor:pointer; margin-top:20px; font-weight:bold;"><?php echo $this->lang->line('already_like');?> <?php echo $_SERVER['HTTP_HOST']; ?></p>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!--/my_Modal2-->


<script language="javascript">
	function streamPublish(){
		 var a = screen.width / 2 - 277.5,
			f = screen.height / 2 - 580;
			//alert(window.location.href);
			var url="<?php echo site_url();?><?php echo $test_info->alias.".html";?>?r=<?php echo $id;?>";
			//alert(url);
			//return false;
		window.open("https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(url), "", "width=555px, height=550px,left=" + a + ",top=" + f)
	 }
	 
	 function twitterPublish(){
		 var a = screen.width / 2 - 277.5,
			f = screen.height / 2 - 580;
			var url="url=<?php echo urlencode($twitter_url); ?>&text=FaceTestRobot analyze your picture and show your results. <?php //echo $test_info->title; ?>";
			//alert(url);
			//return false;
		window.open("https://twitter.com/share?" + url, "", "width=555px, height=550px,left=" + a + ",top=" + f)
	 }
	 
</script>


<script language="javascript">
		$(function() {
		 setTimeout(function() {
			  //Show pop-up after 10 seconds
				//--------------- $('#my_Modal').modal('show');
			},0);
		//  var visit_numbers=checkCount();

		$('#my_Modal').on('hide.bs.modal', function (e) {
		  //if(visit_numbers < 4)
			//{
		 	//----------------$('#my_Modal2').modal('show');
		   // }

		})
		});


	$(document).ready(function() {
		twttr.widgets.load();
	});

</script>




