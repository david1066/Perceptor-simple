<?php

include_once("Model/db.php");

class DatabaseFactory{
    // Singleton
    private static $connection;

    public static function getDatabase(){
        if(self::$connection == null){
            $url = "www.db4free.net";
            $user = "david1066";
            $passw = "Megadeth";
            $db = "perceptor_simple";
            self::$connection = new Database($url, $user, $passw, $db);
        }
        return self::$connection;
    }
}

?>