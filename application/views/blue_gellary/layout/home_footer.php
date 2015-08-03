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

    <!-- Bootstrap core JavaScript

  <?php /*?>  ================================================== -->

    <!-- Placed at the end of the document so the pages load faster -->

    <?php if($config_info->google_analytics) echo htmlspecialchars_decode($config_info->google_analytics);?>

    <!-- Google+ tag start-->

<a href="https://plus.google.com/+Survley_com" rel="publisher"></a>

<!-- Google+ tag end-->

<!-- Quantcast Tag -->

<script type="text/javascript">

var _qevents = _qevents || [];



(function() {

var elem = document.createElement('script');

elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";

elem.async = true;

elem.type = "text/javascript";

var scpt = document.getElementsByTagName('script')[0];

scpt.parentNode.insertBefore(elem, scpt);

})();



_qevents.push({

qacct:"p-q9CSRau13eZQp"

});

</script>



<noscript>

<div style="display:none;">

<img src="//pixel.quantserve.com/pixel/p-q9CSRau13eZQp.gif" border="0" height="1" width="1" alt="Quantcast"/>

</div>

</noscript>

<!-- End Quantcast tag -->

<!-- Start Taboola Code -->

<script type="text/javascript">

window._taboola = window._taboola || [];

_taboola.push({flush:true});

</script>
<?php */?>
<!-- End Taboola Code -->
	</div>
  </body>

</html>

<style type="text/css">
/* adjust body when menu is open */
body.slide-active {
    overflow-x: hidden
}
/*first child of #page-content so it doesn't shift around*/
.no-margin-top {
    margin-top: 0px!important
}
/*wrap the entire page content but not nav inside this div if not a fixed top, don't add any top padding */
#page-content {
    position: relative;
    padding-top: 0px;
    left: 0;
}
#page-content.slide-active {
    padding-top: 0
}



/* put toggle bars on the left :: not using button */
#slide-nav .navbar-toggle {
    cursor: pointer;
    position: relative;
    line-height: 0;
    float: left;
    margin: 0;
    width: 30px;
    height: 40px;
    padding: 10px 0 0 0;
    border: 0;
    background: transparent;
}
/* icon bar prettyup - optional */
#slide-nav .navbar-toggle > .icon-bar {
    width: 100%;
    display: block;
    height: 3px;
    margin: 5px 0 0 0;
}
#slide-nav .navbar-toggle.slide-active .icon-bar {
    background: orange
}
.navbar-header {
    position: relative
}
/* un fix the navbar when active so that all the menu items are accessible */
.navbar.navbar-fixed-top.slide-active {
    position: relative
}
/* screw writing importants and shit, just stick it in max width since these classes are not shared between sizes */
@media (max-width:767px) { 
	#slide-nav .container {
	    margin: 0!important;
	    padding: 0!important;
      height:100%;
	}
	#slide-nav .navbar-header {
	    margin: 0 auto;
	    padding: 0 15px;
	}
	#slide-nav .navbar.slide-active {
	    position: absolute;
	    width: 30%;
	    top: -1px;
	    z-index: 1000;
	}
	#slide-nav #topmenu {
	    background: #f7f7f7;
	    left: -100%;
	    width: 30%;
	    min-width: 0;
	    position: absolute;
	    padding-left: 0;
	    z-index: 2;
	    top: -8px;
	    margin: 0;
	}
	#slide-nav #topmenu .navbar-nav {
	    min-width: 0;
	    width: 100%;
	    margin: 0;
	}
	#slide-nav #topmenu .navbar-nav .dropdown-menu li a {
	    min-width: 0;
	    width: 30%;
	    white-space: normal;
	}
	#slide-nav {
	    border-top: 0
	}
	#slide-nav.navbar-inverse #topmenu {
	    background: #333
	}
	/* this is behind the navigation but the navigation is not inside it so that the navigation is accessible and scrolls*/
	#navbar-height-col {
	    position: fixed;
	    top: 0;
	    height: 100%;
        bottom:0;
	    width: 30%;
	    left: -30%;
	    background: #f7f7f7;
	}
	#navbar-height-col.inverse {
	    background: #333;
	    z-index: 1;
	    border: 0;
	}
	#slide-nav .navbar-form {
	    width: 100%;
	    margin: 8px 0;
	    text-align: center;
	    overflow: hidden;
	    /*fast clearfixer*/
	}
	#slide-nav .navbar-form .form-control {
	    text-align: center
	}
	#slide-nav .navbar-form .btn {
	    width: 100%
	}
}
@media (min-width:768px) { 
	#page-content {
	    left: 0!important
	}
	.navbar.navbar-fixed-top.slide-active {
	    position: fixed
	}
	.navbar-header {
	    left: 0!important
	}
}

</style>

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
    var slidewidth = '30%';
    var menuneg = '-100%';
    var slideneg = '-30%';
	
	$(document).on("click", ".navbar-toggle", function (e) { 
		$('.home_header_bottom').show();
	});
	
	$(document).on("click", ".slide-active", function (e) { 
		$('.home_header_bottom').hide();
	});
	
	
    $("#slide-nav").on("click", toggler, function (e) { 

        var selected = $(this).hasClass('slide-active');

        $('#topmenu').stop().animate({
            left: selected ? menuneg : '0px'
        });

        $('#navbar-height-col').stop().animate({
            left: selected ? slideneg : '0px'
        });

        $(pagewrapper).stop().animate({
            left: selected ? '0px' : slidewidth
        });

        $(navigationwrapper).stop().animate({
            left: selected ? '0px' : slidewidth
        });


        $(this).toggleClass('slide-active', !selected);
        $('#topmenu').toggleClass('slide-active');


        $('#page-content, .navbar, body, .navbar-header').toggleClass('slide-active');


    });


    var selected = '#topmenu, #page-content, body, .navbar, .navbar-header';


    $(window).on("resize", function () {

        if ($(window).width() > 767 && $('.navbar-toggle').is(':hidden')) {
            $(selected).removeClass('slide-active');
        }


    });

});


$('.autoplay').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  dots: true,
  
  responsive: [
    {
      breakpoint: 768,
      settings: {
		  slidesToShow: 2,
		  slidesToScroll: 1,
		  autoplay: true,
		  autoplaySpeed: 2000,
		  dots: true,
		  arrows: false,
      }
    },
    {
      breakpoint: 450,
      settings: {
          slidesToShow: 1,
		  slidesToScroll: 1,
		  autoplay: true,
		  autoplaySpeed: 2000,
		  dots: true,
		  arrows: false,
      }
    }
  ]
});

</script>



