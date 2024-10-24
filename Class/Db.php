<?php

class Db
{

    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $dbname = "db_ordering";

    public function connect()
    {
        try {
            $pdo = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw $e;
        }

        return $pdo;
    }
}
