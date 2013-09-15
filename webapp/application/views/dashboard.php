<!DOCTYPE html>
<html lang="en">
	<?php
    	include_once('header-1.php');
  	?>
		<div class="container">
			<h2></h2>

			<table class="table table-bordered">
				<tr class="success">
					<td>First Name</td>
					<td><?php echo $current_member->first_name; ?></td>
				</tr>
				<tr class="warning">
					<td>Last Name</td>
					<td><?php echo $current_member->last_name; ?></td>
				</tr>
				<tr class="success">
					<td>Gender</td>
					<td><?php echo $current_member->sex; ?></td>
				</tr>
				<tr class="warning">
					<td>Address</td>
					<td><?php echo $current_member->address; ?></td>
				</tr>
				<tr class="success">
					<td>Contact</td>
					<td><?php echo $current_member->contact_number; ?></td>
				</tr>
				<tr class="warning">
					<td>Email</td>
					<td><?php echo $current_member->email;?></td>
				</tr>
				<tr class="success">
					<td>Organization</td>
					<td><?php echo $current_organization->name;?></td>
				</tr>
				<tr class="warning">
					<td>Courses Enrolled</td>
					<td>
						<?php 
							$i = 1;
							foreach ($courses as $course)
							{
								echo $i.". ".$course->course_name."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								$i++;
							}
						?>
					</td>
				</tr>
			</table>
			<h2></h2>

			<p>
				<a href="/goto/my/dashboard/enroll/course"><h4>Enroll in a Course</h4></a>
			</p>

			<p>
				<a href="/goto/my/dashboard/unenroll/course"><h4>Unenroll an enrolled Course</h4></a>
			</p>

			<p>
				<a href="/goto/my/dashboard/deactivate/course"><h4>Deactivate a Course</h4></a>
			</p>

			<p>
				<a href="/goto/my/dashboard/activate/course"><h4>Activate a deactivated Course</h4></a>
			</p>		
			<h1></h1>

			<p>
				<a href="/login/logged_out"><h3>Log out</h3></a>
			</p>

			<hr>

		    <?php 
		        include_once('footer.php');
		    ?>
		</div>
	</body>
</html>
