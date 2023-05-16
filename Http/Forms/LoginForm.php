<?php

namespace Http\Forms;
use Core\ValidationExeption;
use Core\Validator;

class LoginForm {

public $attributes;
protected $errors = [];

public function __construct(public array $attributes)
{

    if (!Validator::email($attributes['email'])) 
    {

        $this->errors['email'] = 'Please provide a valid email address.';

    }

    if (!Validator::string($attributes['password'])) 
    {

        $this->errors['password'] = 'Please provide a valid password.';

    }
}
public static function validate($attributes)
{
    $instance= new static($attributes);

    return $instance->failed() ? $instance->failed() : $instance;

}

public function throw()
{

    
    ValidationExeption::throw($this->errors(), $this->attributes);

}

public function failed()
{

    return count($this->errors);
   
   }

public function errors()
{

    return $this->errors();

}

public function error($field, $message){

    $this->errors[$field] = $message;

    return $this;

}

}

?>