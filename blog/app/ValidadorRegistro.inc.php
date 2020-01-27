<?php
include_once 'RepositorioUsuario.inc.php';

class ValidadorRegistro {
    
    private $aviso_inicio;
    private $aviso_cierre;
    
    private $nombre;
    private $email;
    private $clave;
    
    private $error_nombre;
    private $error_clave1;
    private $error_clave2;
    
    public function __construct($nombre, $clave1, $clave2, $conexion) {
        $this -> aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this -> aviso_cierre = "</div>";
        
        $this -> nombre = "";
        $this -> email = "";
        $this -> clave = "";
        
        $this -> error_nombre = $this -> validar_nombre($conexion, $nombre);
        $this -> error_clave1 = $this -> validar_clave1($clave1);
        $this -> error_clave2 = $this -> validar_clave2($clave1, $clave2);
        
        if ($this -> error_clave1 === "" && $this -> error_clave2 === "") {
            $this -> clave = $clave1;
        }
    }
    
    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }
    
    private function validar_nombre($conexion, $nombre) {
        if (!$this -> variable_iniciada($nombre)) {
            return "Debes escribir un nombre de usuario.";
        } else {
            $this -> nombre = $nombre;
        }
        
        if (strlen($nombre) < 6) {
            return "El nombre debe ser más largo que 6 caracteres.";
        }
        
        if (strlen($nombre) > 24) {
            return "El nombre no puede ocupar más de 24 caracteres.";
        }
        
        if (RepositorioUsuario :: nombre_existe($conexion, $nombre)) {
            return "Este nombre de usuario ya está en uso. Por favor, prueba otro nombre.";
        }
        
        return "";
    }
    
    private function validar_clave1($clave1) {
        if (!$this -> variable_iniciada($clave1)) {
            return "Debes escribir una contraseña.";
        }
        
        return "";
    }
    
    private function validar_clave2($clave1, $clave2) {
        if (!$this -> variable_iniciada($clave1)) {
            return "Primero debes rellenar la contraseña.";
        }
        
        if (!$this -> variable_iniciada($clave2)) {
            return "Debes repetir tu contraseña.";
        }
        
        if ($clave1 !== $clave2) {
            return "Ambas contraseñas deben coincidir.";
        }
        
        return "";
    }
    
    public function obtener_nombre() {
        return $this -> nombre;
    }
    
    public function obtener_clave() {
        return $this -> clave;
    }
    
    public function obtener_error_nombre() {
        return $this -> error_nombre;
    }
    
    public function obtener_error_clave1() {
        return $this -> error_clave1;
    }
    
    public function obtener_error_clave2() {
        return $this -> error_clave;
    }
    
    public function mostrar_nombre() {
        if ($this -> nombre !== "") {
            echo 'value="'. $this -> nombre . '"';
        }
    }
    
    public function mostrar_error_nombre() {
        if ($this -> error_nombre !== "") {
            echo $this -> aviso_inicio . $this -> error_nombre . $this -> aviso_cierre;
        }
    }
    
    public function mostrar_error_clave1() {
        if ($this -> error_clave1 !== "") {
            echo $this -> aviso_inicio . $this -> error_clave1 . $this -> aviso_cierre;
        }
    }
    
    public function mostrar_error_clave2() {
        if ($this -> error_clave2 !== "") {
            echo $this -> aviso_inicio . $this -> error_clave2 . $this -> aviso_cierre;
        }
    }
    
    public function registro_valido() {
        if ($this -> error_nombre === "" &&
                $this -> error_clave1 === "" &&
                $this -> error_clave2 === "") {
            return true;
        } else {
            return false;
        }
    }
}
