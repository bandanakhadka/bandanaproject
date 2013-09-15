<!DOCTYPE html>
<html lang="en">
<?php 
  include_once('header.php');
?>

  <body>
    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>

          <div class="jumbotron">
            <h1>Olive Media</h1>
            <p>Olive Media specialises in offering training solutions to meet your organisational goals to maximise employee performance and achieve long term business success. It is a global provider of technology enabled learning solutions and services.</p>  
          </div>

          <div class="jumbotron">
            <a data-toggle="modal" href="/signup" class="btn btn-primary btn-lg">New Member Signup</a>            
          </div>

          <div class="row">
            <div class="col-6 col-sm-6 col-lg-4">
              <h2>Organizations</h2>
              <p> </p>
              <p><a class="btn btn-default" href="/organizations">Add New Organization &raquo;</a></p>
            </div><!--/span-->
            <div class="col-6 col-sm-6 col-lg-4">
              <h2>Courses</h2>
              <p> </p>
              <p><a class="btn btn-default" href="/courses">Add New Course &raquo;</a></p>
            </div><!--/span-->
            <div class="col-6 col-sm-6 col-lg-4">
              <h2>Books</h2>
              <p> </p>
              <p><a class="btn btn-default" href="#">Add New Book &raquo;</a></p>
            </div><!--/span-->
          
          </div><!--/row-->
        </div><!--/span-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="well sidebar-nav">
            <ul class="nav">
                <form class="form-signin" action="login" method="post">
                  <h2 class="form-signin-heading">Sign in</h2>
                  <p>
                    <input type="text" class="form-control" placeholder="Username" name="user_name" autofocus>
                  </p>
                  <p>
                    <input type="password" class="form-control" placeholder="Password" name="password">
                  </p>
                  <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Log in</button>
                </form>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
      </div><!--/row-->

      <hr>
      <?php 
        include_once('footer.php');
      ?>
    </div><!--/.container-->
  </body>
</html>
