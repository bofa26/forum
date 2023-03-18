<?php 

/**
 * 
 */
class Reacts
{

	public function total_thread_like(int $threadid)
	{
		$total_l = 0;
		$total ='SELECT liked FROM `react` WHERE threadid =:threadid';
		$likes = $this->select($total, ['threadid' => $threadid]);
		if ($likes == null) {
			return $total_l;
		}
		foreach ($likes as $like) {
			$total_l++;
		}
		return $total_l;	
	}

	public function total_thread_love(int $threadid)
	{
		$total_lo = 0;
		$total ='SELECT loved FROM `react` WHERE threadid =:threadid';
		$loves = $this->select($total, ['threadid' => $threadid]);
		if ($loves == null) {
			return $total_lo;
		}
		foreach ($loves as $love) {
			$total_lo++;
		}
		return $total_lo;		
	}

	public function total_thread_frown(int $threadid)
	{
		$total_f = 0;
		$total ='SELECT frown FROM `react` WHERE threadid =:threadid';
		$frowns = $this->select($total, ['threadid' => $threadid]);
		if ($frowns == null) {
			return $total_l;
		}
		foreach ($frowns as $frown) {
			$total_f++;
		}
		return $total_f;	
	}
}