<?php 


/**
 * 
 */
class Threads extends Database
{
	protected ?Comments $comments = null;
	
	function __construct(Comments $comments)
	{
		$this->comments = $comments;
	}

	public function total_thread_views(int $threadid):int
	{
		$total_v = 0;
		$total ='SELECT viewed FROM `views` WHERE threadid =:threadid';
		$views = $this->select($total, ['threadid' => $threadid]);
		if ($views == null) {
			return $total_v;
		}
		$total_v = count($views);
		return $total_v;
	}

	public function frontpage_threads()
	{
		$fp = "SELECT * FROM `fp`";
		return $this->selectAll($fp);

	}

	public function new_thread(array $data)
	{
		$this->insert('fp', $data);
	}

	public function has_viewed_thread(string $user, int $threadid)
	{
		$viewed = "SELECT address FROM views WHERE address=:address AND threadid=:threadid";
		$viewed_th = $this->select($viewed, ['address' => $user, 'threadid' => $threadid]);
		if ($viewed_th == null) {
			return false;
		}
		return true;
	}

	public function view_thread(array $data)
	{
		$create_view = "INSERT INTO views(threadid, viewed, title, address, dateviewed) VALUES(:threadid, :viewed, :title, :address, :dateviewed)";
		$this->insert($create_view, $data);
	}

	public function thread(int $threadid)
	{
		$thread = "SELECT * FROM fp WHERE threadid=:threadid";
		return $this->select($thread, ['threadid' => $threadid]);
	}
}