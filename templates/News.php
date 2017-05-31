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
		$id = $data['id'];
        $title = $data['title'];
        $content = $data['content'];
		$startDate = $data['startDate'];
		$endDate = $data['endDate'];
		$realStartDate = date('m-d-y',strtotime($startDate));
		$realEndDate = date('m-d-y',strtotime($endDate));
		$image = '/images/' . $data['image'];
		
        echo <<<story
		<a href="/View.php?id=$id">
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
</a>		
story;
    }
	
	
	public static function sermons($data)
    {
        foreach ( $data as $sermon ) {
            Self::sermon($sermon);
        }
    }
	
	public static function sermon($data)
    {
        $title = $data['title'];
        $url = $data['url'];
        echo <<<story
		<div class="audioLinks">
            <a href="$url">$title</a>      
			</div>
story;
	}
}