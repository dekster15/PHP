<?php
class Session{
    public function __construct(){
        session_start();
    }

    public function createVarOfSession($name, $value){
        $_SESSION[$name] = $value;
    }

    public function deleteVarOfSession($name){
        unset($_SESSION[$name]);
    }

    public function checkIssetVarOfSession($name){
        return isset($_SESSION[$name]);
    }
public function getVarOfSession($name){
    return $_SESSION[$name];
}
    public function sessionDestroy(){
        session_destroy();
    }
}

?>