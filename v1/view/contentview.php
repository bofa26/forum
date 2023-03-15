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
		echo "<div class='content-holder'>".$thread['content']."<div class='image_holder'><img alt='content-image' src='img/test.png' height='500'></div></div>";
	}

}