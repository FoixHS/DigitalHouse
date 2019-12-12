<?php
  session_start();
  require_once '../funciones.php';
  require_once '../Clases/DatabaseMYSQL.php';
  require_once '../Clases/Usuario.php';

  $bd = new DatabaseMYSQL;
  $usuario = $bd->traerUsuario($_SESSION["id"]);
  $bd->borrarUsuario($_SESSION["id"]);

  session_destroy();
  header("Location: ../registro/registro.php");

 ?>
