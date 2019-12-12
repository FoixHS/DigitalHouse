<?php

class Validador{

    public function validarRegistro(){
      $errorNombre = "";
      $errorEmail = "";
      $errorPass1 = "";
      $errorPass2 = "";
      $errorFoto= "";
      $nombre = "";
      $email = "";

      if($_POST){
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $pass1 = $_POST["pass1"];
        $pass2 = $_POST["pass2"];
        $avatar = $_FILE["avatar"]["name"];
        $errores = false;
        $emailCorto = substr_replace($email ,"",-4);

        if($nombre == ""){
          $errorNombre = "*El nombre es obligatorio";
          $errores = true;
        }

        if($email == ""){
          $errorEmail = "*El email es obligatorio";
          $errores = true;
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $errorEmail = "*Se requiere formato de email";
          $errores = true;
        }else if(validarEmail($email)){
          $errorEmail = "*El email ya fue utilizado";
          $errores = true;
        }

        if($pass1 == ""){
          $errorPass1 = "*La contraseña es obligatoria";
          $errores = true;
        }else if(strlen($pass1) < 5){
          $errorPass1 = "*La contraseña debe tener más de 5 caracteres";
          $errores = true;
        }

        if($pass2 == ""){
          $errorPass2 = "*Repetir la contraseña es obligatorio";
          $errores = true;
        }else if($pass1 != $pass2){
          $errorPass1 = "*Las contraseñas deben ser iguales";
          $errorPass2 = "*Las contraseñas deben ser iguales";
          $errores = true;
        }

        if($_FILES){
          if($_FILES["avatar"]["error"]!=0){
            $errorFoto="Hubo un error al cargar la foto";
            $errores=true;
          }else{
            $ext = pathinfo($_FILES["avatar"]["name"],PATHINFO_EXTENSION);
            if($ext!="jpg" && $ext!="jpeg" && $ext!="png"){
              $errorFoto="La foto debe ser un archivo jpg, jpeg o png";
              $errores=true;
            }else{
              move_uploaded_file($_FILES["avatar"]["tmp_name"], "../avatar/$emailCorto." . $ext);
            }
          }
        }
    }  return $errores;
  }


}
