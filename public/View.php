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
$sql2 = 'select * from audio';

$posts = $db->query($sql);
$sermons = $db->query($sql2);
// Run a simple query that will be rendered in column 2 below
$sql = 'select id, name, description from pages';
$sql2 = 'select id, title, url from audio';
$res = $db->query($sql);
$res = $db->query($sql2);

Layout::pageTop('Csc206 Project');
?>


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
				$realStartDate = date('m-d-y',strtotime($startDate));
				$realEndDate = date('m-d-y',strtotime($endDate));
				$image = '/images/' . $row['image'];
				
                echo <<<post
				
                    
            <div class="top10">
		  
            <h2>$title</h2>
			<div class="row">
			<div class="col-sm-4"><img src="$image" width="201" height="181"></div>
			<div class="col-sm-8"><p>$content</p></div>
			</div>
			
			<div class="topTenDates">
			<p>Event starts at $realStartDate and ends on $realEndDate</p>
			</div>
			 
			</div>
			
         
              
					
post;

if (isset($_SESSION['users'])){
	echo <<<options
                   <a class="editButton" href="/updatePost.php?id=$id">Edit</a>
			<a class="deleteButton" href="/deletePost.php?id=$id">Delete</a>
options;
					}

			
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
// Generate the page footer
Layout::pageBottom();
?>