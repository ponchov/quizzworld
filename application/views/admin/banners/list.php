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
		<a href="<?php echo site_url();?>admin/banners/add"><button class="btn pull-right btn-primary" type="button">+Add new</button></a>
	</div>
	<div class="clear_space" style="height:10px;"></div>
	<div class="row">
	<table id="mytable" class="table table-striped table-hover table-fixed-header"> 
		<thead class="header">
			<tr>
				<th> # </th>
				<th>Template</th>
				<th>Title</th>				
				<th>Image</th>
				<th>Brand Title</th>
				<th>Status</th>
				<th> Action </th>
			</tr>
		</thead>

		<tbody>

			<?php
				if($banner_list)
				{	
					$i=0;
					foreach($banner_list as $row)
					{
						$i++;						
					?>
					<tr>
						<td><?php echo $i; ?> </td>
						<td><?php echo  ucfirst(str_replace("_"," ",$row->template)); ?> </td>
						<td><?php echo $row->title;?> </td>
						<td><img src="<?php echo base_url(); ?>/<?php echo $row->image;?>" style="height:60px; width:auto;" /> </td>
						<td><?php echo $row->brand_title;?></td>	
						<td>
							<?php 
								if($row->status == 1) echo "Active"; else echo "Inactive";
							?>
						</td>

						<td>
							<a href="<?php echo site_url();?>admin/banners/edit/<?php echo $row->banner_id;?>">Edit</a> &nbsp; &nbsp;							
							<a onclick="javascript: return confirm('Are you sure to delete this?')" href="<?php echo site_url();?>admin/banners/delete/<?php echo $row->banner_id;?>"> Delete</a>  &nbsp; &nbsp;
							<?php 
								if($this->session->userdata('access_language')) $access_language=explode(',',$this->session->userdata('access_language'));
								else $access_language=array();								
							
								if($language_list)
								{
									foreach($language_list as $language)
									{
										$label_class="label-default";
										if(in_array($language->language_code,$access_language))
										{
									?>																						
										 <a class="language_level" href=""><span class="label <?php echo $label_class; ?>"><?php echo $language->language_code; ?></span></a>
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