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
	<table id="mytable" class="table table-striped table-hover table-fixed-header"> 
		<thead class="header">
			<tr>
			<th> # </th>
			<th>Name</th>
			<th> Email </th>			
			<th> Status </th>
			<th> Action </th>
			</tr>
		</thead>
		<tbody>
			<?php
				if($contact_user_list)
				{	
					$i=0;
					foreach($contact_user_list as $row)
					{
						$i++;
					?>
					<tr>
						<td data-title="No"><?php echo $i; ?> </td>
						<td data-title="Name"><?php echo $row->name;?></td>						
						<td data-title="Email"><?php echo $row->email;?></td>						
						<td data-title="Status">
							<?php 
								if($row->status == 1) echo "Active"; else echo "Inactive";
							?>
						</td>
						<td data-title="Action">
							<a href="<?php echo site_url();?>admin/contact_user/view_contact_user/<?php echo $row->contact_us_user_id;?>">View</a> &nbsp; &nbsp;
							<a href="<?php echo site_url();?>admin/contact_user/contact_user_edit/<?php echo $row->contact_us_user_id;?>">Edit</a> &nbsp; &nbsp;
							<a onclick="javascript: return confirm('Are you sure to delete this?')" href="<?php echo site_url();?>admin/contact_user/contact_user_delete/<?php echo $row->contact_us_user_id;?>"> Delete</a> 
							
						</td>
						
					</tr>
					<?php
					}
				}
			?>
		</tbody>
	</table>

</div>

<script language="javascript" type="text/javascript" >
    $(document).ready(function(){
      // add 30 more rows to the table
      var row = $('table#mytable > tbody > tr:first');
      //var row2 = $('table#mytable2 > tbody > tr:first');
      /*for (i=0; i<30; i++) {
        $('table#mytable > tbody').append(row.clone());
        //$('table#mytable2 > tbody').append(row2.clone());
      }*/

      // make the header fixed on scroll
      $('.table-fixed-header').fixedHeader();
    });
  </script>