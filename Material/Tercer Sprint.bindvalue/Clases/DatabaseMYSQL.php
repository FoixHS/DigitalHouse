<?php
include_once 'Database.php';
class DatabaseMYSQL extends Database
 {

    public $conexion;

    public function __construct(){
        $dsn = 'mysql:host=localhost;dbname=redanimal';
        $nombre_usuario = 'root';
        $contrasenia = 'root';
        $opciones = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );
        $con = mysqli_connect('localhost', 'root', 'root', 'redanimal');
        $this->conexion = new PDO($dsn, $nombre_usuario, $contrasenia, $opciones);
    }

    public function guardarUsuario(Usuario $usuario){
        $consulta = $this->conexion->prepare("INSERT INTO usuarios (id,nombre,apellido,email,pass,avatar)
        VALUES (null,':nombre',':apellido',':email',':password',':avatar' )");

        $consulta->bindValue(":nombre", $usuario->nombre, PDO::PARAM_STR);
        $consulta->bindValue(":apellido", $usuario->apellido, PDO::PARAM_STR);
        $consulta->bindValue(":email", $usuario->email, PDO::PARAM_STR);
        $consulta->bindValue(":password", $usuario->pass, PDO::PARAM_STR);
        $consulta->bindValue(":avatar", $usuario->avatar, PDO::PARAM_STR);

        $consulta->execute();

        return $this->conexion->lastInsertId();
    }

    public function traerUsuario($id){
        $consulta = $this->conexion->query("SELECT * FROM usuarios WHERE id = ".$id);
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }

    public function chequearUsuario($email){
      $consulta = $this->conexion->query("SELECT * FROM usuarios WHERE email = '$email'");
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
        return $usuario;

    }

		public function borrarUsuario($id){
      $consulta = $this->conexion->prepare("DELETE FROM usuarios  WHERE id = :id");

      $consulta->bindValue(":id", $id, PDO::PARAM_INT)

      $consulta->execute();
		}

    public function actualizarUsuario($nombre,$apellido,$email,$emailcorto){
        $consulta = $this->conexion->prepare("UPDATE usuarios SET nombre = '".$nombre."' , apellido = '".$apellido."', email = '".$email."',avatar = '".$emailcorto."'  WHERE id = ".$_SESSION["id"]);



        $consulta->execute();
    }



}
?>
