	<div class="text-right">
	<form id="sort_form" action="<?php echo site_url();?>admin/tests/simple_list" method="post">
	Sort By : <select name="sort_by" id="sort_by">
		<option value="">Select</option>
		<option value="DESC" <?php if(!empty($_POST['sort_by']) && $_POST['sort_by'] == 'DESC') echo 'selected="selected"';?> >Facebook Like High</option>
		<option value="ASC" <?php if(!empty($_POST['sort_by']) && $_POST['sort_by'] == 'ASC') echo 'selected="selected"';?> >Facebook Like Low</option>
	</select>
	</form>
	</div>
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
						<td data-title="No"><?php echo $i; ?> </td>
						<td data-title="Test Title"><?php echo $row->title;?></td>
						<td><?php echo $flag_icons;?></td>
						<td data-title="Test Title"><?php if($this->session->userdata('user_type') != 2) { ?> <a href="<?php echo site_url();?>admin/tests/simple_list/?user_id=<?php echo $row->created_by;?>"><?php echo $row->username;?></a> <?php } else if($this->session->userdata('user_type') == 2 && $row->created_by == $this->session->userdata('user_id')) echo $row->username; else echo "---";?></td>
						<td data-title="Test Title"><?php echo date('m-d-Y H:i A',strtotime($row->activated_date));?></td>
						<td data-title="Test Title"><?php  echo $row->fb_like;?> </td>
						
					</tr>
					<?php
					}
				}
			?>
		</tbody>
	</table>

	</div>
<script language="javascript">
	$(document).ready(function() {
		
			$(document).on('change','#sort_by',function() {
				//var order=$(this).val();
				//alert(order);
				$('#sort_form').submit();
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