<?php

require($_SERVER[ 'DOCUMENT_ROOT' ] . '/../includes/application_includes.php');

// Include the HTML layout class
require_once(FS_TEMPLATES . 'Layout.php');
require_once(FS_TEMPLATES . 'listPost.php');
require_once(FS_TEMPLATES . 'listAudio.php');
require_once(FS_TEMPLATES . 'News.php');

// Connect to the database
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$results_per_page = 10;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 

$start_from = ($page-1) * $results_per_page;
// Get the stories for column 1 from the database
$query = htmlspecialchars($_GET['query'], ENT_QUOTES);



 
$sql = "SELECT SUBSTRING(content,1,500) AS content, startDate, endDate, image, title, id from posts 
            WHERE (`title` LIKE '%".$query."%') OR (`content` LIKE '%".$query."%') ORDER BY id DESC limit 1;";			
$sql2 = "select * from audio 
            WHERE (`title` LIKE '%".$query."%') OR (`author` LIKE '%".$query."%') ORDER BY id DESC limit 10;";
$sql3 = "select * from posts 
            WHERE (`title` LIKE '%".$query."%') OR (`content` LIKE '%".$query."%') ORDER BY id DESC limit 5;";			
			


$posts = $db->query($sql);
$tablePosts = $db->query($sql3);
$tableSermons = $db->query($sql2);
$sermons = $db->query($sql2);


// Run a simple query that will be rendered in column 2 below
$sql = 'select id, name, description from pages';
$sql2 = 'select id, title, url from audio';
$res = $db->query($sql);
$res = $db->query($sql2);
$res = $db->query($sql3);

Layout::pageTop('Csc206 Project');

?>
 <h1>Search Results</h1>
 

 
 
 
<?php
 echo "<h3>Church Events</h3>";
    while ($post = $posts->fetch()) {
         // Call the method to create the layout for a post
          News::story($post);
		   
     }
	 
	  listPost::makeTable('Csc206 Project');
 // Loop through the posts and display them
 
         while ($post = $tablePosts->fetch()) {
         // Call the method to create the layout for a post
          listPost::story($post);
		
										}
	 foreach ($tablePosts as $post)			{
       $post['content'] = substr($post['content'], 0, 35) . '...';
										}									
listPost::endTable('Csc206 Project');

?>

<?php
echo "<h3>Audio Sermons</h3>";
listAudio::makeTable('Csc206 Project');
 // Loop through the posts and display them
 
         while ($sermon = $tableSermons->fetch()) {
         // Call the method to create the layout for a post
          listAudio::story($sermon);
		
										}
	 foreach ($tableSermons as $sermon)			{
       $sermon['url'] = substr($sermon['url'], 0, 35) . '...';
										}									
listAudio::endTable('Csc206 Project');

?>


	
			</div>
				<!--The Side Well -->
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
Layout::pageBottom();
