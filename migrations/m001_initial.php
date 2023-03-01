<?php

use app\core\Application;

class m001_initial
{
    public function up()
    {
        $db = Application::$app->db;

        $SQL = "CREATE TABLE Client (
            Ref varchar(30) NOT NULL PRIMARY KEY, 
            idClient int NOT NULL, 
            dateCurr timestamp NOT NULL, 
            phone varchar(45) NULL, 
            email varchar(45) NULL, 
            address varchar(45) NULL,
            monthSalary numeric(15,2) NULL, 
            currSalary char(3) NULL, 
            decision varchar(45) NULL,
            limitLog numeric (15,2) NULL
            ) ENGINE=INNODB;";

        $db->pdo->exec($SQL);
    }

    public function dowm()
    {
        $db = Application::$app->db;

        $SQL = "DROP TABLE Client;";

        $db->pdo->exec($SQL);
    }
}