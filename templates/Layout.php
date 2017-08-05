<?php

	 

class layout{
	
	
	public static function pageSide()
    {

	
	if (isset($_SESSION["users"])){
		 echo <<<SideOptions
		 
		 <!-- Blog Categories Well -->
		 <div class="col-md-4">
                <div class="well">
                    <h4>Admin Tools</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="audioLinks">
                                <a href="logout.php">Logout</a>
                             </div>  
							 <div class="audioLinks">
								 <a href="createPost.php">Post Event</a></div>
                              <div class="audioLinks">  
								<a href="createAudio.php">Post Sermon</a></div>  
							</div>								
                        
                  	  </div>
                </div>
			</div>
			
			
			
                    <!-- /.row -->
                
SideOptions;
	}
	
	
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
                    <h4>Vacation Bible School</h4>
                    <div class="input-group">
                        
                    <p>(Put VBS link here)</p> 
                                           
                    </div>
                </div>
				<div class="well">
                    <h4>Location</h4>
                    <div class="input-group">
                    <div class= "imageLink">    
                    <a href="https://www.google.com/maps/place/First+Reformed+Presbyterian/@40.7428695,-80
					.333732,15z/data=!4m5!3m4!1s0x0:0x69fc3ae743168634!8m2!3d40.7428695!4d-80.333732">
					<img src="images/locationMap.png" ></a>
                    </div>          
                     
                    </div>
					
                </div>
				
				
            </div>    
		
SideStuff;


	
		 }
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
    </nav>

<!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
				<div class="frontImage">
				<div class="invisible-header">
			<p> First Reformed Presbyterian Church</p>
			</div>
			<div class="page-header">
			<p> First Reformed Presbyterian Church</p>
			</div>
				<h2>
                 
					<div class="slideshow-container">
	<div class="mySlides fade">
    <div class="numbertext">2 / 3</div>
    <img src="images/HeaderFirstRP.jpg" alt="" >
    <div class="text"></div>
  </div>
  
  <div class="mySlides fade">
    <div class="numbertext">1 / 3</div>
    <img src="images/HeaderTop.jpg" alt="" >
    <div class="text"></div>
  </div>

  <div class="mySlides fade">
    <div class="numbertext">3 / 3</div>
    <img src="images/HeaderTop.jpg" alt="">
    <div class="text"></div>
  </div>
  
  
	 <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>
</div>  

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>
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
                    
				<a class="navbarMan" href="https://www.facebook.com/firstrpchurch/"><img src="images/facebook-icon.png" width="40" height="40"></a>
				<a class="navbarMan" href="index.php"><img src="images/youtube-icon.png" width="40" height="40"></a>
				<a class="navbarMan" href="loginPage.php"><img src="images/settings-icon.jpg" width="40" height="40"></a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>

    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
	<script src="js/slides.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
</div>
</html>

PageBottom;
    }
}