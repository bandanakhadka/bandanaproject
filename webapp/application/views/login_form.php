<!DOCTYPE html>
	<html lang="en">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <title>Login Form</title>
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
	 
	<div id="login_form">
	 
	   	<p class="heading"><h4>User Login</h4></p>

	    <form method='post'>
	 
		    <p>
		        <label for="user_name">Username: </label>
		        <input type="text" name="user_name">
		    </p>

		    <p>
		        <label for="password">Password: </label>
		        <input type="password" name="password">
		    </p>
		
		    <p>
		        <input type="submit" name="submit" value="Login">
		    </p>
	 
	    </form>
	 
	</div>
	 
	</body>
	</html>