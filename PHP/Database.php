
<?php

class Database{
	
	private $host;
	private $user;
	private $pass;
	private $dbname;

	private $dbh;
	private $error;
	private $stmt;

	public function __construct($host, $dbname, $user, $pass){

		$this->host = $host;
		$this->user = $user;
		$this->dbname = $dbname;
		$this->pass = $pass;

		// Set DSN
		$dsn = 'mysql:host='. $this->host . ';dbname='. $this->dbname;

		// Set Options
		$options = array(
			PDO::ATTR_PERSISTENT		=> true,
			PDO::ATTR_ERRMODE		=> PDO::ERRMODE_EXCEPTION
		);

		// Create new PDO
		try {
			$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
		} catch(PDOEception $e){
			$this->error = $e->getMessage();
		}
	}



	public function query($query){
		$this->stmt = $this->dbh->prepare($query);
	}



	public function bind($param, $value, $type = null){
		if(is_null($type)){
			switch(true){
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
					default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}



	public function execute(){
		return $this->stmt->execute();
	}



	public function resultset(){
		$this->execute();
		$result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		return (is_array($result) ? $result : 'data not found');
	}
}