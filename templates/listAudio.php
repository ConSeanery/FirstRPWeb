


<?php

class listAudio{
	
 
   public static function stories($data)
    {
        foreach ( $data as $story ) {
            Self::story($story);
        }
    }
	
	
    
public static function makeTable()
{			
	echo <<<supertable
	<form id="listPostForm" action='updatePost.php' method="GET">
	<table class = "listTable">	
		<th>Title</th>
		<th>author</th>
		<th colspan= "3">Options</th>
supertable;
}

		
		
public static function story($data)
    {
		
		
		$id = $data['id'];
        $title = $data['title'];
		$url = $data['url'];
		$author = $data['author'];
			
    if (isset($_SESSION['users'])){
		echo <<<story
			<tr>               
            <td>$title</td>
			<td>$author</td>
					<td><a class="audioLinks" href="$url" id=$id">Listen</a></td>
                    <td><a class="editButton" href="/updateAudio.php?id=$id">Edit</a></td>
					 <td><a class="deleteButton" href="/deleteAudio.php?id=$id">Delete</a></td>
                </div>
            </div>
			</tr>
story;
	}
		else{ 
		echo <<<story
			<tr>             
            <td>$title</td>
			<td>$author</td>
			<td><p>...</p></td>
			<td><p>...</p></td>
			<td><a class="audioLinks" href="$url" id=$id">Listen</a></td> 
                </div>
            </div>
			</tr>
story;
}
		
			

	
}
 public static function endTable()
    {
echo <<<superTable
			</table>
			</form>
superTable;
	}
}