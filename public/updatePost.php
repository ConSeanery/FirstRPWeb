<?php
require($_SERVER[ 'DOCUMENT_ROOT' ] . '/../includes/application_includes.php');

// Include the HTML layout class
require_once(FS_TEMPLATES . 'Layout.php');
require_once(FS_TEMPLATES . 'listPost.php');
require_once(FS_TEMPLATES . 'News.php');

// Connect to the database
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Get the stories for column 1 from the database
$sql = 'select * from posts';
$sql2 = 'select * from audio';

$posts = $db->query($sql);
$sermons = $db->query($sql2);
// Run a simple query that will be rendered in column 2 below
$sql = 'select id, name, description from pages';
$sql2 = 'select id, title, url from audio';
$res = $db->query($sql);
$res = $db->query($sql2);

Layout::pageTop('Csc206 Project');

?>
<div class="container top25">
       
            <section class="content">

            <?php
            if ( $requestType == 'GET' ) {
				if (isset($_SESSION["users"])){
                    
                $sql = 'select * from posts where id = ' . $_GET['id'];
                $result = $db->query($sql);
                $row = $result->fetch();
				
                $id = $row['id'];
                $title= $row['title'];
                $content= $row['content'];
                $startDate= $row['startDate'];
                $endDate= $row['endDate'];
				$image = $row['image'];
				
				
                echo <<<postform
                    <form id="createPostForm" action='updatePost.php' method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <fieldset>
                        <input type="hidden" name="id" value="$id">
                            <!-- Form Name -->
                            <legend>Edit Post</legend>
                    
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
                                <label class="col-md-3 control-label" for="content">Post</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="content" name="content">$content</textarea>
                                </div>	
							</div>
                            </div>
                    
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="startDate">Effective Date</label>
                                <div class="col-md-8">
                                    <input id="startDate" name="startDate" type="text" placeholder="yyyy/mm/dd" class="form-control input-md" required="">
                                </div>
                            </div>
                    
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="endDate">End Date</label>
                                <div class="col-md-8">
                                    <input id="endDate" name="endDate" type="text" placeholder="yyyy/mm/dd" class="form-control input-md">
                                </div>
                            </div>
                    
                            
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
                                    <button id="submit" name="submit" value="Submit" class="editButton">Submit</button>
                                    <a class="deleteButton" href="tablePage.php">Cancel</a>
                                </div>
                            </div>
                    
                        </fieldset>
                    </form>
postform;
				}
				else{echo '<p>Not Logged in</p>';}		
				
					
            } elseif ( $requestType == 'POST' ) {
                //Validate data
				$input = $_POST;
				$file = $_FILES[ 'imagename' ][ 'tmp_name' ];
				$fileName = $_FILES[ 'imagename' ][ 'name' ];
                $id = $_POST['id'];
                $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
                $content = htmlspecialchars($_POST['content'], ENT_QUOTES);
				$startDate = $_POST['startDate'];
				$endDate = $_POST['endDate'];
				
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
                // Save data
				
				$image = $fileName;
                $sql = "update posts set title = '$title', content= '$content', image= '$image', startDate= '$startDate', endDate= '$endDate' where id=$id;";
                $result = $db->query($sql);
                echo 'This Post was updated successfully';
            }
			
			
				

            ?>


        </section>
  </div>
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


<?php
// Generate the page footer
Layout::pageBottom();
?>