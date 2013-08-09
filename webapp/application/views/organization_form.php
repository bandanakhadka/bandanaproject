<!DOCTYPE html>
	<html lang="en">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <title>Organization Signup Form</title>
	</head>
	<body>
		<?php
			if(isset($message))
			{
				echo $message;
			}

			if($this->session->flashdata('error'))
			{
				echo $this->session->flashdata('error');
			}

			if($this->session->flashdata('success'))
			{
				echo $this->session->flashdata('success');
			}
		?>

	<div id="signup_form">
	 
	    <p class="heading"><h4>Add New Organization</h4></p>

	    <form method="post">

		    <p>
		        <label for="org_name">Organization Name: </label>
		        <input type="text" name="org_name">
		    </p>
		 
		 	<p>
		        <label for="address">Address: </label>
		        <input type="text" name="address">
		    </p>

			<p>
		        <label for="telephone">Telephone Number: </label>
		        <input type="text" name="telephone">
		    </p>

		    <p>
		        <label for="email">E-mail: </label>
		        <input type="email" name="email">
		    </p>
		 
		    <p>
		    	<input type="submit" name="submit" value="Add Organization">
		    </p>
	 
	    </form>
	 
	</div>
	 
	</body>
	</html>