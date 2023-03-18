<?php 


/**
 * 
 */
class Comments extends Database
{
	public function threadComments(array $data):array
	{
		$comments = "SELECT comment, comment_date, user FROM comments WHERE threadid=:threadid";
		return $this->select($comments,	$data, true);
	}

	public function total_thread_comments(int $threadid):int
	{
		$total_c = 0;
		$threadComments = "SELECT comment FROM comments WHERE threadid=:threadid";
		$comments =  $this->select($threadComments, ['threadid' => $threadid], true);
		if ($comments == null) {
			return $total_c;
		}
		foreach ($comments as $comment) {
			$total_c++;
		}
		return $total_c;
	}
	
}