<link href="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/css/agechecker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/css/how_old.css" rel="stylesheet">
<div id="fb-root"></div>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo $this->fb_localize;?>/all.js#xfbml=1&appId=<?php echo trim($config_info->facebook_appid);?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>

<script>
window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return t;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
</script>

<script src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/js/modernizr.js"></script>


<h1 class="how_old_title"><?php echo $tests_info->title; ?></h1>
<div class="home_container" style="text-align: center ">
	<?php if($ads_info->test_top_adsense) 
	{ 
	?> 
	<div class="add_top">
		<?php   echo htmlspecialchars_decode($ads_info->test_top_adsense);?>
	</div>
	<?php
	 } 
	?>
	<?php
		/*echo "<pre>";
		print_r($tests_info);*/
	?>

	
	
	<div id="selectImage">   
		<form action=""  id="searchform" method="post">
			<div class="input-group" style="background-color: white" id="searchbox">
				<span class="input-group-addon" style="padding: 0px 0px 0px 0px; border: none"><img id="bLogo" class="" src="<?php echo base_url(); ?>assets/templates/agechecker/images/bing2.png" data-bm="3"></span>
				<input type="search" name="query" style="border-style: none;" class="form-control"  placeholder="<?php echo $this->lang->line('search_face');?>" id="query">
				<div class="input-group-btn">b_searchboxSubmit
					<input name="go" tabindex="0" title="Search" class="b_searchboxSubmit" id="searchsubmit" type="submit" value="Submit Query">
				</div>
			</div>
			
			
		</form>
		
				
		<div id="bing_loader_area">
			<div id="bing_loader" style="display:none;"><img src="<?php echo base_url();?>assets/img/bing_image_loader.gif" /></div>
		</div>
		
		<div id="imageDiv" class="ImageSelector" style="visibility: hidden;">
			<div id="imageList" class="ScrollArea notSelectedImage">
					
					<img src="<?php echo base_url(); ?>assets/templates/template_gellary/faces/thumnails/2.jpg" data-url="assets/templates/template_gellary/faces/2.jpg"  data-source="static" data-image-name="faces/2.jpg"  />
					<img src="<?php echo base_url(); ?>assets/templates/template_gellary/faces/thumnails/4.jpg" data-url="assets/templates/template_gellary/faces/4.jpg"  data-source="static" data-image-name="faces/4.jpg"  />
					<img src="<?php echo base_url(); ?>assets/templates/template_gellary/faces/thumnails/5.jpg" data-url="assets/templates/template_gellary/faces/5.jpg"  data-source="static" data-image-name="faces/5.jpg"  />
					<img src="<?php echo base_url(); ?>assets/templates/template_gellary/faces/thumnails/6.jpg" data-url="assets/templates/template_gellary/faces/6.jpg"  data-source="static" data-image-name="faces/6.jpg"  />
					<img src="<?php echo base_url(); ?>assets/templates/template_gellary/faces/thumnails/7.jpg" data-url="assets/templates/template_gellary/faces/7.jpg"  data-source="static" data-image-name="faces/7.jpg"  />
					<img src="<?php echo base_url(); ?>assets/templates/template_gellary/faces/thumnails/8.jpg" data-url="assets/templates/template_gellary/faces/8.jpg"  data-source="static" data-image-name="faces/8.jpg"  />
					
					
					<img src="<?php echo base_url(); ?>assets/templates/template_gellary/faces/thumnails/18.jpg" data-url="assets/templates/template_gellary/faces/18.jpg"  data-source="static" data-image-name="faces/17.jpg" />
					<img src="<?php echo base_url(); ?>assets/templates/template_gellary/faces/thumnails/19.jpg" data-url="assets/templates/template_gellary/faces/19.jpg"  data-source="static" data-image-name="faces/18.jpg" />
					
					<img src="<?php echo base_url(); ?>assets/templates/template_gellary/faces/thumnails/21.jpg" data-url="assets/templates/template_gellary/faces/21.jpg"  data-source="static" data-image-name="faces/21.jpg" />
					<img src="<?php echo base_url(); ?>assets/templates/template_gellary/faces/thumnails/22.jpg" data-url="assets/templates/template_gellary/faces/22.jpg"  data-source="static" data-image-name="faces/22.jpg" />
					<img src="<?php echo base_url(); ?>assets/templates/template_gellary/faces/thumnails/23.jpg" data-url="assets/templates/template_gellary/faces/23.jpg"  data-source="static" data-image-name="faces/23.jpg" />
					<img src="<?php echo base_url(); ?>assets/templates/template_gellary/faces/thumnails/24.jpg" data-url="assets/templates/template_gellary/faces/24.jpg"  data-source="static" data-image-name="faces/24.jpg" />
					<img src="<?php echo base_url(); ?>assets/templates/template_gellary/faces/thumnails/25.jpg" data-url="assets/templates/template_gellary/faces/25.jpg"  data-source="static" data-image-name="faces/24.jpg" />
					
					
			</div>
		
			<div id="SelectorBox"></div>
			<div id="SelectorTag">
				<button type="button" class="btn btn-default" onClick=" analyzeUrl() ">
					<span class="glyphicon glyphicon-circle-arrow-right" style="margin-right: 4px" aria-hidden="true"></span>
					<?php echo $this->lang->line('use_this_photo');?>
				</button>
			</div>
		</div>
	
		<div class="col-xs-12 col-sm-12 col-md-12" id="middle_area">
			<div class="col-xs-12 col-sm-12 col-md-4 hidden-xs hidden-sm">
				<?php
				if($ads_info->test_middle_adsense)
				{
				?>
				<div class="home_add_left">
					<?php  echo htmlspecialchars_decode($ads_info->test_middle_adsense);?>
				</div>
				<?php
				}
				?>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-4" style="padding:0;">
				<label id="uploadLabel" class="center-block" style="">
					<button id="uploadFileId" class="btn btn-default center-block action" style="background-color: rgb(174, 117, 11); border-radius: 0" onClick=" document.getElementById('uploadBtn').click(); ">
						<span>
							<img src="<?php echo base_url(); ?>assets/templates/template_gellary/images/browse-icon.svg" style="width: 25px; height: 25px" />
						</span>
						<?php echo $this->lang->line('use_own_photo');?>
					</button>
					
					<input type="hidden" id="data_source" value="static" />
					<input id="uploadBtn" type="file" accept="image/*" style="visibility: hidden; width: 0px; height: 0px">
				</label>
				
				<p id="maxImageSize" class="help-block center-block bodyfont"><?php echo $this->lang->line('max_photo_size');?></p>
				<p id="keep_photo" class="help-block center-block bodyfont"><?php echo $this->lang->line('keep_photo');?></p>
				
				
				<div class="fb_share">
					<div class="fb-share-button" data-href="<?php echo site_url();?>" data-layout="button_count"></div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-4  hidden-xs hidden-sm">
				<?php
				if($ads_info->test_middle_adsense2)
				{
				?>
				<div class="home_add_left">
					<?php  echo htmlspecialchars_decode($ads_info->test_middle_adsense2);?>
				</div>
				<?php
				}
				?>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-12 col-md-12 bottom_add_area">
			<?php
			if($ads_info->test_bottom_adsense)
			{
			?>
			<div class="add_bottom">
				<?php  echo htmlspecialchars_decode($ads_info->test_bottom_adsense);?>
			</div>
			<?php
			}
			?>
		</div>
		
	</div>
	
	<div id="results" hidden>
		<h5 id="analyzingLabel" class="bodyfont" style="font-size: Medium; text-align: center; visibility: hidden;"></h5>
		<div id="thumbContainer" class="center-block" style="padding-left: 0px; position: relative;">
			<img id="thumbnail" data-source="dfsdfdsf" src="<?php echo base_url(); ?>assets/templates/template_gellary/images/placeholder.png" class="img-responsive center-block" onerror=" this.onerror = null;this.src = 'Images/placeholder.png'; "/>
			<div id="faces">
				<div></div>
			</div>
		</div>
		<p id="improvingLabel" class="help-block center-block bodyfont" style="font-weight: 100; font-size: 13px; text-align: center; visibility: hidden"><?php echo $this->lang->line('try_another_photo');?>
			<a class="bodyfont link-underline" href="http://aka.ms/faceapi" target="_blank" style="font-weight: 100; font-size: 13px; text-decoration: underline"><?php echo $this->lang->line('improving_feature');?></a>.</p>
		<button class="btn btn-default center-block action" style="margin-top: 20px; background-color: rgb(174, 117, 11);border-radius:0" onClick=" history.go(-1); ">
			<span>
				<img src="<?php echo base_url(); ?>assets/templates/template_gellary/images/photo-icon.png" style="width: 25px; height: 25px" />
			</span>
			<?php echo $this->lang->line('try_another_photo');?>
		</button>
		<div id="jsonEventDiv" style="margin-top: 30px;" hidden>
			<pre id="jsonEvent" style="text-align: left"></pre>
		</div>
	</div>

</div>
	


<script src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/js/scroll.js"></script>
<script src="<?php echo base_url(); ?>assets/templates/<?php echo $this->template;?>/js/demo.js"></script>

<script language="javascript">
function processRequest(n, t, i, r, u) {
    //window.location.hash = "results";
    var url="<?php echo site_url();?>home/photoreconize_how_old";
	 
	var img_str=$('#thumbnail').attr('src');
	var is_binary="binary";
	if(!n) is_binary="url";
	var data_source="static";
	if(!n) var data_source=$('#data_source').val();
	//alert(data_source); return false;
	//alert(img_str);
	var test_id="<?php echo $tests_info->tests_id; ?>";
	var alias="<?php echo $tests_info->alias; ?>";
	//alert(test_id);
	
	
	$('#bing_loader').show();	
    $.post(url,{img_str:img_str,is_binary:is_binary,data_source:data_source,test_id:test_id,alias:alias},function(data) {
		$('.home_container').html(data);
		 FB.XFBML.parse($("#result_area")[1]);
		//alert(data);
		
	});
}
</script>

<script language="javascript">
	$(document).on('click','#searchsubmit',function(e) {
		//event.preventDefault();
		
		e.preventDefault();
		var query=$('#query').val();
		var url="<?php echo site_url(); ?>home/bing_image_search";
		//alert(query);
		$('#bing_loader').show();
			
		$.post(url,{query:query},function(data) {
			//alert(data);	
			$('#bing_loader').hide();
			$('#imageList').html(data);	
			refresh();	
		});
	});

$(document).ready(function() {
	//window.history.pushState("", "", "<?php echo site_url();?>");
});
</script>

<script language="javascript">
$(function() { 
	$(window).resize(function(){
	 
	 $(".fb-comments").attr("data-width", $(".view_box").width()-15);
	 FB.XFBML.parse($(".result_area")[1]);
	});
});

</script>