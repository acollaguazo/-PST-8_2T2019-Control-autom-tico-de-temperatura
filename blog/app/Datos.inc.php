<?php
class Datos{
    private $idDato;
    private $fecha;
    private $temperatura;
    private $idEquipo;
    
    public function __construct($idDato, $fecha, $temperatura, $idEquipo) {
        $this -> idDato = $idDato;
        $this -> fecha = $fecha;
        $this-> temperatura = $temperatura;
        $this-> idEquipo = $idEquipo;
    }
    
    public function obtenerIdDato() {
        return $this-> idDato;        
    }
    public function obtenerFecha() {
        return $this-> fecha;        
    }
    public function obtenerTemperatura() {
        return $this-> temperatura;        
    }
    public function obtenerIdEquipo() {
        return $this-> idEquipo;        
    }
    
    
    public function cambiarIdDato($idDato) {
        return $this-> idDato = $idDato;        
    }
    public function cambiarFecha($fecha) {
        return $this-> fecha = $fecha;        
    }
    public function cambiarTemperatura($temperatura) {
        return $this-> temperatura = $temperatura;        
    }
    public function cambiarIdEquipo($idEquipo) {
        return $this-> idEquipo = $idEquipo;        
    }
}

