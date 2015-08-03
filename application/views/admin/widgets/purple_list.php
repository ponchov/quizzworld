

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

	

	?>




	<div class="clear_space" style="height:10px;"></div>

	<div class="row">

	<table id="no-more-tables" class="table table-striped table-hover"> 
		<thead>
			<tr>
			<th style="width:25px;"> # </th>
			<th>Widget Name</th>
			<th> Action </th>
			<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if($purple_widgets)
				{	
					$i=0;
					foreach($purple_widgets as $row)
					{
						$i++;
					?>
					<tr>
						<td data-title="No"><?php echo $i; ?> </td>
						<td>Purple Widgets</td>						
						<td data-title="Action">
							<a href="<?php echo site_url();?>admin/widgets/purple_edit/<?php echo $row->purple_widget_id;?>">Edit</a> &nbsp; &nbsp;
						</td>
						<td>
							<?php
							if($this->session->userdata('access_language')) $access_language=explode(',',$this->session->userdata('access_language'));
							else $access_language=array();
							
							if($language_list)
							{
								foreach($language_list as $language)
								{
									$language_content=$this->widget_model->purple_widget_content($row->purple_widgetid, $language->language_code);									
									if($language_content->purple_widget_id > 0) $label_class="label-info"; else $label_class="label-default";
									if(in_array($language->language_code,$access_language))
									{
								?>																						
									 <a class="language_level" href="<?php echo site_url();?>admin/widgets/purple_widget_content/<?php echo $row->purple_widgetid;?>/<?php echo $language->language_code;?>"><span class="label <?php echo $label_class; ?>"><?php echo $language->language_code; ?></span></a>
									&nbsp;
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

</div>



