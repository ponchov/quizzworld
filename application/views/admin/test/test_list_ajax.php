	<table id="mytable" class="table table-striped table-hover table-fixed-header"> 

		<thead class="header">

			<tr>

			<th> # </th>
			<th>ID</th>
			<th class="col-sm-3">Test Title</th>

			<?php if($this->session->userdata('user_type') !=4 and $this->session->userdata('user_type') !=3 ) { ?> <th>Author</th><?php } ?>

			<?php if($this->session->userdata('user_type') == 1) { ?><th>Ads <br /> <input type="checkbox" class="single_col" value="default_ads" id="default_ads" /></th> <?php  } ?>

			<!--<th class="col-sm-3">Description</th>-->

			<!--<th>Result</th>-->

			<?php if($this->session->userdata('user_type') !=4) { ?><th style=""> Status  <?php if($this->session->userdata('user_type') == 1) { ?><br /> <input type="checkbox" class="single_col" value="status" id="status" /><?php } ?></th><?php } ?>

			<?php if($this->session->userdata('user_type') == 1) { ?><th> Editor <br /> <input type="checkbox" class="single_col" value="editor_control" id="editor_control" /></th> <?php  } ?>

			<?php if($this->session->userdata('user_type') == 1) { ?><th> Graphic <br /> <input type="checkbox" class="single_col" value="graphic_control" id="graphic_control" /></th> <?php  } ?>
			<?php if($this->session->userdata('user_type') == 1) { ?><th> Featured</th> <?php  } ?>
			<th class="col-sm-5"> Action </th>

			</tr>

		</thead>

		<tbody>

			<?php

				//print_r($test_list);

				if($test_list)

				{	

					$i=$page_number;

					$editor_control=true;

					$graphic_control=true;

					$default_ads=true;

					$status=true;
					$featured=true;
					

					foreach($test_list as $row)

					{

						$i++;

						if($row->editor_control != 1) $editor_control=false;

						if($row->graphic_control != 1) $graphic_control=false;

						if($row->default_ads != 1) $default_ads=false;

						if($row->status != 1) $status=false;
						if($row->featured != 1) $featured=false;
						

						

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
						<td data-title="No"><?php echo $row->testid; ?> </td>
						<td data-title="Test Title">

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

						<?php if($this->session->userdata('user_type') !=4 and $this->session->userdata('user_type') !=3 ) { ?><td data-title="Author Name"><a href="<?php echo site_url();?>admin/tests/search_tests/?user_id=<?php echo $row->created_by;?>"><?php echo $row->first_name;?> <?php echo $row->last_name;?></a></td><?php } ?>

						<?php if($this->session->userdata('user_type') == 1) { ?>

						<td>

						<input type="checkbox" <?php if($row->default_ads == 1) echo 'checked="checked"';?>  class="default_ads" value="<?php echo $row->tests_id;?>" />

						 <?php  if($row->default_ads == 2) { ?>&nbsp; &nbsp; <a href="<?php echo site_url();?>admin/tests/ads_edit/<?php echo $row->testid;?>/<?php echo $lang; ?>">Edit ads</a><?php } ?>

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
						<?php if($this->session->userdata('user_type') == 1) { ?><td><input type="checkbox" class="featured" <?php if($row->featured == 1) echo 'checked="checked"';?>  value="<?php echo $row->tests_id;?>" /></td><?php } ?>
						

						<td data-title="Action" valign="middle">
							<table width="100%;">
								<tr>
									<td valign="middle" style="width:252px;">
								<?php if($this->session->userdata('user_type') !=4 ) { ?><a href="<?php echo site_url();?>admin/tests/test_edit/<?php echo $row->testid;?>/<?php echo $lang; ?>"><span title="Edit" class="glyphicon glyphicon-pencil"></span> </a> &nbsp; <?php } ?>
	
								<?php if($this->session->userdata('user_type') == 1) { ?><a href="<?php echo site_url();?><?php echo $lang; ?>/<?php echo $row->alias;?>.html" target="_blank"><span title="View" class="glyphicon glyphicon-search"></span></a> &nbsp; <?php } ?>
	
								<a href="<?php echo site_url();?>admin/tests/test_details/<?php echo $row->testid;?>/<?php echo $lang;?>"><span class="glyphicon glyphicon-eye-open" title="Preview"></span></a> &nbsp; 
	
								<?php if($this->session->userdata('user_type') !=4 ) { ?><a href="<?php echo site_url();?>admin/tests/result_option/<?php echo $row->testid;?>/<?php echo $lang; ?>"><span class="glyphicon glyphicon-wrench" title="Result"></span></a> &nbsp; <?php } ?>
	
								<?php if($this->session->userdata('user_type') !=4 ) { ?><a href="<?php echo site_url();?>admin/tests/questions/<?php echo $row->testid;?>/<?php echo $lang; ?>"><span class="glyphicon glyphicon-question-sign" title="Quesitons"></span></a> &nbsp; <?php } ?>
	
								 
	
								<?php if($this->session->userdata('user_type') == 1) { ?><span class="glyphicon glyphicon-camera" style="color:<?php echo $camera_color;?>;"></span> &nbsp;  <?php } ?>
	
								<?php if($this->session->userdata('user_type') == 1) { ?>
	
								<a onclick="javascript: return confirm('Are you sure to delete this?')" href="<?php echo site_url();?>admin/tests/test_delete/<?php echo $row->testid;?>/<?php echo $lang; ?>"> <span title="Delete" class="glyphicon glyphicon-trash"></span></a>  &nbsp; 
	
								<?php } ?>
	
								<span class="glyphicon glyphicon-camera" title="<?php echo $all_image_added_tittle; ?>" style="color:<?php echo $grahic_camera_color;?>;"></span> &nbsp;
	
								<?php if(($this->session->userdata('user_type') == 1) || $this->session->userdata('user_type') == 3) { ?><span class="glyphicon glyphicon-ok-sign" title="<?php echo $all_content_ready_tittle; ?>" style="color:<?php echo $all_content_ready_color;?>;"></span> <?php } ?>
	
								<?php echo $flag_icons;?>
							</td>
							
							<td>
								<div style="width:250px;">
								<?php 
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
												if($language->language_code == 'en')
												{
												?>
													<a class="language_level" href="<?php echo site_url();?>admin/tests/test_edit/<?php echo $row->testid;?>/<?php echo $language->language_code;?>"><span class="label <?php echo $label_class; ?>"><?php echo $language->language_code; ?></span></a>
													&nbsp;
													<?php
													}
													else
													{
													
													?>																						
													 <a class="language_level" href="<?php echo site_url();?>admin/test_manager/edit/<?php echo $row->testid;?>/<?php echo $language->language_code;?>"><span class="label <?php echo $label_class; ?>"><?php echo $language->language_code; ?></span></a>
													&nbsp;
											    <?php 
											 	}
												}
											}
										}
									
								?>
								</div>
							</td>
							</tr>
							</table>					

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

	<script language="javascript" type="text/javascript" >

    $(document).ready(function(){

		<?php if($editor_control) { ?> $('#editor_control').attr('checked','checked');<?php } ?>

		<?php if($graphic_control) { ?> $('#graphic_control').attr('checked','checked');<?php } ?>

		<?php if($default_ads) { ?> $('#default_ads').attr('checked','checked');<?php } ?>

		<?php if($status) { ?> $('#status').attr('checked','checked');<?php } ?>

      // add 30 more rows to the table

      var row = $('table#mytable > tbody > tr:first');

      // make the header fixed on scroll

      $('.table-fixed-header').fixedHeader();

    });

  </script>
  
