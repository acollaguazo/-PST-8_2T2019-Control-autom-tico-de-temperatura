<?php
class Accion{
    private $id_accion;
    private $id_Equipo;
    private $estado;


    public function __construct($id_accion, $id_Equipo, $estado ) {
        $this -> id_accion = $id_accion;
        $this -> id_Equipo = $id_Equipo;
        $this-> estado = $estado;
    }
    
    public function obtener_idEquipo() {
        return $this-> id_Equipo;        
    }
    public function obtener_idAccion() {
        return $this-> id_accion;        
    }
    
    public function obtener_estado() {
        return $this-> estado;        
    }
    
    
    
    public function cambiar_estado($estado) {
        return $this-> estado = $estado;        
    }
}

