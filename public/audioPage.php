<?php

require($_SERVER[ 'DOCUMENT_ROOT' ] . '/../includes/application_includes.php');

// Include the HTML layout class
require_once(FS_TEMPLATES . 'Layout.php');
require_once(FS_TEMPLATES . 'listAudio.php');
require_once(FS_TEMPLATES . 'News.php');

// Connect to the database
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$results_per_page = 10;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 

$start_from = ($page-1) * $results_per_page;
$sql = "SELECT * FROM audio ORDER BY ID DESC LIMIT $start_from, ".$results_per_page;


$sql3 = "SELECT COUNT(ID) AS total FROM audio"; 
$result = $db->query($sql3);
$row = $result->fetch();

$total_pages = ceil($row["total"] / $results_per_page);


$sermons = $db->query($sql);
// Run a simple query that will be rendered in column 2 below
$sql = 'select id, title, url from audio';

$res = $db->query($sql);
Layout::pageTop('Csc206 Project');

?>



<div class="container top25">
       
            <section class="content">
<?php
echo "<h2>Audio Sermons</h2>";
listAudio::makeTable('Csc206 Project');
 // Loop through the posts and display them
 
         while ($sermon = $sermons->fetch()) {
         // Call the method to create the layout for a post
          listAudio::story($sermon);
		
										}									
listAudio::endTable('Csc206 Project');
for ($i=1; $i<=$total_pages; $i++) { 
    echo " <div class='searchPageLink'><a href='audioPage.php?page=".$i."'>".$i."</a></div>"; 	
}; 

?>

</section>
	</div>
</div>

<?php
		layout::pageSide('Csc206 Project');	
		echo <<<yes
		<!-- Side Widget Well -->
		<div class="col-md-4">
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
layout::pageBottom('Csc206 Project');
?>
 
