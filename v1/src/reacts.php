<?php 


/**
 * 
 */
class Reacts extends Database
{
	
	public function total_thread_reaction(int $threadid, string $reaction)
	{
		$total ='SELECT reaction FROM `react` WHERE threadid =:threadid AND reaction=:reaction';
		$reactions = $this->select($total, ['threadid' => $threadid, 'reaction' => $reaction], true);
		if ($reactions == null) {
			return $total_r;
		}

		$total_r = 0;

		foreach ($reactions as $reaction) {
			$total_r++;
		}
		return $total_r;
	}

	public function total_comment_reaction(int $threadid, int $commentid, string $react)
	{
		$reacts = "SELECT  reaction FROM `comment_react` WHERE threadid=:threadid AND comment_id=:comment_id ORDER BY ASC";
		$reactions = $this->select($reacts, ['threadid' => $threadid, 'comment_id' => $commentid], true);
		if ($reactions == null) {
			return "";
		}

		$total_r = 0;

		foreach($reactions as $reaction){
			if ($reaction === $react) {
				$total_r++;
			}
		}
		return $total_r;
	}
}