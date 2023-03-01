<?php 

namespace app\core;

abstract class Model 
{
    public const RULE_REQUIRED = 'required';
    public const RULE_ID = 'id';
    public const RULE_PHONE = 'phone';
    public const RULE_EMAIL = 'email';

    public function loadData($data)
    {
        foreach($data as $key => $value){
            if(property_exists($this, $key)){
                $this->{$key} = $value;
            }
        } 
    }

    abstract public function rules() : array;

    public array $errors = [];

    public function validate()
    {
        foreach($this->rules() as $attribute => $rules) {

            $value = $this->{$attribute};

            foreach($rules as $rule) {

                $ruleName = $rule;

                if(!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                if($ruleName === self::RULE_ID && !filter_var($value, FILTER_VALIDATE_INT)) {
                    $this->addError($attribute, self::RULE_ID);
                }
                if($ruleName === self::RULE_PHONE && !preg_match('/^[0-9]{10}+$/', $value)) {
                    $this->addError($attribute, self::RULE_PHONE);
                }
            }
        }
        return empty($this->errors);
    }

    public function addError(string $attribute, string $rule) 
    {
        $message = $this->errorMessages()[$rule] ?? '';
        $this->errors[$attribute][] = $message;
        echo "$message\n";
    }

    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => "This field is required, please fill",
            self::RULE_EMAIL => "Please enter a valid email address (for example: 123@gmail.com)",
            self::RULE_ID => "The ID must contain only numbers",
            self::RULE_PHONE => "Please enter a valid phone number. For example: 0991234567",
        ];
    }
}