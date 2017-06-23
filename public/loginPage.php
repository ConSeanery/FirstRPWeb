<?php
// Load all application files and configurations
require($_SERVER[ 'DOCUMENT_ROOT' ] . '/../includes/application_includes.php');
require_once(FS_TEMPLATES . 'Layout.php');
require_once(FS_TEMPLATES . 'listPost.php');
require_once(FS_TEMPLATES . 'News.php');

// Connect to the database
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Get the stories for column 1 from the database
$sql2 = 'select * from audio ORDER BY id DESC limit 12';



$sermons = $db->query($sql2);
// Run a simple query that will be rendered in column 2 below
$sql2 = 'select id, title, url from audio';
$res = $db->query($sql2);

Layout::pageTop('Csc206 Project');
?>

<div class="container top25">
   
        <section class="content">

            <?php
            if ( $requestType == 'GET' ) {		
				showForm();          
			}
			 elseif ( $requestType == 'POST' ) {
				$input = $_POST;
				//print_r($input);
				$userName = $_POST['email'];
                $password = $_POST['password'];	
				$sql = "select * from users where email = '" . $input['email'] . "'";
				$result = $db->query($sql);
				
				
				if (!$result->size() == 0){	
				$user = $result->fetch();				
				if (password_verify($input['password'], $user['password'])){
					$_SESSION["users"] = $user;	
					//session_start();
					echo <<<GoodKid
				<h1>You are now logged in.</h1>
GoodKid;
				header("Location: index.php");
				}else{echo '<h1>You entered a wrong username/password combination.</h1>'; showForm(); }}}
            	
               function showForm($data = null)
			{
				
				
               echo <<<postform
    <form id="GetUserLogin" action='loginPage.php' method="POST" class="form-horizontal">
        <fieldset>
    
            <!-- Form Name -->
            <legend>Login</legend>
    
            
    
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-3 control-label" for="email">Username</label>
                <div class="col-md-8">
                    <input id="email" name="email" type="text" placeholder="Username" class="form-control input-md">
                </div>
            </div>
			
			
			<!-- Text input-->
            <div class="form-group">
                <label class="col-md-3 control-label" for="password">Password</label>
                <div class="col-md-8">
                    <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md">
                </div>
            </div>
    
    
            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-3 control-label" for="submit"></label>
                <div class="col-md-8">
                    <button id="submit" name="submit" value="Submit" class="btn btn-success" >Submit</button>
                </div>
            </div>
    
        </fieldset>
    </form>
postform;
            
			}
            ?>


        </section>
    </div>
</div>

<?php
		layout::pageSide('Csc206 Project');	
		echo <<<yes
		<!-- Side Widget Well -->
		<div class="col-md-4">
                <div class="well">
                    <h4>Audio Sermons</h4>
yes;
					
while ($sermon = $sermons->fetch()) {
         // Call the method to create the layout for a post
          News::sermon($sermon);
		   
     }		 
	 
	 echo <<<end
					
                </div>
            </div>
        </div>
				
			<!-- /.row -->

        <hr>
end;
?>


<?php
// Generate the page footer
Layout::pageBottom();
?>