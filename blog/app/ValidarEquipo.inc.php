<?php

include_once 'app/RepositorioEquipos.inc.php';

class ValidarEquipo {

    private $aviso_inicio;
    private $aviso_cierre;
    
    private $nombreEquipo;
    private $idEquipo;
    
    private $error_nombEqp;
    private $error_idEqp;

    public function __construct($idEquipo, $nombreEquipo, $conexion) {

        $this -> aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this -> aviso_cierre = "</div>";
        
        $this -> nombreEquipo = "";
        $this -> idEquipo = "";
        
        $this -> error_nombEqp = $this -> validar_nombre($conexion, $nombreEquipo);
        $this -> error_idEqp = $this -> validar_id($conexion, $idEquipo);
    }

    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    private function validar_nombre($conexion, $nombreEquipo) {
        if (!$this->variable_iniciada($nombreEquipo)) {
            return 'Debes escribir el nombre del equipo';
        } else {
            $this->nombreEquipo = $nombreEquipo;
        }
        if (strlen($nombreEquipo) < 6) {
            return 'El nombre debe ser mayor a 6 caracteres';
        }

        if (strlen($nombreEquipo) > 25) {
            return 'El nombre no puede ser mayor a 25 caracteres';
        }
        if (RepositorioEquipos :: nombre_existe($conexion, $nombreEquipo)) {
            return "Este nombre de usuario ya está en uso. Por favor, prueba otro nombre.";
        }
        return '';
    }
    
    private function validar_id($conexion, $idEquipo) {
        if (!$this->variable_iniciada($idEquipo)) {
            return 'Debes escribir el codigo del equipo';
        } else {
            $this->idEquipo = $idEquipo;
        }
        if (RepositorioEquipos :: id_existe($conexion, $idEquipo)) {
            return "El codigo ingresado ya se encuentra registrado. Por favor, ingresa otro codigo.";
        }
        return '';
    }
    
    

    public function obtener_nombEquipo() {
        return $this->nombreEquipo;
    }

    public function obtener_error_nombEquipo() {
        return $this->error_nombEqp;
    }

    public function cambiar_nombEquipo($nombreEquipo) {
        return $this-> nombreEquipo = $nombreEquipo;
    }

    public function cambiar_error_nombEquipo($error_nombEqp) {
        return $this->error_nombEqp = $error_nombEqp;
    }
    
    
    
    public function obtener_idEquipo() {
        return $this->idEquipo;
    }

    public function obtener_error_idEquipo() {
        return $this->error_idEqp;
    }

    public function cambiar_idEquipo($idEquipo) {
        return $this->idEquipo = $idEquipo;
    }

    public function cambiar_error_idEquipo($error_idEqp) {
        return $this->error_idEqp = $error_idEqp;
    }
    
    

    public function mostrar_error_nomEquipo() {
        if ($this->error_nombEqp !== "") {
            echo $this->aviso_inicio . $this->error_nombEqp . $this->aviso_cierre;
        }
    }
    public function mostrar_error_idEquipo() {
        if ($this->error_idEqp !== "") {
            echo $this->aviso_inicio . $this->error_idEqp . $this->aviso_cierre;
        }
    }
    
    public function equipo_valido() {
        if ($this-> error_nombEqp === "" && $this -> error_idEqp === ""){
            return true;
        }else{
            return false;
        }
    }

}
