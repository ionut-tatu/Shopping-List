<?php

class DB 
{
	
	private $connection = null;

	public function __construct($hostname, $username, $password, $database, $port = '3306')
	{
		if(empty($hostname) || empty($username) || empty($database)) {
			echo '<p>It looks like the app/config/database.php is missing some config variables. Please check and try again!</p>';
			exit();
		}

		try {
			$this->connection = new \PDO("mysql:host=" . $hostname . ";port=" . $port . ";dbname=" . $database, $username, $password, array(\PDO::ATTR_PERSISTENT => true));
		} catch(\PDOException $e) {
			echo '<p>Opps! Something went wrong! Please config your database config file first at app/config/database.php.</p><p>' . $e->getMessage() . '</p>';
			exit();
		}

		$this->connection->exec("SET NAMES 'utf8'");
		$this->connection->exec("SET CHARACTER SET utf8");
		$this->connection->exec("SET CHARACTER_SET_CONNECTION=utf8");
		$this->connection->exec("SET SQL_MODE = ''");
	}

	public function prepare($sql) 
	{
		$this->statement = $this->connection->prepare($sql);
	}

	public function bindParam($parameter, $variable, $data_type = \PDO::PARAM_STR, $length = 0) 
	{
		if ($length) {
			$this->statement->bindParam($parameter, $variable, $data_type, $length);
		} else {
			$this->statement->bindParam($parameter, $variable, $data_type);
		}
	}

	public function execute() 
	{
		try {
			if ($this->statement && $this->statement->execute()) {
				$data = array();
				while ($row = $this->statement->fetch(\PDO::FETCH_ASSOC)) {
					$data[] = $row;
				}
				$result = new \stdClass();
				$result->row = (isset($data[0])) ? $data[0] : array();
				$result->rows = $data;
				$result->num_rows = $this->statement->rowCount();
			}
		} catch(\PDOException $e) {
			throw new \Exception('Error: ' . $e->getMessage() . ' Error Code : ' . $e->getCode());
		}
	}

	/**
	 * 	@param string $sql
	 *	@param array $params
	 *	@return Object $result
	 */
	public function query($sql, $params = array()) 
	{
		$this->statement = $this->connection->prepare($sql);
		
		$result = false;
		try {
			if ($this->statement && $this->statement->execute($params)) {
				$data = array();
				while ($row = $this->statement->fetch(\PDO::FETCH_ASSOC)) {
					$data[] = $row;
				}
				$result = new \stdClass();
				$result->row = (isset($data[0]) ? $data[0] : array());
				$result->rows = $data;
				$result->num_rows = $this->statement->rowCount();
			}
		} catch (\PDOException $e) {
			throw new \Exception('Error: ' . $e->getMessage() . ' Error Code : ' . $e->getCode() . ' <br />' . $sql);
		}
		if ($result) {
			return $result;
		} else {
			$result = new \stdClass();
			$result->row = array();
			$result->rows = array();
			$result->num_rows = 0;
			return $result;
		}
	}

	/**
	 *	@param string $value
	 *	@return string
	 */
	public function escape($value) 
	{
		return str_replace(array("\\", "\0", "\n", "\r", "\x1a", "'", '"'), array("\\\\", "\\0", "\\n", "\\r", "\Z", "\'", '\"'), $value);
	}

	/**
	 *	@return void
	 */
	public function __destruct()
	{
		$this->connection = null;
	}

}