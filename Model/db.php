<?php

class Database{

    protected $url;
    protected $user;
    protected $password;
    protected $db;
    protected $connection = null;

    public function __construct($url, $user, $password, $db)
    {
        $this->url = $url;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;
    }
    public function __destruct()
    {
        if($this->connection != null){
            $this->closeConnection();
        }
    }

    public function fetchArray($query){
        return $query->fetch_array();
    }
    protected function makeConnection(){

        $this->connection = new mysqli($this->url, $this->user, $this->password, $this->db);
        if($this->connection->connect_error){
            echo "Fail" . $this->connection->connect_error;
        }
    }
    protected function closeConnection(){
        if($this->connection != null){
            $this->connection->close();
            $this->connection = null;
        }
    }
    public function executeQuery($query, $params = null){
        // Is there a DB connection?
        $this->makeConnection();
        // Adjust query with params if available
        if($params != null){
            // Change ? to values from parameter array
            $queryParts = preg_split("/\?/", $query);
            // if amount of ? is not equal to amount of values => error
            if(count($queryParts) != count($params) + 1){
                return false;
            }
            // Add first part
            $finalQuery = $queryParts[0];
            // Loop over all parameters
            for($i = 0; $i < count($params); $i++){
                // Add clean parameter to query
               /* echo $params[$i];*/
                $finalQuery = $finalQuery . $this->cleanParameters($params[$i]) . $queryParts[$i + 1];
            }
            $query = $finalQuery;
            echo $finalQuery;
        }
        // Check for SQL injection

        $result = $this->connection->query($query);
        return $result;
    }
    protected function cleanParameters($parameters){
        // prevent SQL injection
        $result = $this->connection->real_escape_string($parameters);
        return $result;
    }
}

?>