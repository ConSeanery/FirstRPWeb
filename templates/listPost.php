

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
	<table>	
		
		<th>Title</th>
		<th>Started</th>
		<th>Ended</th>
		<th colspan= "2">Options</th>
supertable;
}

		
		
public static function story($data)
    {
		
		
		$id = $data['id'];
        $title = $data['title'];
        $startDate = $data['startDate'];
        $endDate = $data['endDate'];
		$realStartDate = date('y-m-d',strtotime($startDate));
		$realEndDate = date('y-m-d',strtotime($endDate));
			
    
		echo <<<story
			<tr>
			                 
            <td class ="longWords">$title</td>
			<td>$realStartDate</td>  
			<td>$realEndDate</td>
                    <td><a class="editButton" href="/updatePost.php?id=$id">Edit</a></td>
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