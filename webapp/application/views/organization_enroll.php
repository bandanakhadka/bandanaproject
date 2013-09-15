<!DOCTYPE html>
<html lang="en">
  <?php
    include_once('header.php');
  ?>

  <body>

    <div class="container">
		<form class="form-signin" method="post">
        	<h2 class="form-signin-heading">Select Courses</h2>
        	<h2></h2>
			<p>
		    	<?php foreach($courses as $course){  ?>
		    	<h4><input class="form-contol" type="checkbox" name="checklist[]" value="<?php echo $course->id;?>"> <?php echo $course->course_name;?></h4><br>
				<?php } ?>
				<br>
				<?php 
				if($flag==0)
					{ ?>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Add</button>
				<?php 
				}
				elseif($flag==1)
					{ ?>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Deactivate</button>
				<?php
				}
				elseif($flag==2) 
					{ ?>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Activate</button>
				<?php } 
				else 
					{ ?>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Delete</button>
				<?php } ?>
			</p>
		</form>

		<hr>

		<?php 
		    include_once('footer.php');
		?>
	</div>
		
   </body>
</html>