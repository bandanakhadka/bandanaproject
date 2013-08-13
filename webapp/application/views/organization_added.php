<!DOCTYPE html>
	<html lang="en">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <title>Organizations</title>
	</head>
	<body>
		<?php 
			if($this->session->flashdata('error'))
			{
				echo $this->session->flashdata('error');
			}

			if($this->session->flashdata('success'))
			{
				echo $this->session->flashdata('success');
			}
		?>

	<div id="organization">

		<p>
			<table width="600">
				<tr>
					<td width="150"><h4>Organization Name</h4></td>
					<td width="150"><h4>Address</h4></td>
					<td width="100"><h4>Telephone Number</h4></td>
					<td width="150"><h4>Email Address</h4></td>
					<td width="50"><h4>Members</h4></td>
				</tr>
				<?php foreach($organizations as $organization){  ?>
				<tr>
					<td width="150"><?php echo $organization->name;?></td>
					<td width="150"><?php echo $organization->address;?></td>
					<td width="100"><?php echo $organization->telephone;?></td>
					<td width="150"><?php echo $organization->email;?></td>
					<td width="50"><a href="organizations/view_members/<?php echo $organization->id;?>">View Members</a></td>
				</tr>
				<?php } ?>				
			</table>
			   
		</p>
		
		
	</div>
	<p></p>
		<a href="organizations/add_courses/<?php echo $current_org->id;?>"><h4>Add Courses</h4></a>
	</body>
	</html>