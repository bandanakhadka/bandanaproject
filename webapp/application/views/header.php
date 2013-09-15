<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Olive Media Project</title>

    <!-- Bootstrap core CSS -->
    <link href="/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/css/bootstrap.css" rel="stylesheet">

    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="/public/css/offcanvas.css" rel="stylesheet">
    </head>

    <body>

    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/indexpage">Bandana Project</a>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/indexpage">Home</a></li>
                    <li><a href="/organizations">Organization</a></li>
                    <li><a href="/courses">Course</a></li>
                    <li><a href="#">Book</a></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="/organizations">Add Organization</a></li>
                        <li><a href="/courses">Add Course</a></li>
                        <li><a href="#">Add Book</a></li>
                      </ul>
                    </li>
                </ul>
            </div><!-- /.nav-collapse -->
        </div><!--/.container -->
    </div><!-- /.navbar -->

    <div class="container">
        <?php
            if(isset($message))
            {
                echo '<div class="alert alert-danger">'.$message.'</div>';
            }

            if($this->session->flashdata('error'))
            {?>
                <h3><?php echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>'; ?></h3>
            <?php }

            if($this->session->flashdata('success'))
            { ?>
                <h3><?php echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>'; ?></h3>
            <?php }

            if($this->session->flashdata('logout'))
            { ?>
                <h3><?php echo '<div class="alert alert-danger">'.$this->session->flashdata('logout').'</div>'; ?></h3>
            <?php }
        ?>
    </div>

