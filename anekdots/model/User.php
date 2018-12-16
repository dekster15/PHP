<?php

class User
{
    private $login;
    private $password;
    private $rule;

	public function __construct($login, $password){
    $this->login = $login;
    $this->password = $password;
    $this->rule = 'user';
}
    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRule()
    {
        return $this->rule;
    }
}