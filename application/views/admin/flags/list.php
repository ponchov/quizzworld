
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
	<div class="row">
		<a href="<?php echo site_url();?>admin/flags/add"><button class="btn pull-right btn-primary" type="button">+Add new</button></a>
	</div>

	<div class="clear_space" style="height:10px;"></div>
	<div class="row">
	<table id="no-more-tables" class="table table-striped table-hover"> 
		<thead>
			<tr>
			<th> # </th>
			<th>Flag Name</th>
			<th> Action </th>
			</tr>
		</thead>
		<tbody>
			<?php
				if($flag_list)
				{	
					$i=0;
					foreach($flag_list as $row)
					{
						$i++;
					?>
					<tr>
						<td data-title="No"><?php echo $i; ?> </td>
						<td data-title="Category Name"><?php echo $row->flag;?></td>						
						<td data-title="Action">
							<a href="<?php echo site_url();?>admin/flags/edit/<?php echo $row->flag_id;?>">Edit</a> &nbsp; &nbsp;
							<a onclick="javascript: return confirm('Are you sure to delete this?')" href="<?php echo site_url();?>admin/flags/delete/<?php echo $row->flag_id;?>"> Delete</a>  &nbsp; &nbsp;
							
						</td>
						
					</tr>
					<?php
					}
				}
			?>
		</tbody>
	</table>

</div>

