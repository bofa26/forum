<?php 


/**
 * 
 */
class ContentView extends IndexView
{
	
	function __construct(Comments $comments, Reacts $reacts, Session $session)
	{
		parent::__construct($comments, $reacts, $session);
	}

	public function reactions():string
	{
		$reactions = "";
		if ($this->session->isSession('userid')) {
			$reactions = "<div class='reactions'><button id='like'>Like</button><button id='love'>Love</button><button id='frown'>Frown</button></div>";
		}
		return $reactions;
	}

	public function imageDisplay(string $imgpath):string
	{
		$img = "";
		if ($imgpath != 'no image') {
			$src = $imgpath;
			$img = "<div class='image_holder'><img alt='content-image' src='$src' height='500'></div>"; 
		}
		return $img;
	}

	public function content_container(array $thread)
	{
		$img = $this->imageDisplay($thread['img']);
		$likes = $this->reacts->total_thread_reaction($thread['threadid'], 'like');
		$loves = $this->reacts->total_thread_reaction($thread['threadid'], 'love');
		$frowns = $this->reacts->total_thread_reaction($thread['threadid'], 'frown');
		echo "<div class='content-holder'>".$thread['content']."$img<div id='reacted'><p id='react_total'>Likes:$likes Love:$loves Frown:$frowns</p></div></div>".$this->reactions();
	}

	public function commentholder(int $threadid, string $title)
	{
		$comments = $this->comments->threadComments(['threadid' => $threadid]);	
		foreach ($comments as $comment) {
			$likes = $this->reacts->total_comment_reaction($threadid, $comment['comment_id'], 'like');
			$loves = $this->reacts->total_comment_reaction($threadid, $comment['comment_id'], 'love');
			$frowns = $this->reacts->total_comment_reaction($threadid, $comment['comment_id'], 'frown');
			$user = $comment['user'];
			$dt = $comment['comment_date'];
			$comment_content = $comment['comment'];
			echo "<div class='comment_holder'><div id='title_of_thread'><h3>Title:$title</h3><p>Comment by:<a id='commentator' href='user.php'>$user</a> Date:$dt</p></div><p>$comment_content</p><div id='reacted'><p id='react_total'>Likes:$likes Love:$loves Frown:$frowns</p></div></div>".$this->reactions();
		}
	}
}