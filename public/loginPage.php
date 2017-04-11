<?php
// Load all application files and configurations
require($_SERVER[ 'DOCUMENT_ROOT' ] . '/../includes/application_includes.php');
// Include the HTML layout class
require_once(FS_TEMPLATES . 'Layout.php');
// Connect to the database
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Initialize variables
$requestType = $_SERVER[ 'REQUEST_METHOD' ];
// Generate the HTML for the top of the page
Layout::pageTop('CSC206 Project');
?>

<div class="container top25">
    <div class="col-md-8">
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
				}else{echo '<h1>You entered a wrong username/password combination.</h1>';}}}
            	
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
                    <button id="submit" name="submit" value="Submit" class="btn btn-success">Submit</button>
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
// Generate the page footer
Layout::pageBottom();
?>