<?php
abstract class Database{
    abstract public function guardarUsuario(usuario $usuario);
    abstract public function traerUsuario($id);
    abstract public function borrarUsuario($id);
    abstract public function actualizarUsuario($nombre,$apellido,$email,$emailcorto);
}
