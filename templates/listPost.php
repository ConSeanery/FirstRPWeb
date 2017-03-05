

<?php

class listPost{
	
 
   public static function stories($data)
    {
        foreach ( $data as $story ) {
            Self::story($story);
        }
    }
	
	 function makeTable($data)
    {       
			
	echo <<<supertable
	<form id="listPostForm" action='tablePage.php' method="POST">
	<table>	
		<th>id</th>
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
			<td>$id</td>                  
            <td>$title</td>
			<td>$realStartDate</td>  
			<td>$realEndDate</td>
			<td> <div class="form-group">
                <label class="col-md-3 control-label" for="submit"></label>
                <div class="col-md-8">
                    <button id="submit" name="submit" value="Edit" class="btn btn-success">Edit</button>
					 <td><input name = "delete" type = "submit" id = "delete" value = "Delete"></td>
                </div>
            </div></td>
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