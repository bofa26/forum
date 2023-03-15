<?php 
include_once 'app/config.php';


/**
 * 
 */
class Database
{
	private $conn;

	private function load_conn()
	{
		$config = load_config('database_config');
		$this->conn = new PDO($config['dsn'], $config['user'], $config['password']);
		$this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); 
		$this->conn->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

	}

	public function select(string $sql, array $data)
	{
		$this->load_conn();
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($data);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insert(string $sql, array $data)
	{
		$this->load_conn();
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($data);
	}

	public function selectAll($sql)
	{
		$this->load_conn();
		$query = $this->conn->query($sql);
		return $query->fetchAll();
	}

	public function lastId()
	{
		$this->load_conn();
		return $this->conn->lastInsertId();
	}
}