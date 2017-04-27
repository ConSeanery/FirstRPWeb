


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
	<table class = "listTable">	
		
		<th>Title</th>
		<th>Started</th>
		<th>Ended</th>
		<th colspan= "3">Options</th>
supertable;
}

		
		
public static function story($data)
    {
		
		
		$id = $data['id'];
        $title = $data['title'];
        $startDate = $data['startDate'];
        $endDate = $data['endDate'];
		$realStartDate = date('m-d-y h:i:s',strtotime($startDate));
		$realEndDate = date('m-d-y h:i:s',strtotime($endDate));
			
    
		echo <<<story
			<tr>
			                 
            <td class ="longWords">$title</td>
			<td>$realStartDate</td>  
			<td>$realEndDate</td>
                    <td><a class="editButton" href="/updatePost.php?id=$id">Edit</a></td>
					<td><a class="editButton" href="/View.php?id=$id">View</a></td>
					 <td><a class="deleteButton" href="/deletePost.php?id=$id">Delete</a></td>
					 
                </div>
            </div>
			</tr>.
story;
		
		
			

	
}
 public static function endTable()
    {
echo <<<superTable
			</table>
			</form>
superTable;

	}
	



}