<?php
class Equipo{
    private $id_equipo;
    private $nombre_Eqp;
    private $id_Usuario;


    public function __construct($id_equipo, $nombre_Eqp, $id_Usuario ) {
        $this -> id_equipo = $id_equipo;
        $this -> nombre_Eqp = $nombre_Eqp;
        $this-> id_Usuario = $id_Usuario;
    }
    
    public function obtener_idEquipo() {
        return $this-> id_equipo;        
    }
    public function obtener_nombreEqp() {
        return $this-> nombre_Eqp;        
    }
    
    public function obtener_idUsuario() {
        return $this-> id_Usuario;        
    }
    
    
    
    public function cambiar_idEquipo($id_equipo) {
        return $this-> id_Equipo = $id_equipo;        
    }
    public function cambiar_nombreEqp($nombre_Eqp) {
        return $this-> nombre_Eqp = $nombre_Eqp;        
    }
    
}
