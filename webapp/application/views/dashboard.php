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
			<?php echo "First Name: ".$current_member->first_name; ?>
		</p>

		<p>
			<?php echo "Last Name: ".$current_member->last_name; ?>
		</p>

		<p>
			<?php echo "Sex: ".$current_member->sex;  ?>
		</p>

		<p>
			<?php echo "Address: ".$current_member->address; ?>
		</p>

		<p>
			<?php echo "Contact: ".$current_member->contact_number; ?>
		</p>

		<p>
			<?php echo "Email: ".$current_member->email;?>
		</p>

		<p>
			<?php echo "Organization: ".$current_organization->name;?>
		</p>

		<p>
			<?php echo "Courses Enrolled: &nbsp;&nbsp;";
			$i = 1;
			foreach ($courses as $course)
			{
				echo $i.". ".$course->course_name."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				$i++;
			}
			?>
		</p>

		<p>
			<a href="dashboard/enroll/course"><h3>Enroll in a Course</h3></a>
		</p>

		<p>
			<a href="dashboard/unenroll/course"><h3>Unenroll an enrolled Course</h3></a>
		</p>

		<p>
			<a href="dashboard/deactivate/course"><h3>Deactivate a Course</h3></a>
		</p>

		<p>
			<a href="dashboard/activate/course"><h3>Activate a deactivated Course</h3></a>
		</p>		
	
		<p></p>

		<p>
			<a href="../../../login/logged_out"><h3>Log out</h3></a>
		</p>

	</div>
	</body>
	</html>
