<?php
require($_SERVER[ 'DOCUMENT_ROOT' ] . '/../includes/application_includes.php');

// Include the HTML layout class
require_once(FS_TEMPLATES . 'Layout.php');
require_once(FS_TEMPLATES . 'listPost.php');
require_once(FS_TEMPLATES . 'News.php');

// Connect to the database
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Get the stories for column 1 from the database
$sql2 = 'select * from audio';
$sermons = $db->query($sql2);
// Run a simple query that will be rendered in column 2 below
$sql = 'select id, name, description from pages';
$sql2 = 'select id, title, url from audio';
$res = $db->query($sql2);
Layout::pageTop('Csc206 Project');
?>

<div class="container top25">
        <section class="content">
                <?php
                if ( $requestType == 'GET' ) {
                    // Display the form
					if (isset($_SESSION['users'])){
                    showForm();
					}
					else{echo '<p>Not Logged in</p>';}
                } else if ( $requestType == 'POST' ) {
                    // Process data that was submitted
                    echo '<h2>This is the data that was entered</h2>';
                    echo '<pre>';
                    print_r($_POST);
                    echo '</pre>';
					showForm();
                    // pull the fields from the POST array.
					
					
                    
					// Check for a valid file upload
					$input = $_POST;
					
					$file = $_FILES[ 'imagename' ][ 'tmp_name' ];
					$fileName = $_FILES[ 'imagename' ][ 'name' ];
					
		if (!$_FILES[ 'imagename' ][ 'tmp_name' ] == 0){
        if ( !is_uploaded_file($file) ) {
            echo '<h3>Error</h3><p>File was not uploaded via POST form.</p>';
            exit;
        }
		
        if ( file_exists($file) ) {
            $imagesizedata = getimagesize($file);
            if ( $imagesizedata === false ) {
                //not image
                echo '<h3>Error</h3><p>Uploaded file is not an image.</p>';
                exit;
            } else {
                //image information
                echo '<h3>Success</h3><p>The image was uploaded</p>';
                //echo '<pre>' . print_r($imagesizedata) . '</pre>';
                // Copy image to permanent location
                $uploaded_file = $_SERVER[ 'DOCUMENT_ROOT' ] . '/images/' . $_FILES[ 'imagename' ][ 'name' ];
                // Move file to permanent location
                move_uploaded_file($file, $uploaded_file);
                // Display the image
                //showImage($input, $_FILES[ 'image' ]);
 
            }
        }}else{$fileName = "logo.jpg";} 
            //not file
			
            //echo '<h3>Error</h3><p>There was an error uploading the file</p>';
            
					$title = $_POST['title'];
					$image = $fileName;
                    $content = $_POST['content'];
                    $startDate  = $_POST['startDate'];
                    $endDate  = $_POST['endDate'];
					$title = htmlspecialchars($title, ENT_QUOTES);
					$content = htmlspecialchars($content, ENT_QUOTES);
                    // This SQL uses double quotes for the query string.  If a field is not a number (it's a string or a date) it needs
                    // to be enclosed in single quotes.  Note that right after values is a ( and a single quote.  Taht single quote comes right
                    // before the value of $title.  Note also that at the end of $title is a ', ' inside of double quotes.  What this will all render
                    // That will generate this piece of SQL:   values ('title text here', 'content text here', '2017-02-01 00:00:00'  and so
                    // on until the end of the sql command.
				$sql = "insert into posts (title, content, startDate, endDate, image) values ('" . $title . "', '" . $content ."', '" . $startDate . "', '" . $endDate . "', '" . $image . "');";
                    $db->query($sql);
                }
				
                ?>
				</section>
		
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
    

<?php
// Generate the page footer

/**
 * Functions that support the createPost page
 */
$fields = [
	'id'     => ['integer'],
    'title'     => ['required', 'string'],
    'content'   => ['required', 'string'],
    'startDate' => ['required', 'date'],
    'endDate'   => ['required', 'date'],
	//'image'     => ['string']
];
/**
 * Show the form
 */
function showForm($data = null)
{
        $title = $data['title'];
        $content = $data['content'];
        $startDate = $data['startDate'];
        $endDate = $data['endDate'];
        $image = $data['image'];
    echo <<<postform
    <form id="createPostForm" action='createPost.php' method="POST" class="form-horizontal" enctype="multipart/form-data">
        <fieldset>
    
            <!-- Form Name -->
            <legend>Create Post</legend>
    
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-3 control-label" for="title">Title</label>
                <div class="col-md-8">
                    <input id="title" name="title" type="text" placeholder="post title" value="$title" class="form-control input-md" required="">                    
                </div>
            </div>
    
            <!-- Textarea -->
			<div class="postText">
            <div class="form-group">
                <label class="col-md-3 control-label" for="content">Content</label>
                <div class="col-md-8">
                    <textarea class="form-control" id="content" name="content">$content</textarea>
                </div>
            </div>
		</div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-3 control-label" for="startDate">Effective Date</label>
                <div class="col-md-8">
                    <input id="startDate" name="startDate" type="text" placeholder="yyyy/mm/dd" value="$startDate" class="form-control input-md" required="">
                </div>
            </div>
    
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-3 control-label" for="endDate">End Date</label>
                <div class="col-md-8">
                    <input id="endDate" name="endDate" type="text" placeholder="yyyy/mm/dd" value="$endDate" class="form-control input-md">
                </div>
            </div>
    
            <!-- File Button -->
            <div class="form-group">
                <label class="col-md-3 control-label" for="image">Image Upload</label>
                <div class="col-md-8">
                    <input id="image" name="imagename" class="input-file" value="$image" type="file">
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