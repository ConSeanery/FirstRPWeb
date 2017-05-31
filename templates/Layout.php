<?php

	 

class layout{
	
	
	public static function pageSide()
    {
		
		 
		
		
		echo <<<SideStuff
		
		
		<!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
			
		
				<div class="well">
				<form action="searchResultPage.php" method="GET">
					<div class="searchBar"><input type="text" name="query" placeholder="Search...">
					<input type="submit" name="submit" value="Search">
					</div>
				</form>
					</div>

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>About</h4>
                    <div class="input-group">
                        
                    <p>First Reformed Presbyterian Church of Beaver Falls 
					is comprised of people who hunger to explore God's Word,
					are excited to worship, eager to welcome visitors and new believers,
					and committed to being a witness for Christ in their community and world.</p> 
                                
                     
                    </div>
					
                </div>
				
				
				<div class="well">
                    <h4>Location</h4>
                    <div class="input-group">
                    <div class= "imageLink">    
                    <a href="https://www.google.com/maps/place/First+Reformed+Presbyterian/@40.7428695,-80
					.333732,15z/data=!4m5!3m4!1s0x0:0x69fc3ae743168634!8m2!3d40.7428695!4d-80.333732">
					<img src="images/locationMap.png" height="160" width = "320"></a>
                    </div>          
                     
                    </div>
					
                </div>
				
				
                
				
                
		
SideStuff;
	
		 if (isset($_SESSION["users"])){
		 echo <<<SideOptions
		 <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Options</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                            
                                <li><a href="logout.php">Logout</a>
                                </li>
								 <li><a href="createPost.php">Post Event</a>
                                </li>
                                <li><a href="deleteUser.php">Delete Account</a>
                                </li>
								<li><a href="createAudio.php">Post Sermon</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
SideOptions;
	}}
    public static function pageTop()
    {
		$nameTag = "";
		if (isset($_SESSION["users"])) {$nameTag ='<p>Hello, ' . $_SESSION["users"]['firstName'] . '!</p>';}

        echo <<<PageTop
<html lang="en">
<div class ="page">
			<head>

			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="description" content="">
			<meta name="author" content="">

			<title>FirstRP.com</title>

			<!-- Bootstrap Core CSS -->
			<link href="css/bootstrap.min.css" rel="stylesheet">

				<!-- Custom CSS -->
				<link href="css/blog-home.css" rel="stylesheet">
			</head>
<body>



    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"><a class="navbarMan" href="https://www.facebook.com/firstrpchurch/"><img src="images/facebook-icon.png" width="40" height="40"></a></span>
                    <span class="icon-bar"><a class="navbarMan" href="index.php"><img src="images/youtube-icon.png" width="40" height="40"></a></span>
                    <span class="icon-bar"></span>
                </button>
				
                <a class="navbarMan" href="index.php">Home</a>
				<a class="navbarMan" href="calendar.php">Calendar</a>
				<a class="navbarMan" href="tablePage.php">Events</a>
				<a class="navbarMan" href="audioPage.php">Sermons</a>
				
				
				
				
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                
				
				<div class="nameTag">
				$nameTag
				</div>
				
            </div>
			
            <!-- /.navbar-collapse -->
        
        <!-- /.container -->
    </nav>

<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
		

                <h1 class="page-header" font="ariel">
                    First Reformed Presbyterian Church
                    <small></small>
                </h1>
				<div class="frontImage">
				<h2>
                    <a href="index.php"><img src="images/HeaderTop.jpg" alt="" width="700" height="425"></a>
                </h2>
				</div>
				
PageTop;
    }

    public static function pageBottom()
    {

        echo <<<PageBottom

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <a href="loginPage.php">Admin login</a>
					<a class="navbarMan" href="https://www.facebook.com/firstrpchurch/"><img src="images/facebook-icon.png" width="40" height="40"></a>
				<a class="navbarMan" href="index.php"><img src="images/youtube-icon.png" width="40" height="40"></a>
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