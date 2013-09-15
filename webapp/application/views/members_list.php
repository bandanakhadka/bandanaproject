<!DOCTYPE html>
<html lang="en">
	<?php
    	include_once('header.php');
  	?>

  	<body>

    	<div class="container">
			<p>
				<h2>List of Members<h2>
				<table class="table table-bordered">
					<tr class="active">
						<td><h4>First Name</h4></td>
						<td><h4>Last Name</h4></td>
						<td><h4>Gender</h4></td>
						<td><h4>Address</h4></td>
						<td><h4>Email</h4></td>
					</tr>
					<?php $cnt = 0;
						foreach($members as $member)
					{  ?>
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
						<td><?php echo $member->first_name;?></td>
						<td><?php echo $member->last_name;?></td>
						<td><?php echo $member->sex;?></td>
						<td><?php echo $member->address;?></td>
						<td><?php echo $member->email;?></td>
					</tr>
					<?php 
						$cnt++;
					} ?>				
				</table>				   
			</p>

			<hr>

      		<?php 
        		include_once('footer.php');
      		?>				
		</div>
	</body>
</html>