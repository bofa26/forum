<?php 

/**
 * 
 */
class Auth extends Database
{
	public ?Session $session = null;

	function __construct(array $config, Session $session)
	{
		$this->session = $session;
	}
	
	public function signup(array $data)
	{
		$user = $this->user_exists($data['email']);
		if ($user == null) {
			$signup = "INSERT INTO eusers(username, email, password, gender, address, joined) VALUES(:username, :email, :password, :gender, :address, :joined)";
			$this->insert($signup, $data);
			$user = $this->user($this->lastId());
			foreach ($user as $k => $v) {
				$this->session->setSession($k, $v);
			}
			return true;
		}
		return false;
	}
}