



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
//session_start();
unset($_SESSION['username']);
session_destroy();
echo '<h1>You have been logged out.</h1>';
//header("Location: logout.php");
exit;
?>



        </section>
    </div>
</div>




<?php
// Generate the page footer
Layout::pageBottom();
?>