    </div> 

	<div class="fb_popup facebook-popup facebook-off">
		<div class="fb_popup_close">
			<span class="fb_text">Follow us on Facebook</span>
			<a style="float:right;"  class="popup-close" id="bpclosetrig" onClick="hidepopup()">X</a>
		</div>
		<div class="fb-like-box"  data-width="" data-href="<?php echo $config_info->facebook_url;?>" data-colorscheme="light" data-show-faces="false" data-header="true" data-stream="false" data-show-border="true"></div>
	</div>

	<div id="up_arrow">
		<img src="<?php echo base_url();?>assets/templates/<?php echo $this->template;?>/img/up_arrow.png" />
	</div>
	<?php /*?><div class="container">

		<br /> 

		

		<div class="col-xs-12 col-sm-12 col-md-12  text-center">

			<hr />

			<a href="<?php echo site_url();?>"><?php echo $this->lang->line('home');?></a>  | 

			<a href="<?php echo site_url();?>home/privacy_policy"><?php echo $this->lang->line('private_policy');?></a> | 

			<a href="<?php echo site_url();?>contact-us.html"><?php echo $this->lang->line('contact');?></a> <br />

			<a href="<?php echo site_url();?>"><?php echo $config_info->site_title;?></a> &copy; <?php echo date('Y');?>. <?php echo $this->lang->line('copyright');?>

		</div>

	</div>
<?php */?>
    

  



<div id="overlay"></div>


 
	<!-- Google Analytics Code -->
	<?php echo $this->jsconfig->google_analytics; ?>
	<!-- Google Analytics Code end  -->
	
	<!-- Google+ tag start-->
	<?php echo $this->jsconfig->google_plus; ?>
	<!-- Google+ tag end-->
	
	<!-- Quantcast Tag -->
	<?php echo $this->jsconfig->quantcast; ?>
	<!-- End Quantcast tag -->
	
	<!-- Start Taboola Code -->
	<?php echo $this->jsconfig->taboola_body; ?>
	<!-- End Taboola Code -->
	
	<!-- Google Code for Remarketing Tag -->
	<?php echo $this->jsconfig->google_remarking; ?>
	<!-- Google Code for Remarketing Tag -->
	
	<!-- google_ad_section_end --> 
  </body>

</html>

<script type="text/javascript">
     
	  
	  /*jQuery(document).ready(function($) {
	  	  left_content_height=$('#left_content').height();
		  //alert(left_content_height);
		  $(window).scroll(function () {
				
				if($(window).scrollTop() + $(window).height() >=  left_content_height) { //alert($(window).scrollTop());
					//$('#up_arrow').css({bottom:'120px'});
					if($(".fb_popup").hasClass('facebook-off'))
					{
						$(".fb_popup").addClass('facebook-on');
						$(".fb_popup").removeClass('facebook-off');
						$('#up_arrow').css({'z-index':'0'});
						$(".fb_popup").animate({'right': '10px'},1500);
					}
				}
				else
				{
					$('#up_arrow').css({bottom:'0px'});
					//$('.fb_popup').slideUp();
					if($(".fb_popup").hasClass('facebook-on'))
					{
						$(".fb_popup").removeClass('facebook-on');
						$(".fb_popup").addClass('facebook-off');
						$(".fb_popup").animate({'right': '-330px'},1500);
					}
					//$('.facebook-popup').removeClass('fb_popup');
				} 
				 
			});
		});*/
		
		var lastScrollTop = 0;
		 left_content_height=$('#left_content').height();
		$(window).scroll(function(event){
		   var st = $(this).scrollTop();
		   if (st > lastScrollTop){
			  if(st + $(window).height() >=  left_content_height)
			  {
			  	if($(".fb_popup").hasClass('facebook-off'))
				{
					$(".fb_popup").addClass('facebook-on');
					$(".fb_popup").removeClass('facebook-off');
					$(".fb_popup").animate({'right': '10px'},1500);
				}
			  }
		   } else {
			  	if($(".fb_popup").hasClass('facebook-on'))
				{
					$(".fb_popup").removeClass('facebook-on');
					$(".fb_popup").addClass('facebook-off');
					$(".fb_popup").animate({'right': '-330px'},500);
				}
		   }
		   lastScrollTop = st;
		});
		
		function hidepopup()
		{
			$(".fb_popup").removeClass('facebook-on');
			$(".fb_popup").addClass('facebook-off');
			$(".fb_popup").animate({'right': '-330px'},1500);
			$(".fb_popup").removeClass('fb_popup');
			
		}
		
		
		$(document).ready(function() {
			$("#up_arrow").hide();
			
			$(function () {
				$(window).scroll(function () {
					if ($(this).scrollTop() > 100) {
						$('#up_arrow').fadeIn();
					} else {
						$('#up_arrow').fadeOut();
					}
				});
		
				// scroll body to 0px on click
				$('#up_arrow').click(function () {
					$('body,html').animate({
						scrollTop: 0
					}, 800);
					return false;
				});
			});
		});
		
  </script>
  
  
  
  
 <script language="javascript">
	$(document).ready(function () {
	
		//stick in the fixed 100% height behind the navbar but don't wrap it
		$('#slide-nav.navbar-inverse').after($('<div class="inverse" id="navbar-height-col"></div>'));
	  
		$('#slide-nav.navbar-default').after($('<div id="navbar-height-col"></div>'));  
	
		// Enter your ids or classes
		var toggler = '.navbar-toggle';
		var pagewrapper = '#page-content';
		var navigationwrapper = '.navbar-header';
		var menuwidth = '100%'; // the menu inside the slide menu itself
		var slidewidth = '60%';
		var menuneg = '-100%';
		var slideneg = '-60%';
		
		$(document).on("click", ".navbar-toggle", function (e) { 
			$('.home_header_bottom').show();
		});
		
		$(document).on("click", ".slide-active", function (e) { 
			$('.home_header_bottom').hide();
		});
		
		
		$("#slide-nav").on("click", toggler, function (e) { 
	
			var selected = $(this).hasClass('slide-active');
			//-----------------
			if(!selected)
			{
				$('#overlay').addClass('overlay');
			}
			else
			{
				$('#overlay').removeClass('overlay');
			}
			//---------------
			$('#topmenu').stop().animate({
				left: selected ? menuneg : '0px'
			});
	
			$('#navbar-height-col').stop().animate({
				left: selected ? slideneg : '0px'
			});
	
			$(pagewrapper).stop().animate({
				//left: selected ? '0px' : slidewidth
			});
	
			$(navigationwrapper).stop().animate({
				//left: selected ? '0px' : slidewidth
			});
	
	
			$(this).toggleClass('slide-active', !selected);
			$('#topmenu').toggleClass('slide-active');
	
	
			$('#page-content, .navbar, body, .navbar-header').toggleClass('slide-active');
	
	
		});
	
		$(document).on("click", "#overlay", function (e) { 
	
			$(".slide-active").click();
		});
		var selected = '#topmenu, #page-content, body, .navbar, .navbar-header';
	
	
		$(window).on("resize", function () {
	
			if ($(window).width() > 767 && $('.navbar-toggle').is(':hidden')) {
				$(selected).removeClass('slide-active');
			}
	
	
		});
		
		$(document).on("change", ".language", function (e) { 	
			var url=$(this).val();
			//alert(url);
			window.location.href=url;
		});
	
	});
</script>

<style type="text/css">
  	.fix_ads {
		position:fixed;
		top:85px;
		
	}
  </style>
  
  


  <script language="javascript">
 
	 
	function fixDiv() {
		var $div = $("#right_top");
		var right_top_height=$("#right_top").height();
		var top_offset=right_top_height + $div.data("top");
		if ($(window).scrollTop() > top_offset) { //alert($div.data("top"));
			$('#ads_block').addClass('fix_ads');
		}
		else {
		   $('#ads_block').removeClass('fix_ads');
		}
	}
	//alert($("#right_top").offset().top);
	$("#right_top").data("top", $("#right_top").offset().top); // set original position on load
	
	$(window).scroll(fixDiv);


</script>

<style type="text/css">


</style>


