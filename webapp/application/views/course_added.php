Course added successfully!!

<!DOCTYPE html>
	<html lang="en">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <title>Courses</title>
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

	<div id="course">

		<p>
			<table width="700">
				<tr>
					<td width="150"><h4>Course Name</h4></td>
					<td width="150"><h4>Course Code</h4></td>
					<td width="100"><h4>Duration in Hrs.</h4></td>
					<td width="150"><h4>Category</h4></td>
					<td width="150"><h4>Organization Name</h4></td>
				</tr>
				<?php foreach($courses as $course)
				{  ?>
				<tr>
					<td width="150"><?php echo $course->course_name;?></td>
					<td width="150"><?php echo $course->course_code;?></td>
					<td width="100"><?php echo $course->duration_in_hrs;?></td>
					<td width="150"><?php echo $course->category;?></td>
					<td width="150"><?php echo $course->organization->name;?></td>
				</tr>
				<?php } ?>				
			</table>
			   
		</p>
				
	</div>
	</body>
	</html>