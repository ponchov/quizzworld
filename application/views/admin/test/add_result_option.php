<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="<?php echo base_url(); ?>assets/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.textareaCounter.plugin.js"></script>

<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/add_result_option/<?php echo $test_info->tests_id;?>/<?php echo $lang_code; ?>" method="post" enctype="multipart/form-data">  



		    

		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Interval From</label>

			<div class="col-xs-12 col-sm-2 col-md-2">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="interval_from" name="interval_from" value="">					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Interval To</label>

			<div class="col-xs-12 col-sm-2 col-md-2">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="interval_to" name="interval_to" value="">					

				</span>

			</div>				

		</div>

		

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Result</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="hidden" name="test_id" id="test_id" value="<?php echo $test_id;?>" />

					<input type="text" class="form-control required" id="result" name="result" value="">					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Result Description</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea class="form-control" name="result_description" id="result_description"></textarea>					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Image Upload</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="file" name="test_result_img"  />					

				</span>

			</div>				

		</div>
		<?php
			if($test_info->is_real_test == 3)
			{
		?>
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Font Color</label>
				<div class="col-xs-12 col-sm-5">
					<div class="input-group colorpicker">
						<input type="text" name="font_color" id="font_color" value="#000000" class="form-control" />
						<span class="input-group-addon"><i></i></span>
					</div>
				</div>				
			</div>
			
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Font Name</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<ul id="selectable">
						  <li class="oswald" font_file="Oswald.ttf" ><div > </div></li>
						  <li class="raleway" font_file="Raleway.ttf"><div></div></li>
						  <li class="montserrat" font_file="Montserrat.ttf"><div></div></li>
						  <li class="lobster" font_file="Lobster.ttf"><div></div></li>
						  <li class="playfair" font_file="PlayfairDisplay.ttf"><div></div></li>
						  <li class="bree" font_file="Bree Serif.ttf"><div></div></li>
						  <li class="monda" font_file="Monda.ttf"><div></div></li>
						  <li class="dancing" font_file="Dancing Script.ttf"><div></div></li>
						</ul>
					</span>
				</div>				
			</div>
		<?php
		}
		?>

		  <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="add_result_option" value="add_result_option" />
				<input type="hidden" name="font_name" id="font_name" value=""  />
				
           		 <button type="submit" class="btn btn-primary">Save </button>  

				<button class="btn btn-danger" onclick="history.back()" type="button">Cancel</button>  

          </div> 

		



</form>  



<br /> <br /> <br />










<script>
    $(function(){
        $('.colorpicker').colorpicker({format:'rgb'});
    });
	
	
	$(function() {
		var options = {
						'maxCharacterSize': 400,
						'originalStyle': 'originalTextareaInfo',
						'warningStyle' : 'warningTextareaInfo',
						'warningNumber': 40,
						'displayFormat' : '#input/#max | #words words'
				};
		$('#result_description').textareaCount(options);
	});
</script>


<script language="javascript">

	

	$( "#selectable" ).selectable({
		selected: function( event, ui ) {
			//var font_file=ui.attr('font_file');
			var selected_item=$(this).find('.ui-selected');
			font_file=selected_item.attr('font_file');
			$('#font_name').val(font_file);
			//alert(font_file);
		}
	});



// REGISTRATION FORM VALIDATION (THE SHORTER FORM)



jQuery(document).ready(function () {



	jQuery('#add_form').validate({});



}); // end document.ready











</script>

<style>
  #selectable .ui-selecting {
   background: #999;
	border:2px #008000 solid;
  }
  #selectable .ui-selected {
    background: #999;
	border:2px #008000 solid;
  }
   #selectable .ui-selected > div {
    width:100%;
	height:100%;
	background:#008000;
	opacity:0.4;
  }
  
	ul
	{
		margin:0;
		padding:0;
	}
  
  #selectable li
  {
  	height:51px;
	cursor:pointer;
	list-style:none;
	width:400px;
	border-bottom:1px #CCCCCC solid;
  }
  
  #selectable .oswald
  {
  	background-image:url(<?php echo base_url(); ?>assets/img/font_preview/oswald.jpg);
	background-repeat:no-repeat;	
  }
  
  #selectable .raleway
  {
  	background-image:url(<?php echo base_url(); ?>assets/img/font_preview/raleway.jpg);
	background-repeat:no-repeat;	
  }
  
  #selectable .montserrat
  {
  	background-image:url(<?php echo base_url(); ?>assets/img/font_preview/montserrat.jpg);
	background-repeat:no-repeat;	
  }
  
  #selectable .lobster
  {
  	background-image:url(<?php echo base_url(); ?>assets/img/font_preview/lobster.jpg);
	background-repeat:no-repeat;	
  }
  #selectable .playfair
  {
  	background-image:url(<?php echo base_url(); ?>assets/img/font_preview/playfair.jpg);
	background-repeat:no-repeat;	
  }
  #selectable .bree
  {
  	background-image:url(<?php echo base_url(); ?>assets/img/font_preview/bree.jpg);
	background-repeat:no-repeat;	
  }
  
  #selectable .monda
  {
  	background-image:url(<?php echo base_url(); ?>assets/img/font_preview/monda.jpg);
	background-repeat:no-repeat;	
  }
  
  #selectable .dancing
  {
  	background-image:url(<?php echo base_url(); ?>assets/img/font_preview/dancing.jpg);
	background-repeat:no-repeat;	
  }
  
  
  </style>