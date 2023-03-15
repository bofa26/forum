<?php 


/**
 * 
 */
class Comments extends Database
{
	public function threadComments(array $data)
	{
		$comments = "SELECT comment, comment_date, user FROM comments WHERE threadid=:threadid";
		return $this->select($data);
	}

	public function total_thread_comments(int $threadid)
	{
		$total_c = 0;
		$threadComments = "SELECT comment FROM comments WHERE threadid=:threadid";
		$comments =  $this->select($threadComments, ['threadid' => $threadid]);
		if ($comments == null) {
			return $total_c;
		}
		$total_c = count($comments);
		return $total_c;
	}
	
}