<!DOCTYPE html>
<html lang="en">
	<?php
    	include_once('header.php');
  	?>

  	<body>

    	<div class="container">
			<p>
				<h2>Course added successfully!!<h2>
				<table class="table table-bordered" width="550">
					<tr class="active">
						<td width="150"><h4>Course Name</h4></td>
						<td width="150"><h4>Course Code</h4></td>
						<td width="100"><h4>Duration in Hrs.</h4></td>
						<td width="150"><h4>Category</h4></td>
					</tr>
					<?php $cnt = 0;
						foreach($courses as $course)
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
						<td width="150"><?php echo $course->course_name;?></td>
						<td width="150"><?php echo $course->course_code;?></td>
						<td width="100"><?php echo $course->duration_in_hrs;?></td>
						<td width="150"><?php echo $course->category;?></td>
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