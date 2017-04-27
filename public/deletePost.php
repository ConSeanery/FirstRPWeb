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
Layout::pageTop('CSC206 Project');
?>

<div class="container top25">
    <div class="col-md-8">
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
				
                echo <<<postform
				
                    <form id="createPostForm" action='deletePost.php' method="POST" class="form-horizontal">
                        <fieldset>
						<p>Are you sure you want to DELETE this post?</p>
                        <input type="hidden" name="id" value="$id">
                            <!-- Form Name -->
                            <legend>Delete Post</legend>
                            <!-- Button (Double) -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="submit"></label>
                                <div class="col-md-8">
                                    <button id="submit" name="submit" value="Submit" class="editButton">Delete</button>
                                   <a class="deleteButton" href="tablePage.php">Cancel</a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
postform;
				}
					else{
						echo '<p>Not Logged in</p>';
						}
            } elseif ( $requestType == 'POST' ) {
                //Validate data
                $id = $_POST['id'];
                // Save data
                $sql =  "delete from posts where id=$id";
                $result = $db->query($sql);
                echo 'This Post was deleted successfully';
            }
            ?>


        </section>
    </div>
</div>




<?php
// Generate the page footer
Layout::pageBottom();
?>