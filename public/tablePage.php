<?php

require($_SERVER[ 'DOCUMENT_ROOT' ] . '/../includes/application_includes.php');

// Include the HTML layout class
require_once(FS_TEMPLATES . 'Layout.php');
require_once(FS_TEMPLATES . 'listPost.php');

// Connect to the database
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Get the stories for column 1 from the database
$sql = 'select * from posts';
$posts = $db->query($sql);
// Run a simple query that will be rendered in column 2 below
$sql = 'select id, name, description from pages';
$res = $db->query($sql);

layout::pageTop('Csc206 Project');

//layout::blogPost('Csc206 Project');
?>

<?php
listPost::makeTable('Csc206 Project');
 // Loop through the posts and display them
         while ($post = $posts->fetch()) {
         // Call the method to create the layout for a post
          listPost::story($post);
		if(isset($_POST['delete'])){	
        $sql = "DELETE FROM posts WHERE id = $id";  
        echo "Deleted data successfully\n";}	
     }
listPost::endTable('Csc206 Project');

layout::pageBottom('Csc206 Project')
?>

