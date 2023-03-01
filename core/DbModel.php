<?php 

namespace app\core;

abstract class DbModel extends Model
{
    public function save($attr)
    {
        $sql = "INSERT INTO Client (Ref,idClient,dateCurr,phone,email,address,monthSalary,currSalary,decision,limitLog)
                  VALUES (:Ref,:idClient,:dateCurr,:phone,:email,:address,:monthSalary,:currSalary,:decision,:limitLog)";

        $statement = Application::$app->db->pdo->prepare($sql);

        $statement->execute($attr);
    }
}