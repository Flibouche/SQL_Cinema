<?php

namespace Service;

class Session
{

    public function setUser($user){
        $_SESSION["user"] = $user;
    }
    public function getUser(){
        return isset($_SESSION["user"]) ? $_SESSION["user"] : false;
    }

    public function isAdmin(){
        if ($this->getUser() && $this->getUser()["role"] == "ROLE_ADMIN"){
            return true;
        }
        return false;
    }
}
?>