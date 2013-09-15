<!DOCTYPE html>
<html lang="en">
	<?php
		include_once('header.php');
	?>
	
	<body>
		<div class="container">
			<p>
				<h2>Organization added successfully!!<h2>
				<table class="table table-bordered" width="600">
					<tr class="active">
						<td width="150"><h4>Organization Name</h4></td>
						<td width="150"><h4>Address</h4></td>
						<td width="100"><h4>Telephone Number</h4></td>
						<td width="150"><h4>Email Address</h4></td>
						<td width="50"><h4>Members</h4></td>
					</tr>
					<?php 
						$cnt = 0;
						foreach($organizations as $organization){ 
					?>
					<tr 
					<?php 
						if($cnt%2 == 0){
						?>
						class="success"
						<?php
						} 
						else{ 
						?>
						class="warning"
						<?php 
						} 
					?>>
						<td width="150"><?php echo $organization->name;?></td>
						<td width="150"><?php echo $organization->address;?></td>
						<td width="100"><?php echo $organization->telephone;?></td>
						<td width="150"><?php echo $organization->email;?></td>
						<td width="50"><a href="/organization/<?php echo $organization->id;?>/members/view">View Members</a></td>
					</tr>
					<?php 
						$cnt++;
					} ?>				
				</table>
				   
			</p>
			<p></p>
				<a href="/organization/<?php echo $current_org->id;?>/subscribe/courses"><h4>Add Courses</h4></a>
			<hr>

      		<?php 
        		include_once('footer.php');
      		?>
      	</div>
	</body>
</html>