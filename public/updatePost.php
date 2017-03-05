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
               echo '<pre>';
               print_r($_GET);
                echo '<pre>';
                // use sql to get the post with id = 39
                $sql = 'select * from posts where id = ' . $_GET['id'];
                $result = $db->query($sql);
                showUpdateForm($result);
            } else if ( $requestType == 'POST' ) {
                    //Validate data
                    // Save data
                    $sql = 'update posts set title= '. $_POST['title'] .'  where id=39'
            }
			?>


        </section>
    </div>

    <div class="col-md-4">
        <section class="content">
            <h1>Posts List</h1>
            <p>Current and active posts.</p>

        </section>
    </div>
</div>




<?php
// Generate the page footer
Layout::pageBottom();
?>