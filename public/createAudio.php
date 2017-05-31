					


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

// Get the stories for column 1 from the database
$sql = 'select * from posts';
$sql2 = 'select * from audio';
$sermons = $db->query($sql2);
// Run a simple query that will be rendered in column 2 below
$sql2 = 'select id, title, url from audio';
$res = $db->query($sql2);
// Generate the HTML for the top of the page
Layout::pageTop('Csc206 Project');
// Page content goes here
//echo $_SESSION['user'],['firstname'];
?>

    <div class="container top25">
        <div class="col-md-8">
            <section class="content">

                <?php
				$message = "";
                if ( $requestType == 'GET' ) {
                    // Display the form
					if (isset($_SESSION['users'])){
                    showForm();
					}
					else{$message = '<p>Not Logged in</p>';}
                } else if ( $requestType == 'POST' ) {
                    // Process data that was submitted
                    echo '<h2>This is the data that was entered</h2>';
                    echo '<pre>';
                    print_r($_POST);
                    echo '</pre>';
                    // pull the fields from the POST array.
					
					
                    $title = $_POST['title'];
                    $url = $_POST['url'];
					$author = $_POST['author'];
					$title = htmlspecialchars($title, ENT_QUOTES);
					$url = htmlspecialchars($url, ENT_QUOTES);
					$author = htmlspecialchars($author, ENT_QUOTES);
                    // This SQL uses double quotes for the query string.  If a field is not a number (it's a string or a date) it needs
                    // to be enclosed in single quotes.  Note that right after values is a ( and a single quote.  Taht single quote comes right
                    // before the value of $title.  Note also that at the end of $title is a ', ' inside of double quotes.  What this will all render
                    // That will generate this piece of SQL:   values ('title text here', 'content text here', '2017-02-01 00:00:00'  and so
                    // on until the end of the sql command.
                    $sql = "insert into audio (title, url, author) values ('" . $title . "', '" . $url . "', '" . $author . "');";
                    $db->query($sql);
					showForm();
                }
				echo $message;
                ?>


            </section>
			
   
		</div>
		
		
		<?php
		
		layout::pageSide('Csc206 Project');	
		echo <<<yes
		<!-- Side Widget Well -->
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
    </div>

<?php
// Generate the page footer

/**
 * Functions that support the createPost page
 */
$fields = [
	'id'     => ['integer'],
    'title'     => ['required', 'string'],
	'author'  => ['required', 'string'],
    'url'   => ['required', 'string'],
	//'image'     => ['string']
];
/**
 * Show the form
 */
function showForm($data = null)
{
		$author = $data['author'];
        $title = $data['title'];
        $url = $data['url'];
   echo <<<postform
    <form id="showAudioForm" action='createAudio.php' method="POST" class="form-horizontal">
        <fieldset>
    
            <!-- Form Name -->
            <legend>New Audio Link</legend>
    
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-3 control-label" for="title">Title</label>
                <div class="col-md-8">
                    <input id="title" name="title" type="text" placeholder="post title" value="$title" class="form-control input-md" required="">                    
                </div>
            </div>
			 <!-- Textarea -->
            <div class="form-group">
                <label class="col-md-3 control-label" for="author">Author</label>
                <div class="col-md-8">
                    <textarea class="form-control" id="author" name="author">$author</textarea>
                </div>
            </div>
    
            <!-- Textarea -->
            <div class="form-group">
                <label class="col-md-3 control-label" for="url">URL:</label>
                <div class="col-md-8">
                    <textarea class="form-control" id="url" name="url">$url</textarea>
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
