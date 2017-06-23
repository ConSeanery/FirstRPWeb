


<?php

class listPost{
	
 
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
	<table class= "listTable">	
		<th>Event</th>
		<th >Start Date</th>
		<th>End Date</th>
		<th colspan= "3">Options</th>
supertable;
}

		
		
public static function story($data)
    {
		
		
		$id = $data['id'];
        $title = $data['title'];
        $startDate = $data['startDate'];
        $endDate = $data['endDate'];
		$realStartDate = date('m-d-y',strtotime($startDate));
		$realEndDate = $endDate;
			
    if (isset($_SESSION['users'])){
		echo <<<story
			<tr>
			                 
            <td><p>$title</p></td>
			<td><p>$realStartDate</p></td>  
			<td><p>$realEndDate</p></td>
			<td><a class="audioLinks" href="/View.php?id=$id">View</a></td>
            <td><a class="editButton" href="/updatePost.php?id=$id">Edit</a></td>
			<td><a class="deleteButton" href="/deletePost.php?id=$id">Delete</a></td>
					 
                </div>
            </div>
			</tr>
story;
	}
	else{
		echo <<<story
			<tr>
			                 
            <td><p>$title</p></td>
			<td><p>$realStartDate</p></td>  
			<td><p>$realEndDate</p></td>
			<td><p>...</p></td>
			<td><p>...</p></td>
			<td><a class="audioLinks" href="/View.php?id=$id">View</a></td>
    
					 
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