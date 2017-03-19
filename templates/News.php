<?php
class news
{
    /**
     * Pass in an array of stories to render
     *
     * @param $data
     */
    public static function stories($data)
    {
        foreach ( $data as $story ) {
            Self::story($story);
        }
    }
    /**
     * Render a single story
     *
     * @param $data
     */
    public static function story($data)
    {
		//$id = $data['id'];
        $title = $data['title'];
        $content = $data['content'];
		$startDate = $data['startDate'];
		$endDate = $data['endDate'];
		$realStartDate = date('y-m-d h:i:s',strtotime($startDate));
		$realEndDate = date('y-m-d h:i:s',strtotime($endDate));
		$image = "images/" . $data['image'];
         //$author = $data['firstname'] . ' ' . $data['lastname'];
        echo <<<story
        <div class="top10">
            <h2>$title</h2>
            <p>$content</p>
			<p>$realStartDate - $realEndDate</p>
        </div>        
story;
    }
	
	
	
	
}