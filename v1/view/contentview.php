<?php 


/**
 * 
 */
class ContentView extends IndexView
{
	
	function __construct(Comments $comments)
	{
		parent::__construct($comments);
	}

	public function content_container(array $thread)
	{
		$img = '';
		if ($thread['img'] != 'no image') {
			$src = $thread['img'];
			$img = "<div class='image_holder'><img alt='content-image' src='$src' height='500'></div>"; 
		}
		echo "<div class='content-holder'>".$thread['content']."$img</div>";
	}

	public function commentholder(int $threadid, string $title)
	{
		echo "<div class='comment_holder'><div id='title_of_thread'><h3>Title:$title</h3></div></div>";
	}
}