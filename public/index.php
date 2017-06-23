<?php

require($_SERVER[ 'DOCUMENT_ROOT' ] . '/../includes/application_includes.php');

// Include the HTML layout class
require_once(FS_TEMPLATES . 'Layout.php');
require_once(FS_TEMPLATES . 'listPost.php');
require_once(FS_TEMPLATES . 'News.php');

// Connect to the database
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Get the stories for column 1 from the database
$sql = 'SELECT SUBSTRING(content,1,500) AS content, startDate, endDate, image, title, id FROM posts ORDER BY id DESC limit 3';
$sql2 = 'select * from audio ORDER BY id DESC limit 12';

$postCount = 0;
$posts = $db->query($sql);
$sermons = $db->query($sql2);
// Run a simple query that will be rendered in column 2 below
$sql = 'select id, name, description from pages';
$sql2 = 'select id, title, url from audio';
$res = $db->query($sql);
$res = $db->query($sql2);

Layout::pageTop('Csc206 Project');

?>
 <h2>New Events!</h2>
<?php
 // Loop through the posts and display them
 
         while ($post = $posts->fetch()){
         // Call the method to create the layout for a post
          News::story($post);
 }
 
?>
	</div>
			
				<!--The Side Well -->
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
Layout::pageBottom();
