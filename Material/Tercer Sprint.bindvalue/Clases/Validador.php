<?php
include '../funciones.php'

class Validador{

    public function estaVacio($campo){
        return $campo = "";
    }

    public function tieneFormatoEmail($email){
        return !filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function emailValido($email){
      return validarEmail($email);
    }

    public function cantidadMinima($password){
      return strlen($pass1) < 5;
    }

    public function sonDistintas($dato1,$dato2){
      return $dato1 != $dato2;
    }



        }




        
