<?php 


/**
 * 
 */
class IndexView extends Threads
{
	public ?Session $session = null;

	function __construct(Comments $comments, Reacts $reacts, Session $session)
	{
		parent::__construct($comments, $reacts);
		$this->session = $session;
	}

	public function header_view()
	{
		if (! $this->session->isSession('userid')) {
			echo '<button id="sign">Sign up</button>';
			echo '<button id="login">Login</button>';
			echo '<div id="userid"><p id="userd">Guest</p></div>';
		}else{
			echo '<button id="logout">Logout</button>';
			echo '<button id="profile">Profile</button>';
			echo '<div id="userid"><p id="userd">'.$this->session->getSession('username').'</p></div>';
		}
	}

	public function container_list_view()
	{
		$fps = $this->frontpage_threads();
		foreach ($fps as $fp) {
			$fpid = $fp['threadid'];
			echo "<li><a href='content.php?threadid=$fpid'>".htmlentities($fp['title'])."</a><p id='details'>views:".$this->total_thread_views($fpid)." created:".$fp['created']." comments:".$this->comments->total_thread_comments($fpid)."</p></li>";
		}	
	}
}