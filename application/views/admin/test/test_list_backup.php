

	<?php

	if($this->session->flashdata('success_message'))
	{
	?>
		<div class="alert alert-success">  
		  <a class="close" data-dismiss="alert">x</a>  
		  <strong>Success!</strong><?php echo $this->session->flashdata('success_message');?>  
		</div> 
	<?php
	}

	$status='';

	if(!empty($_GET['status']))

	{

		$status=$_GET['status'];

	}
		
		if($lang=='')
		{
		  $lang='en'; 		 
		}
		
		

	?>
	<div class="col-xs-12 col-sm-5 col-md-4">
		
		<form class="form-horizontal" action="<?php echo site_url(); ?>admin/tests/index/<?php echo $lang; ?>" method="post" id="search_form">
			<div class="form-group">			
			<div class="col-xs-7 col-sm-8 col-md-8">
				<input class="form-control required" type="text" name="search" id="search" value="" />
			</div>	
			<div class="col-xs-5 col-sm-4 col-md-4">
				
				<input class="btn btn-primary" type="submit" value="Search" />
			</div>		
		</div>
		</form>
	</div>

	<div class="col-xs-12 col-sm-7 col-md-8">

		<?php if($this->session->userdata('user_type') !=4 ) { ?><a href="<?php echo site_url();?>admin/tests/real_test_add_wizard"><button class="btn pull-right btn-primary" type="button"  style="margin:0 10px;">+Add real test</button></a><?php } ?>

		<?php if($this->session->userdata('user_type') !=4 ) { ?><a href="<?php echo site_url();?>admin/tests/test_add_wizard/"><button class="btn pull-right btn-primary" type="button"  style="margin:0 10px;">+Add new 2</button></a><?php } ?>

		<?php if($this->session->userdata('user_type') == 1) { ?><a href="<?php echo site_url();?>admin/tests/test_add"><button class="btn pull-right btn-primary" type="button">+Add new</button></a><?php  } ?>		

		<?php if($this->session->userdata('user_type') == 1 || $this->session->userdata('user_type') == 3) { ?><a  href="<?php echo site_url();?>admin/tests/index/?status=2"><button style="margin:0 10px;" class="btn pull-right  <?php if($status == 2) echo "btn-success"; ?>" type="button">Inactive</button></a>

		<a  href="<?php echo site_url();?>admin/tests/index/?status=1"><button class="btn pull-right  <?php if($status == 1) echo "btn-success"; ?>" type="button">Active</button></a><?php } ?>

		<?php if($this->session->userdata('user_type') !=4 ) { ?><a  href="<?php echo site_url();?>admin/tests/simple_list"><button style="margin:0 10px;" class="btn pull-right " type="button">Simple List</button></a><?php } ?>

	</div>



	<div class="clear_space" style="height:10px;"></div>
	
	<div class="col-xs-12 col-sm-12 col-md-12 text-right">
		<?php
				if($this->session->userdata('access_language')) $access_language=explode(',',$this->session->userdata('access_language'));
				else $access_language=array();
				
				if($lang == '') $label_all="label-info"; else $label_all="label-default";

				if($language_list)
				{
					foreach($language_list as $language)
					{
						if($lang == $language->language_code) $label_class="label-info"; else $label_class="label-default";
						
						if(in_array($language->language_code,$access_language))
						{
						?>
							<a href="<?php echo site_url();?>admin/tests/index/<?php echo $language->language_code;?>"><span class="label <?php echo $label_class; ?>"><?php echo $language->language_code; ?></span></a>
						<?php 
						}
					}

				}

				

			?>

			
	</div>

	<div class="row" id="test_container">

	<table id="mytable" class="table table-striped table-hover table-fixed-header"> 

		<thead class="header">

			<tr>

			<th> # </th>

			<th class="col-sm-3">Test Title</th>

			<?php if($this->session->userdata('user_type') !=4 and $this->session->userdata('user_type') !=3 ) { ?> <th>Author</th><?php } ?>

			<?php if($this->session->userdata('user_type') == 1) { ?><th>Ads <br /> <input type="checkbox" class="single_col" value="default_ads" id="default_ads" /></th> <?php  } ?>

			<!--<th class="col-sm-3">Description</th>-->

			<!--<th>Result</th>-->

			<?php if($this->session->userdata('user_type') !=4) { ?><th style=""> Status  <?php if($this->session->userdata('user_type') == 1) { ?><br /> <input type="checkbox" class="single_col" value="status" id="status" /><?php } ?></th><?php } ?>

			<?php if($this->session->userdata('user_type') == 1) { ?><th> Editor <br /> <input type="checkbox" class="single_col" value="editor_control" id="editor_control" /></th> <?php  } ?>

			<?php if($this->session->userdata('user_type') == 1) { ?><th> Graphic <br /> <input type="checkbox" class="single_col" value="graphic_control" id="graphic_control" /></th> <?php  } ?>

			<th class="col-sm-5"> Action </th>

			</tr>

		</thead>

		<tbody>

			<?php

				//print_r($test_list);

				if($test_list)

				{	

					$i=0;

					$editor_control=true;

					$graphic_control=true;

					$default_ads=true;

					$status=true;

					

					foreach($test_list as $row)

					{

						$i++;

						if($row->editor_control == 2) $editor_control=false;

						if($row->graphic_control == 2) $graphic_control=false;

						if($row->default_ads == 2) $default_ads=false;

						if($row->status == 2) $status=false;

						

						

						$camera_color="#009933";

						if($row->image == '') $camera_color="#FF0000";

						

						$grahic_camera_color="#CCCCCC";

						if($row->all_image_added == 1) $grahic_camera_color="#3276B1";

						

						$all_image_added_tittle="All Image Not Added";

						if($row->all_image_added == 1) $all_image_added_tittle="All Image Added";

						

						$all_content_ready_color="#CCCCCC";

						if($row->all_content_ready == 1) $all_content_ready_color="#3276B1";

						

						$all_content_ready_tittle="All Content Not Ready";

						if($row->all_content_ready == 1) $all_content_ready_tittle="All Content Ready";

						

						$flag_icons=$this->test_model->gerenate_flag_icon($row->flags);

						if($this->session->userdata('user_type') == 1)

						{

							$status_alingment="status_alingment_center";

						}

						else

						{

							$status_alingment="status_alingment_left";

						}

					?>

					<tr>

						<td data-title="No"><?php echo $i; ?> </td>

						<td data-title="Test Title">

							<?php if($row->is_real_test == 1) {?>

								<img src="<?php echo base_url(); ?>assets/img/r.png" alt="" title="Real Test" /> 

							<?php } ?>

							<?php echo $row->title;?>

						</td>

						<?php if($this->session->userdata('user_type') !=4 and $this->session->userdata('user_type') !=3 ) { ?><td data-title="Author Name"><a href="<?php echo site_url();?>admin/tests/index/?user_id=<?php echo $row->created_by;?>"><?php echo $row->first_name;?> <?php echo $row->last_name;?></a></td><?php } ?>

						<?php if($this->session->userdata('user_type') == 1) { ?>

						<td>

						<input type="checkbox" <?php if($row->default_ads == 1) echo 'checked="checked"';?>  class="default_ads" value="<?php echo $row->tests_id;?>" />

						 <?php  if($row->default_ads == 2) { ?>&nbsp; &nbsp; <a href="<?php echo site_url();?>admin/tests/ads_edit/<?php echo $row->tests_id;?>">Edit ads</a><?php } ?>

						 </td>	

						 <?php } ?>	

						 

						<?php if($this->session->userdata('user_type') !=4) { ?>				

						<td data-title="Status" class="<?php echo $status_alingment; ?>" style="text-align:left;">

							<?php 

								if(!($this->session->userdata('user_type') == 1))

								{

								if($row->status == 1) echo "Active"; else echo "Inactive";

								}

								else

								{

								?>

								<input activated_date="<?php echo $row->activated_date;?>" test_image="<?php echo $row->image;?>" type="checkbox" class="status" <?php if($row->status == 1) echo 'checked="checked"';?>  value="<?php echo $row->tests_id;?>" />

								<?php 

								} 

								?>

						</td>

						<?php } ?>

						

						<?php if($this->session->userdata('user_type') == 1) { ?><td><input type="checkbox" class="editor_control" <?php if($row->editor_control == 1) echo 'checked="checked"';?>  value="<?php echo $row->tests_id;?>" /></td><?php } ?>

						

						<?php if($this->session->userdata('user_type') == 1) { ?><td><input type="checkbox" class="graphic_control" <?php if($row->graphic_control == 1) echo 'checked="checked"';?>  value="<?php echo $row->tests_id;?>" /></td><?php } ?>

						

						<td data-title="Action">

							<?php if($this->session->userdata('user_type') !=4 ) { ?><a href="<?php echo site_url();?>admin/tests/test_edit/<?php echo $row->testid;?>/<?php echo $lang; ?>"><span title="Edit" class="glyphicon glyphicon-pencil"></span> </a> &nbsp; <?php } ?>

							<?php if($this->session->userdata('user_type') == 1) { ?><a href="<?php echo site_url();?><?php echo $lang; ?>/<?php echo $row->alias;?>.html" target="_blank"><span title="View" class="glyphicon glyphicon-search"></span></a> &nbsp; <?php } ?>

							<a href="<?php echo site_url();?>admin/tests/test_details/<?php echo $row->testid;?>/<?php echo $lang;?>"><span class="glyphicon glyphicon-eye-open" title="Preview"></span></a> &nbsp; 

							<?php if($this->session->userdata('user_type') !=4 ) { ?><a href="<?php echo site_url();?>admin/tests/result_option/<?php echo $row->testid;?>/<?php echo $lang; ?>"><span class="glyphicon glyphicon-wrench" title="Result"></span></a> &nbsp; <?php } ?>

							<?php if($this->session->userdata('user_type') !=4 ) { ?><a href="<?php echo site_url();?>admin/tests/questions/<?php echo $row->testid;?>/<?php echo $lang; ?>"><span class="glyphicon glyphicon-question-sign" title="Quesitons"></span></a> &nbsp; <?php } ?>

							 

							<?php if($this->session->userdata('user_type') == 1) { ?><span class="glyphicon glyphicon-camera" style="color:<?php echo $camera_color;?>;"></span> &nbsp;  <?php } ?>

							<?php if($this->session->userdata('user_type') == 1) { ?>

							<a onclick="javascript: return confirm('Are you sure to delete this?')" href="<?php echo site_url();?>admin/tests/test_delete/<?php echo $row->tests_id;?>/<?php echo $lang; ?>"> <span title="Delete" class="glyphicon glyphicon-trash"></span></a>  &nbsp; 

							<?php } ?>

							<span class="glyphicon glyphicon-camera" title="<?php echo $all_image_added_tittle; ?>" style="color:<?php echo $grahic_camera_color;?>;"></span> &nbsp;

							<?php if(($this->session->userdata('user_type') == 1) || $this->session->userdata('user_type') == 3) { ?><span class="glyphicon glyphicon-ok-sign" title="<?php echo $all_content_ready_tittle; ?>" style="color:<?php echo $all_content_ready_color;?>;"></span> <?php } ?>

							<?php echo $flag_icons;?>

							<?php 
								//echo $this->session->userdata('access_language');

									echo "&nbsp;";
									if($this->session->userdata('access_language')) $access_language=explode(',',$this->session->userdata('access_language'));
									else $access_language=array();								

									if($language_list)
									{
										foreach($language_list as $language)
										{
											$language_content=$this->test_model->get_test_content($row->testid, $language->language_code);
											if($language_content) $label_class="label-info"; else $label_class="label-default";
											if(in_array($language->language_code,$access_language))
											{
										?>
											&nbsp;											
											 <a href="<?php echo site_url();?>admin/tests/test_content/<?php echo $row->testid;?>/<?php echo $language->language_code;?>"><span class="label <?php echo $label_class; ?>"><?php echo $language->language_code; ?></span></a>
										<?php 
											}
										}
									}
								
							?>

							

						</td>

						

					</tr>

					<?php

					}

				}

			?>

		</tbody>

	</table>
	<div class="row text-center">
		<div class="pagination"><?php echo $pagination; ?></div>
	</div>

	</div>
	
<script language="javascript">
	//$('.pagination a').on('click',function(e) {
	$(document).on('click','.pagination22 a',function(e) {
		e.preventDefault();
		var overlay = $('<div id="overlay"><div id="indicator"><img src="<?php echo base_url();?>assets/img/ajax-loader.gif" /></div> </div>');
		overlay.appendTo(document.body);
		
		var url=$(this).attr('href');
		//alert(url);
		$.post(url,{},function(data){ //alert(data);
			$('#overlay').remove();
			$('#test_container').html(data);
		});
	});
</script>


<script language="javascript">

	$(document).ready(function() {

		

		<?php if($editor_control) { ?> $('#editor_control').attr('checked','checked');<?php } ?>

		<?php if($graphic_control) { ?> $('#graphic_control').attr('checked','checked');<?php } ?>

		<?php if($default_ads) { ?> $('#default_ads').attr('checked','checked');<?php } ?>

		<?php if($status) { ?> $('#status').attr('checked','checked');<?php } ?>

		

		$(document).on('click','.single_col',function() {

			var col_name=$(this).val();

			var ele_id=$(this).attr('id');

			//alert(col_name); 

			var overlay = $('<div id="overlay"><div id="indicator"><img src="<?php echo base_url();?>assets/img/ajax-loader.gif" /></div> </div>');

			overlay.appendTo(document.body);

			if(this.checked)

			{

				var url="<?php echo site_url();?>admin/tests/save_test_col";

				$.post(url,{col_name:col_name,value:'1',ele_id:ele_id},function(data) {//alert(data);

					$('#overlay').remove();

					$('#test_container').html(data);

				});

			}

			else

			{

				var url="<?php echo site_url();?>admin/tests/save_test_col";

				$.post(url,{col_name:col_name,value:'2',ele_id:0},function(data) {

					$('#overlay').remove();

					$('#test_container').html(data);

				});

			}

		});

		

		

		

		$(document).on('click','.status',function() {

			var overlay = $('<div id="overlay"><div id="indicator"><img src="<?php echo base_url();?>assets/img/ajax-loader.gif" /></div> </div>');

			overlay.appendTo(document.body);

			
			
			

			var test_id=$(this).val();

			var activated_date=$(this).attr('activated_date');

			//alert(activated_date);



			

			

			var url="<?php echo site_url();?>admin/tests/change_test_status/<?php echo $lang;?>/<?php echo $page_number;?>";

			<?php

				if(!empty($_GET['status']))

				{

				?>

				var url="<?php echo site_url();?>admin/tests/change_test_status/<?php echo $lang;?>/<?php echo $page_number;?>?status=<?php echo $_GET['status'];?>";

				<?php

				}

			?>

			

			if(this.checked)

			{//alert(url);

				var test_image=$(this).attr('test_image');

				if(test_image == '')

				{

					alert("Please add image before active this test");

					$('#overlay').remove();

					return false;

				} 

				//alert(url);

				$.post(url,{test_id:test_id,option:1,activated_date:activated_date},function(data) {

					$('#overlay').remove();

					$('#test_container').html(data);
					//alert('ss');
					//alert(data);

				});

			}

			else

			{

				$.post(url,{test_id:test_id,option:2},function(data) {

					$('#overlay').remove();

					$('#test_container').html(data);

				});

			}

		});

		

		

		$(document).on('click','.editor_control',function() {

			var overlay = $('<div id="overlay"><div id="indicator"><img src="<?php echo base_url();?>assets/img/ajax-loader.gif" /></div> </div>');

			overlay.appendTo(document.body);

			var test_id=$(this).val();			

			var url="<?php echo site_url();?>admin/tests/set_editor_control";

			<?php

				if(!empty($_GET['status']))

				{

				?>

				var url="<?php echo site_url();?>admin/tests/set_editor_control/?status=<?php echo $_GET['status'];?>";

				<?php

				}

			?>

			

			if(this.checked)

			{//alert(url);

				

				$.post(url,{test_id:test_id,option:1},function(data) {

					$('#overlay').remove();

					$('#test_container').html(data);

					//alert(data);

				});

			}

			else

			{

				$.post(url,{test_id:test_id,option:2},function(data) {

					$('#overlay').remove();

					$('#test_container').html(data);

				});

			}

		});

		

		$(document).on('click','.graphic_control',function() {

			var overlay = $('<div id="overlay"><div id="indicator"><img src="<?php echo base_url();?>assets/img/ajax-loader.gif" /></div> </div>');

			overlay.appendTo(document.body);

			var test_id=$(this).val();			

			var url="<?php echo site_url();?>admin/tests/set_graphic_control";

			<?php

				if(!empty($_GET['status']))

				{

				?>

				var url="<?php echo site_url();?>admin/tests/set_graphic_control/?status=<?php echo $_GET['status'];?>";

				<?php

				}

			?>

			

			if(this.checked)

			{//alert(url);

				

				$.post(url,{test_id:test_id,option:1},function(data) {

					$('#overlay').remove();

					$('#test_container').html(data);

					//alert(data);

				});

			}

			else

			{

				$.post(url,{test_id:test_id,option:2},function(data) {

					$('#overlay').remove();

					$('#test_container').html(data);

				});

			}

		});

		

		

		$(document).on('click','.default_ads',function() {

			var overlay = $('<div id="overlay"><div id="indicator"><img src="<?php echo base_url();?>assets/img/ajax-loader.gif" /></div> </div>');

			overlay.appendTo(document.body);

			

			var url="<?php echo site_url();?>admin/tests/change_ads_settings";

			<?php

				if(!empty($_GET['status']))

				{

				?>

				var url="<?php echo site_url();?>admin/tests/change_ads_settings/?status=<?php echo $_GET['status'];?>";

				<?php

				}

			?>

			

			var test_id=$(this).val();

			

			if(this.checked)

			{//alert(url);

				$.post(url,{test_id:test_id,option:1},function(data) {

					$('#overlay').remove();

					$('#test_container').html(data);

					//alert(data);

				});

			}

			else

			{

				$.post(url,{test_id:test_id,option:2},function(data) {

					$('#overlay').remove();

					$('#test_container').html(data);

				});

			}

		});

		

	});

</script>

<style type="text/css">



	

	#overlay {

		position: fixed;

		top: 0;

		left: 0;

		width: 100%;

		height: 100%;

		background-color: #000;

		filter:alpha(opacity=50);

		-moz-opacity:0.5;

		-khtml-opacity: 0.5;

		opacity: 0.5;

		z-index: 10000;

		

	}

	#indicator {

		z-index: 10000;

		color:#FF0000;

		font-size:20px;

		height:50px;

		position:absolute;

		left:45%;

		top:45%;

	}

	

	.status_alingment_center

	{

		text-align:center;

	}

	

	.status_alingment_left

	{

		text-align:left;

	}

	a:hover{

		text-decoration:none;

	}

	

	



</style>



<script language="javascript" type="text/javascript" >

    $(document).ready(function(){

      // add 30 more rows to the table

      var row = $('table#mytable > tbody > tr:first');

      //var row2 = $('table#mytable2 > tbody > tr:first');

     /* for (i=0; i<30; i++) {

        $('table#mytable > tbody').append(row.clone());

        //$('table#mytable2 > tbody').append(row2.clone());

      }*/



      // make the header fixed on scroll

      $('.table-fixed-header').fixedHeader();

    });

  </script>
  
  <script language="javascript">
// REGISTRATION FORM VALIDATION (THE SHORTER FORM)
jQuery(document).ready(function () {

	jQuery('#search_form').validate({});

}); // end document.ready

</script>