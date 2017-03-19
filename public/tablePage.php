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
$posts = $db->query($sql);
// Run a simple query that will be rendered in column 2 below
$sql = 'select id, name, description from pages';
$res = $db->query($sql);

Layout::pageTop('Csc206 Project');

?>



<div class="container top25">
        <div class="col-md-8">
            <section class="content">
<?php

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
layout::pageBottom('Csc206 Project');
?>

</section>

</div>
<?php
	 layout::pageSide('Csc206 Project');
?>
 
