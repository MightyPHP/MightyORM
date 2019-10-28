<?php

namespace MightyORM\MYSQL;
use PDO;

class DB{
    protected static $db = null;

    public function __construct($db) {
        $config = parse_ini_file(CONFIG_PATH."/databases.ini", true);
        if (isset($config[$db])) {
            $servername = $config[$db]['servername'];
            $username = $config[$db]['username'];
            $password = $config[$db]['password'];
            $database = $config[$db]['database'];
            try {
                $db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                DB::$db = $db;
            } catch (PDOException $e) {
                die($e);
            }
        } else {
            throw new Exception('Database does not exist');
        }
    }

    public static function describe($table, $obj){
        // echo "CREATE TABLE IF NOT EXISTS `$table` (`id` INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (`id`)";
        $data = DB::$db->prepare("CREATE TABLE IF NOT EXISTS $table (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (id))");
        $data->execute();

        $data = DB::$db->prepare("DESCRIBE $table");
        $data->execute();
        $data->setFetchMode(PDO::FETCH_INTO, $obj);
        // $data->setFetchMode(PDO::FETCH_COLUMN, 0);
        var_dump($data->fetch());
    }
}