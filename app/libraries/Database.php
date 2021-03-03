<?php
/*
 * PDO Database Class
 * Connect to database
 * Create Prepared statements
 * Bind Values
 * Return Rows and Results 
 */
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        //set DSN 
        $dsn = 'mysql:host='. $this->host.';dbname='.$this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        // Create PDO Instance
        try {
            $this->dbh = new PDO($dsn,$this->user,$this->pass,$options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Prepare statement with query
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    //Bind Value 
    public function bind($param,$value, $type=null)
    {
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
        $this->stmt->bindValue($param,$value,$type);
    }
    // EXecute The Prepared Statement
    public function execute()
    {
        return $this->stmt->execute();
    }

    //Get result Set as array of Object 
    public function resultSet($mode=null)
    {
        $this->execute();
        if(is_null($mode))
        {
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }else{
            return $this->stmt->fetchAll($mode);
        }
    }

    //Get Single record as object 
    public function single($mode=null)
    {
        $this->execute();
        if(is_null($mode))
        {
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }else{
            return $this->stmt->fetch($mode);
        }
    }

    //Get Row Count
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }


}