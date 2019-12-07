<?php
abstract class Database{
    abstract public function guardarUsuario(usuario $usuario);
    abstract public function traerUsuario($id);
    abstract public function borrarUsuario();
    abstract public function actualizarUsuario($nombre,$email);
}
