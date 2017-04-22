<?php
class layout{

    public static function blogPost(){
		
        echo <<<BlogPost
		
                
                <p class="lead">
by <a href="C:/xampp/htdocs/CSC206_Green/public/index.php">Samuel C. Green</a>
                </p>
         
                <hr>
				<a href="#"><img src="images/logo.bmp" alt=""></a>
BlogPost;

    }

	
	
	public static function pageSide()
    {
		echo <<<SideStuff
		
		
		
		
		<!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>The DevLeak Mission</h4>
                    <div class="input-group">
                        
                    <p>Welcome to Devleak! Our mission is to document the struggles and goals of our game developers at Orb Games Inc in order to shed light on 
					the joys and hardships of video game testing and developement. If you are interesting in becoming a blogger for our site, use the sign up tab and share your thoughts.</p> 
                                
                     
                    </div>
                    <!-- /.input-group -->
                </div>
				
                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Options</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="createUser.php">Sign Up</a>
                                </li>
                                <li><a href="loginPage.php">Login</a>
                                </li>
                                <li><a href="deleteUser.php">Delete Account</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
				
                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Did You Know?</h4>
                    <p>Game design was invented in 1958, when the first game called Tennis for Two was completely ignored because it wasn't created by a neck-beard. about 15 years later, Pong came out and didn't have a scoring system.</p>
                </div>
            </div>
        </div>
				
			<!-- /.row -->

        <hr>
		
SideStuff;
	}
		
    public static function pageTop()
    {
		$nameTag = "";
		if (isset($_SESSION["users"])) {$nameTag ='Hello, ' . $_SESSION["users"]['firstName'] . '!';}

        echo <<<PageTop
<html lang="en">
<div class ="page">
			<head>

			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="description" content="">
			<meta name="author" content="">

			<title>DevLeak</title>

			<!-- Bootstrap Core CSS -->
			<link href="css/bootstrap.min.css" rel="stylesheet">

				<!-- Custom CSS -->
				<link href="css/blog-home.css" rel="stylesheet">
			</head>
<body>



    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				
                <a class="navbar-brand" href="index.php">Home</a>
				<a class="navbar-brand" href="createPost.php">Post</a>
				<a class="navbar-brand" href="tablePage.php">Pages</a>
				
				
				
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    
                </ul>
				<a class="navbar-brand" href="createUser.php">Sign Up</a>
				
				<a class="navbar-brand" href="loginPage.php">Login</a>
				<a class="navbar-brand" href="logout.php">logout</a>
				<h2>$nameTag</h2>
				
				
            </div>
			
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    [DevLeak]
                    <small>The Documented Struggle</small>
                </h1>
				<h2>
                    <a href="index.php"><img src="images/BlogHeaderGraphic.bmp" alt=""></a>
                </h2>
				
PageTop;
    }

    public static function pageBottom()
    {

        echo <<<PageBottom

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; - DevLeak 2017 - [Call number: (619) 306-9764 ] - Orb Games inc.</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>

    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
</div>
</html>

PageBottom;
    }
}