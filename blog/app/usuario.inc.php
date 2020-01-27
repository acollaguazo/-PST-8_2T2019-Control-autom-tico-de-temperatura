<?php

class usuario {
    
    private $id;
    private $nombre;
    private $password;
    
    public function __construct($id, $nombre, $password) {
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> password = $password;
    }
    
    public function obtener_id() {
        return $this -> id;
    }
    
    public function obtener_nombre() {
        return $this -> nombre;
    }
    
    public function obtener_password() {
        return $this -> password;
    }
    
    public function cambiar_nombre($nombre) {
        $this -> nombre = $nombre;
    }
    
    public function cambiar_password($password) {
        $this -> password = $password;
    }
}
