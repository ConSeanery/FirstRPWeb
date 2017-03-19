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
                $sql = 'select * from posts where id = ' . $_GET['id'];
                $result = $db->query($sql);
                $row = $result->fetch();
				
                $id = $row['id'];
                $title= $row['title'];
                $content= $row['content'];
                $startDate= $row['startDate'];
                $endDate= $row['endDate'];
				
                echo <<<post
				
                    <h2>$title</h2>
					<div class ="BlockText">
					<p>$content</p>
					</div>
					<p>$startDate - $endDate</p>
					
post;
            } elseif ( $requestType == 'POST' ) {
                //Validate data
                $id = $_POST['id'];
                $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
                $content = htmlspecialchars($_POST['content'], ENT_QUOTES);
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