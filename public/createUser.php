<?php
// Load all application files and configurations
require($_SERVER[ 'DOCUMENT_ROOT' ] . '/../includes/application_includes.php');
// Include the HTML layout class
require_once(FS_TEMPLATES . 'Layout.php');
require_once(FS_TEMPLATES . 'News.php');
// Connect to the database
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Initialize variables
$requestType = $_SERVER[ 'REQUEST_METHOD' ];
// Generate the HTML for the top of the page
Layout::pageTop('Csc206 Project');
// Page content goes here
?>

    <div class="container top25">
        <div class="col-md-8">
            <section class="content">

                <?php
                if ( $requestType == 'GET' ) {
                    // Display the form
					
                    showForm();
                } else if ( $requestType == 'POST' ) {
                    // Process data that was submitted
                    //echo '<h2>This is the data that was entered</h2>';
                   // echo '<pre>';
                    //print_r($_POST);
                    //echo '</pre>';
                    // pull the fields from the POST array.
                   $firstName  = $_POST['firstName'];
					$lastName   = $_POST['lastName'];
                    $userName  = $_POST['email'];
					$confirmPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
					
					
                    // This SQL uses double quotes for the query string.  If a field is not a number (it's a string or a date) it needs
                    // to be enclosed in single quotes.  Note that right after values is a ( and a single quote.  Taht single quote comes right
                    // before the value of $title.  Note also that at the end of $title is a ', ' inside of double quotes.  What this will all render
                    // That will generate this piece of SQL:   values ('title text here', 'content text here', '2017-02-01 00:00:00'  and so
                    // on until the end of the sql command.
                    $sql = "insert into users (firstName, lastName, email, password) values ('" . $firstName . "', '" . $lastName . "', '" . $userName . "', '" . $confirmPassword . "');";	
					if($_POST['password'] == $_POST['tryPassword'] && $_POST['password'] != null)
					{
						$input = $_POST;
						$sql = "select * from users where email = '" . $input['email'] . "'";
						$result = $db->query($sql);	
						if ($result->size() == 0){
						$sql = "insert into users (firstName, lastName, email, password) values ('" . $firstName . "', '" . $lastName . "', '" . $userName . "', '" . $confirmPassword . "');";	
						$db->query($sql);
						{echo '<h2>Welcome, new user! You may now use admin functions on this site.</h2>';}
						}else{echo '<h1>Username already taken. Try again.</h1>'; showForm();}							
					}
					else{echo '<h1>Password does not match. Try again.</h1>'; showForm();}	
                }
				
                ?>


            </section>
        </div>
		
		<?php
layout::pageSide('Csc206 Project');
?>
    </div>

<?php
// Generate the page footer

/**
 * Functions that support the createPost page
 */
$fields = [
	'id'     => ['integer'],
    'firstName'     => ['required', 'string'],
    'password'   => ['required', 'string'],
    'email'     => ['required', 'string']
];
/**
 * Show the form
 */
function showForm($data = null)
{
       $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $userName = $data['email'];
		
		$confirmPassword  = $data['password'];
		
		
		
	
    echo <<<postform
    <form id="createUserForm" action='createUser.php' method="POST" class="form-horizontal">
        <fieldset>
    
            <!-- Form Name -->
            <legend>Create User</legend>
    
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-3 control-label" for="firstName">First Name</label>
                <div class="col-md-8">
                    <input id="firstName" name="firstName" type="text" placeholder="" value="$firstName" class="form-control input-md" required="">                    
                </div>
            </div>
    
    
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-3 control-label" for="lastName">Last Name</label>
                <div class="col-md-8">
                    <input id="lastName" name="lastName" type="text" placeholder="" value="$lastName" class="form-control input-md" required="">
                </div>
            </div>
    
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-3 control-label" for="email">Username</label>
                <div class="col-md-8">
                    <input id="email" name="email" type="text" placeholder="" value="$userName" class="form-control input-md">
                </div>
            </div>
			
			 <!-- Text input-->
            <div class="form-group">
                <label class="col-md-3 control-label" for="tryPassword">Password</label>
                <div class="col-md-8">
                    <input id="tryPassword" name="tryPassword" type="password" placeholder="" value="" class="form-control input-md">
                </div>
            </div>
			
			<!-- Text input-->
            <div class="form-group">
                <label class="col-md-3 control-label" for="password">Confirm Password</label>
                <div class="col-md-8">
                    <input id="password" name="password" type="password" placeholder="" value="$confirmPassword" class="form-control input-md">
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


Layout::pageBottom('CSC206 Project');
}