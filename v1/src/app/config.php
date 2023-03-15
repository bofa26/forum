<?php 


function database_config()
{
	$db_config = array(
						'dsn' => 'mysql:host=localhost;dbname=forum;charset=utf8',
						'user' => 'root',
						'password' => '',
					  );
	return $db_config;
}

function system_config()
{
	$system_config = array(
							'IP_ADDR' => $_SERVER['REMOTE_ADDR'], 
							'USER_AGENT' => getenv('HTTP_USER_AGENT')
						  );
	return $system_config;
}

function load_config($config)
{
	$config_data = call_user_func($config);
	return $config_data;
}