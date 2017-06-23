



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
//session_start();
unset($_SESSION['username']);
session_destroy();
echo '<h1>You have been logged out.</h1>';
//header("Location: logout.php");
?>



        </section>
</div>
</div>


<?php
		layout::pageSide('Csc206 Project');	
		
	 
	 echo <<<end
					
        </div>
				
			<!-- /.row -->

        <hr>
end;
?>

<?php
// Generate the page footer
Layout::pageBottom();
?>