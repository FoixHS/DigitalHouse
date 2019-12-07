<?php

class Usuario{

    //Atributos de Usuario

    public $nombre;
    public $apellido;
    public $email;
    public $pass;
    public $avatar;

    //Metodos de Usuario

    //Constructor de Usuario
    public function __construct($email, $nombre,$apellido,$pass,$avatar){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->pass = $pass;
        $this->avatar = $avatar;
    }

    //Getters de Usuario
    public function getNombre(){
        return $this->nombre;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPass(){
        return $this->pass;
    }
    public function getRePass(){
        return $this->rePass;
    }
    public function getAvatar(){
        return $this->avatar;
    }

    //Setters de Usuario
    public function setNombre($unNombre){
        $this->nombre = $unNombre;
    }
    public function setEmail($unEmail){
        $this->email = $unEmail;
    }
    public function setPass($unPass){
        $this->pass = $unPass;
    }
    public function setAvatar($unAvatar){
        $this->avatar = $unAvatar;
    }
}

?>
