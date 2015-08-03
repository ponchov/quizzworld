	<div class="row">
		<div class="col-sm-3">			
			<form class="form-horizontal" action="<?php echo site_url(); ?>admin/tests/simple_list_search/" method="post" id="search_form">
				<div class="form-group">			
				<div class="col-xs-7 col-sm-10 col-md-10">
					<input class="form-control required" type="text" name="search" id="search" value="<?php if($this->session->userdata('search')) echo $this->session->userdata('search'); ?>" />
				</div>	
				<div class="col-xs-5 col-sm-2 col-md-2">
					
					<input class="btn btn-primary" type="submit" value="Search" />
				</div>		
			</div>
			</form>
		</div>
		
		<div class="col-sm-3" style="">
			<form class="form-horizontal" action="<?php echo site_url(); ?>admin/tests/simple_list_search/" method="post" id="language_search">
				<div class="form-group">
				<label for="inputInfo" class="col-sm-6 control-label no-padding-right">Language</label>
				<div class="col-sm-6">								
					<select name="sort_by_language" id="sort_by_language" class="form-control">
						<option selected="selected" value="">Select Language</option>
						<?php 
							if($language_list)
							{
								foreach($language_list as $language)
								{
								?>
									<option value="<?php echo $language->language_code; ?>" <?php if($this->session->userdata('search_language') == $language->language_code) echo 'selected="selected"';?>><?php echo $language->language_code; ?></option>
								<?php 
								}
							}
						?>
					</select>
				</div>				
			</div>
			</form>	
		</div>
		
		<div class="col-sm-3" style="">
			<form class="form-horizontal" action="<?php echo site_url(); ?>admin/tests/simple_list_search/" method="post" id="template_search">
				<div class="form-group">
				<label for="inputInfo" class="col-sm-6 control-label no-padding-right">Template</label>
				<div class="col-sm-6">								
					<select name="template" id="template" class="form-control">						
						<option value="personal" <?php if($this->session->userdata('search_template') =="personal") echo "selected"; ?> >Personal Test</option>
						<option value="2" <?php if($this->session->userdata('search_template') =="2") echo "selected"; ?>>Twist Test</option>
						<option value="3" <?php if($this->session->userdata('search_template') =="3") echo "selected"; ?>>Name Test</option>
						<option value="5" <?php if($this->session->userdata('search_template') =="5") echo "selected"; ?>>Face Test</option>
						<option value="6" <?php if($this->session->userdata('search_template') =="6") echo "selected"; ?>>Facebook Apps</option>
					</select>
				</div>				
			</div>
			</form>	
		</div>
		
		<div class="col-sm-3">
			<form class="form-horizontal" id="sort_form" action="<?php echo site_url();?>admin/tests/simple_list_search" method="post">
				<div class="form-group">
					<label for="inputInfo" class="col-xs-6 col-sm-5 control-label no-padding-right">Sort By :</label>
					<div class="col-xs-6 col-sm-7">	
						 <select name="sort_by" id="sort_by" class="form-control">
							<option value="">Select</option>
							<option value="DESC" <?php if($this->session->userdata('search_sort_by') == 'DESC') echo 'selected="selected"';?> >Facebook Like High</option>
							<option value="ASC" <?php if($this->session->userdata('search_sort_by') == 'ASC') echo 'selected="selected"';?> >Facebook Like Low</option>
						</select>
					</div>
				</div>
			</form>
		</div>
	
	</div> <!--row-->

	<div class="clear_space" style="height:10px;"></div>

	<div class="row" id="test_container">

	<table id="mytable" class="table table-striped table-hover table-fixed-header"> 

		<thead class="header">

			<tr>

			<th class="sr"> # </th>

			<th class="col-sm-5">Test Title</th>

			<th class="col-sm-1">Flags</th>

			<th class="col-sm-2">Author</th>

			<th class="col-sm-2">Activation Date</th>

			<th class="col-sm-2">Facebook Like</th>



			</tr>

		</thead>

		<tbody>

			<?php

				if($test_list)

				{	

					$i=0;

					foreach($test_list as $row)

					{

						$i++;

						$flag_icons=$this->test_model->gerenate_flag_icon($row->flags);

					?>

					<tr>

						<td><?php echo $i; ?> </td>

						<td>
						<?php 
							if($row->is_real_test == 1) 
							{
							?>

								<img src="<?php echo base_url(); ?>/assets/img/r.png" alt="" title="Real Test" /> 

							<?php 
							} 
							else if($row->is_real_test == 2)
							{
							?>
								<img src="<?php echo base_url(); ?>/assets/img/t.jpg" alt="" title="Knowledge Test" /> 
							<?php
							}
							else if($row->is_real_test == 3)
							{
							?>
								<img src="<?php echo base_url(); ?>/assets/img/3.jpg" alt="" title="Name's Test" /> 
							<?php
							}
							else if($row->is_real_test == 4)
							{
							?>
								<img src="<?php echo base_url(); ?>/assets/img/h.jpg" alt="" title="How Old Test" /> 
							<?php
							}
							else if($row->is_real_test == 5)
							{
							?>
								<img src="<?php echo base_url(); ?>/assets/img/f.png" alt="" title="Face Test" /> 
							<?php
							}
							else if($row->is_real_test == 6)
							{
							?>
								<img src="<?php echo base_url(); ?>/assets/img/fa.png" alt="" title="Facebook Apps" /> 
							<?php
							}
							
							?>
							
							<?php echo $row->title;?>
						</td>

						<td><?php echo $flag_icons;?></td>

						<td><?php if($this->session->userdata('user_type') != 2) { ?> <a href="<?php echo site_url();?>admin/tests/simple_list/?user_id=<?php echo $row->created_by;?>"><?php echo $row->username;?></a> <?php } else if($this->session->userdata('user_type') == 2 && $row->created_by == $this->session->userdata('user_id')) echo $row->username; else echo "---";?></td>

						<td><?php echo date('m-d-Y H:i A',strtotime($row->activated_date));?></td>

						<td><?php  echo $row->fb_like;?> </td>

						

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

	$(document).ready(function() {
			$(document).on('change','#sort_by',function() {
				$('#sort_form').submit();
			});
			
			$(document).on('change','#sort_by_language',function() {
				$('#language_search').submit();				
			});
			
			$(document).on('change','#template',function() {
				$('#template_search').submit();	
							
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

	.sr {

		width:30px !important;

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