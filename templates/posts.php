<?php
class blogPost
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
        $title = '[DevLeak] The Documented Struggle';
        $content = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.';
        $author = 'Samuel' . 'C.' . 'Green';
        echo <<<story
        <div class="top10">
            <h2>$title</h2>
            <h5> by $author</h5>
            <p>$content</p>
        </div>        
story;
    }
}