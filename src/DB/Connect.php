<?php

namespace MightyORM\DB;

class Connect{
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
                return $db;
            } catch (PDOException $e) {
                die($e);
            }
        } else {
            throw new Exception('Database does not exist');
        }
    }
}