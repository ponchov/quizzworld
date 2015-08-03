    </div> 



	<div class="container">

		<br /> 

		

		<div class="col-xs-12 col-sm-12 col-md-12  text-center">

			<hr />

			<a href="<?php echo site_url();?>"><?php echo $this->lang->line('home');?></a>  | 

			<a href="<?php echo site_url();?>home/privacy_policy"><?php echo $this->lang->line('private_policy');?></a> | 

			<a href="<?php echo site_url();?>contact-us.html"><?php echo $this->lang->line('contact');?></a> <br />

			<a href="<?php echo site_url();?>"><?php echo $config_info->site_title;?></a> &copy; <?php echo date('Y');?>. <?php echo $this->lang->line('copyright');?>

		</div>

	</div>


	</div>
	
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

<style type="text/css">

</style>

<script language="javascript">
$(document).ready(function () {

	var item_height=$('.item').height();
	//alert(item_height);
	$('.slick-prev').css({height: item_height+"px"});
	$('.slick-next').css({height: item_height+"px"});
	
	
	
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



