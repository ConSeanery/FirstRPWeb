<?php

require($_SERVER[ 'DOCUMENT_ROOT' ] . '/../includes/application_includes.php');

// Include the HTML layout class
require_once(FS_TEMPLATES . 'Layout.php');
require_once(FS_TEMPLATES . 'listPost.php');
require_once(FS_TEMPLATES . 'News.php');

// Connect to the database
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Get the stories for column 1 from the database
$results_per_page = 10;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 

$start_from = ($page-1) * $results_per_page;
$sql = "SELECT * FROM posts ORDER BY ID DESC LIMIT $start_from, ".$results_per_page;
$sql2 = 'select * from audio';


$sql3 = "SELECT COUNT(ID) AS total FROM posts"; 
$result = $db->query($sql3);
$row = $result->fetch();

$total_pages = ceil($row["total"] / $results_per_page);




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
echo "<h2>Church Events</h2>";
listPost::makeTable('Csc206 Project');
 // Loop through the posts and display them
 
         while ($post = $posts->fetch()) {
         // Call the method to create the layout for a post
          listPost::story($post);
										}
	 foreach ($posts as $post)			{
       $post['content'] = substr($post['content'], 0, 35) . '...';
										}											
listPost::endTable('Csc206 Project');
 

for ($i=1; $i<=$total_pages; $i++) { 
    echo " <div class='searchPageLink'><a href='tablePage.php?page=".$i."'>".$i."</a></div>"; 
	
}; 

echo "</div> </div>";

?>

</section>


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

layout::pageBottom('Csc206 Project');
?>
 
