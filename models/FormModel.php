<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\Model;

class FormModel extends DbModel
{

    public string $idClient;
    public string $birthday;
    public string $phone;
    public string $email;
    public string $requestLimit;


    public function tableName(): string
    {
        return 'Client';
    }

    public function handleForm($data)
    {

        $Ref         = $this->generateRef(10); 
        $idClient    = $data['idClient']; 
        $email       = $data['email'];
        $address     = $data['address'];
        $phone       = $data['phone']; 
        $dateCurr    = date('Y-m-d H:i:s'); 
        $monthSalary = $data['monthSalary'];
        $currSalary  = $data['currSalary'];
        $mobOperator = substr($phone, 0, 3);

        if ($monthSalary == '') {
            $monthSalary = 0;
        }
        
        $isAdult = $this->isAdult($data['birthday']); 

        $income = $this->convertMoney($monthSalary, $currSalary); 

        $key = $this->getKey($mobOperator);

        $limitLog = $this->calculate($key, $income);

        if ($limitLog > 0 && $isAdult) {

            $decision = "accept";

            if ($limitLog > $data['requestLimit']) $limitLog = $data['requestLimit'];
        } else {
            $decision = "decline";
        }

        $values = [
            'Ref' => $Ref,
            'idClient' => $idClient,
            'dateCurr' => $dateCurr,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'monthSalary' => $monthSalary,
            'currSalary' => $currSalary,
            'decision' => $decision,
            'limitLog' => $limitLog,
        ];

        $this->save($values);

        return $Ref;
    }

    public function rules(): array
    {
        return [
            'idClient' => [self::RULE_REQUIRED, self::RULE_ID],
            'birthday' => [self::RULE_REQUIRED],
            'phone' => [self::RULE_PHONE],
            'email' => [self::RULE_EMAIL],
            'requestLimit' => [self::RULE_REQUIRED],
        ];
    }

    public function generateRef($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    public function isAdult($birthday)
    {
        $age = 18;
        if (is_string($birthday)) {
            $birthday = strtotime($birthday);
        }

        if (time() - $birthday < $age * 31536000) {
            return false;
        }

        return true;
    }

    public function convertMoney($monthSalary, $currency)
    {
        $req_url = "https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5";
        $jsonObject = json_decode(file_get_contents($req_url));
        $converted = 0.0;

        switch ($currency) {
            case 'USD':
                $converted = round(($monthSalary * $jsonObject[0]->sale), 2);
                break;
            case 'EUR':
                $converted = round(($monthSalary * $jsonObject[1]->sale), 2);
                break;
            case 'UAH':
                $converted = round($monthSalary, 2);
                break;
        }
        return $converted;
    }

    public function getKey($mobOperator)
    {
        $key = 0;

        switch ($mobOperator) {
            case '039';
            case '067';
            case '068';
            case '096';
            case '097';
            case '098';
                $key = 0.95;
                break;
            case '050';
            case '066';
            case '096';
            case '099';
                $key = 0.94;
                break;
            case '063';
            case '093';
                $key = 0.93;
                break;
            default;
                $key = 0.92;
                break;
        }
        return $key;
    }

    public function calculate($key, $income)
    {
        return $key * $income;
    }
}
