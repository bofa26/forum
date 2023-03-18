<?php 


/**
 * 
 */
class ContentView extends IndexView
{
	
	function __construct(Comments $comments, Reacts $reacts)
	{
		parent::__construct($comments, $reacts);
	}

	public function content_container(array $thread)
	{
		$img = '';
		if ($thread['img'] != 'no image') {
			$src = $thread['img'];
			$img = "<div class='image_holder'><img alt='content-image' src='$src' height='500'></div>"; 
		}
		echo "<div class='content-holder'>".$thread['content']."$img<div id='reacted'><p id='react_total'>Likes:0 Love:0 Frown:0</p></div></div><div class='reactions'><button id='like'>Like</button><button id='love'>Love</button><button id='frown'>Frown</button></div>";
	}

	public function commentholder(int $threadid, string $title)
	{
		$comments = $this->comments->threadComments(['threadid' => $threadid]);
		foreach ($comments as $comment) {
			$user = $comment['user'];
			$dt = $comment['comment_date'];
			$comment_content = $comment['comment'];
			echo "<div class='comment_holder'><div id='title_of_thread'><h3>Title:$title</h3><p>Comment by:<a id='commentator' href='user.php'>$user</a> Date:$dt</p></div><p>$comment_content</p><div id='reacted'><p id='react_total'>Likes:0 Love:0 Frown:0</p></div></div><div class='reactions'><button id='like'>Like</button><button id='love'>Love</button><button id='frown'>Frown</button></div>";
		}
	}
}