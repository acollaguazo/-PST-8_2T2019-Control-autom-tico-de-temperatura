<?php

class RepositorioAccion {
 
    public static function obtener_estado($conexion, $idEquipo) {
        
        $actuador = null;
        
        if (isset($conexion)) {
            try {
                include_once 'Accion.inc.php';
                
                $sql = "SELECT * FROM accion WHERE idEquipo = :idEqp";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':idEqp', $idEquipo, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetch();
                
                if (!empty($resultado)) {
                    $actuador = new Accion($resultado['idAccion'],
                            $resultado['idEquipo'],
                            $resultado['estado']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $actuador;
    }
    
    public static function insertar_accion($conexion, $actuador) {
        $accion_insertado = false;
        
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO accion (idEquipo, estado) VALUES(:idEqp, :estado)";
                
                $sentencia = $conexion -> prepare($sql);
                
                $id_eqp = $actuador -> obtener_idEquipo();
                $estado_eqp = $actuador -> obtener_estado();
                
                $sentencia -> bindParam(':idEqp',$id_eqp , PDO::PARAM_STR);
                $sentencia -> bindParam(':estado', $estado_eqp, PDO::PARAM_STR);
                
                $accion_insertado = $sentencia -> execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        
        return $accion_insertado;
    }
    
    public static function actualizar_estado($conexion, $id_actuador, $nueva_estado) {
        $actualizacion_correcta = false;

        if (isset($conexion)) {
            try  {
                $sql = "UPDATE accion SET estado = :estado WHERE idAccion = :idAccion";

                $sentencia = $conexion -> prepare($sql);

                $sentencia -> bindParam(':idAccion', $nueva_estado, PDO::PARAM_STR);
                $sentencia -> bindParam(':idAccion', $id_actuador, PDO::PARAM_STR);

                $sentencia -> execute();

                $resultado = $sentencia -> rowCount();

                if (count($resultado)) {
                    $actualizacion_correcta = true;
                } else {
                    $actualizacion_correcta = false;
                }
            } catch(PDOException $ex) {
                print 'ERROR'.$ex -> getMessage();
            }
        }

        return $actualizacion_correcta;
    }
    
    
    
    
}