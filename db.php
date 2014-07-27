<?php
/**
* 
*/
class DB {
	private $host = "localhost";
	private $db = "anonyme";
	private $password = "";
	private $user ="root";
	private $dbh;
    private $error;
    private $stmt;

	function __construct()
	{
		# code...
		try {
        
         $dsn = "mysql:host=". $this->host.";dbname=".$this->db;
         $options = array(
                 PDO::ATTR_PERSISTENT => true, 
                 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                 );
         $this->dbh = new PDO($dsn, $this->user, $this->password,$options);

         

			
		} catch (PDOException $e) {

			print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
			
		}
  	}
  	public function query($query){
    $this->stmt = $this->dbh->prepare($query);
    }



    public function execute(){
    return $this->stmt->execute();
    }



    public function resultset(){
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   public function lastInsertId(){
    return $this->dbh->lastInsertId();
   }
   public function rowCount(){
    return $this->stmt->rowCount();
}

   public function bind($param, $value, $type = null){
    if (is_null($type)) {
        switch (true) {
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
}


//*********** Utilisation *******//

/**  $database = new Db();


/**
/** $database->query('SELECT FName, LName, Age, Gender FROM mytable WHERE LName = :lname');
/** $database->bind(':lname', 'Smith');
/** $rows = $database->resultset();
/**
/** echo $database->rowCount();





//*******     fin       *************///

?>
