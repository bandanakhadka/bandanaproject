<!DOCTYPE html>
<html lang="en">
  <?php
    include_once('header.php');
  ?>

  <body>

    <div class="container">
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Sign in</h2>
        <p>
          <input type="text" class="form-control" placeholder="Username" name="user_name" autofocus>
        </p>
        <p>
          <input type="password" class="form-control" placeholder="Password" name="password">
        </p>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Log in</button>
      </form>

      <hr>

      <?php 
        include_once('footer.php');
      ?>

    </div> <!-- /container -->
  </body>
</html>
