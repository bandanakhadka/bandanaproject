<!DOCTYPE html>
	<html lang="en">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <title>Dashboard</title>
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

			if($this->session->flashdata('logout'))
			{
				echo $this->session->flashdata('logout');
			}
		?>

	<div id="dashboard">

	    <p class="heading"><h4>Welcome!</h4></p>

		<p>
			<?php echo "First Name: ".$member->first_name; ?>
		</p>

		<p>
			<?php echo "Last Name: ".$member->last_name; ?>
		</p>

		<p>
			<?php echo "Sex: ".$member->sex;  ?>
		</p>

		<p>
			<?php echo "Address: ".$member->address; ?>
		</p>

		<p>
			<?php echo "Contact: ".$member->contact_number; ?>
		</p>

		<p>
			<?php echo "Email: ".$member->email;?>
		</p>

		<p>
			<?php echo "Organization: ".$member->organization->name;?>
		</p>

		<p>
			<?php echo "Courses Enrolled: ";
			foreach ($courses as $course)
			{
				echo $course->course_name." ";
			}
			?>
		</p>

		<p>
			<a href="dashboard/enroll_course"><h3>Enroll in a Course</h3></a>
		</p>

		<p>
			<a href="dashboard/unenroll"><h3>UnEnroll a Course</h3></a>
		</p>		
	
		<p></p>

		<p>
			<a href="../login/logout"><h3>Log out</h3></a>
		</p>

	</div>
	</body>
	</html>
