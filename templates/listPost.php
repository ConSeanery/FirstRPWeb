

<?php
class listPost{
 
   public static function stories($data)
    {
        foreach ( $data as $story ) {
            Self::story($story);
        }
    }
	 public static function makeTable($data)
    {
	echo <<<supertable
	<table>	
	<th>Title</th>
		<th>Started</th>
		<th>Ended</th>
		<th>Options</th>
supertable;
	}
		
public static function story($data)
    {
        $title = $data['title'];
        $startDate = $data['startDate'];
        $endDate = $data['endDate'];
		$realStartDate = date('y-m-d',strtotime($startDate));
		$realEndDate = date('y-m-d',strtotime($endDate));
			
	
    
		echo <<<story
			<tr>
            <td>$title</td>
			<td>$realStartDate</td>  
			<td>$realEndDate</td>
			<td> <div class="form-group">
                <label class="col-md-3 control-label" for="submit"></label>
                <div class="col-md-8">
                    <button id="submit" name="submit" value="Edit" class="btn btn-success">Edit</button>
                    <button id="cancel" name="cancel" value="Delete" class="btn btn-info">Delete</button>
                </div>
            </div></td>
			</tr>.
story;
		
		
			

	
}
 public static function endTable()
    {
echo <<<superTable
			</table>
superTable;
	}
}