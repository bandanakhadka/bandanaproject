<!DOCTYPE html>
<html lang="en">
	<?php
		include_once('header.php');
	?>
	<body>
		<div class="container">
		    <form class="form-signin" method="post">
		    	<h2 class="form-signin-heading">Add New Organization</h2>

			    <p>
			        <input type="text" class="form-control" placeholder="Name" name="org_name" autofocus>
			    </p>
			 
			 	<p>
			        <input type="text" class="form-control" placeholder="Address" name="address">
			    </p>

				<p>
			        <input type="text" class="form-control" placeholder="Telephone Number" name="telephone">
			    </p>

			    <p>
			        <input type="text" class="form-control" placeholder="E-mail" name="email">
			    </p>
			 
			    <p>
			    	<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Add Organization</button>
			    </p>	 
		    </form>

		    <hr>

		    <?php 
		        include_once('footer.php');
		    ?>	 
		</div>	 
	</body>
</html>