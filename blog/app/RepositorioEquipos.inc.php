<?php

class RepositorioEquipos {

    public static function obtener_equipos($conexion) {

        $datos = array();

        if (isset($conexion)) {
            try {

                include 'Equipo.inc.php';

                $sql = "SELECT * FROM equipo";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $datos[] = new Equipo(
                                $fila['idEquipo'], $fila['nombreEqp'], $fila['idUsuario'] );
                    }
                } else {
                    print 'No hay resultado';
                }
            } catch (Exception $ex) {
                print "Error" . $ex->getMessage();
            }
        }
        
        return $datos;
    }

    public static function obtener_cant_equipos($conexion) {
        $total_equipos = null;

        if (isset($conexion)) {
            try {
                $sql = "SELECT COUNT(*) as total FROM equipo";

                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                $total_equipos = $resultado['total'];
            } catch (Exception $ex) {
                print 'ERROR ' . $ex->getMesasge();
            }
        }

        return $total_equipos;
    }

    public static function insertar_equipo($conexion, $equipo) {
        $equipo_insertado = false;

        if (isset($conexion)) {
            try {
                
                $sql = "INSERT INTO equipo(idEquipo, nombreEqp, idUsuario) VALUES(:id, :nombre, :idUser)";

                $sentencia = $conexion->prepare($sql);
                
                $idEqp = $equipo->obtener_idEquipo();
                $nombEqp = $equipo->obtener_nombreEqp();
                $idUser = $equipo->obtener_idUsuario();

                $sentencia->bindParam(':id', $idEqp, PDO::PARAM_INT);
                $sentencia->bindParam(':nombre', $nombEqp, PDO::PARAM_STR);
                $sentencia->bindParam(':idUser', $idUser, PDO::PARAM_INT);

                $equipo_insertado = $sentencia->execute();
                
            } catch (PDOException $ex) {
                print'Error ' . $ex->getMessage();
            }
        }
        return $equipo_insertado;
        
    }
    
    public static function nombre_existe($conexion, $nombre) {
        $nombre_existe = true;
        
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM equipo WHERE nombreEqp = :nombre";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    $nombre_existe = true;
                } else {
                    $nombre_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $nombre_existe;
    }
    public static function id_existe($conexion, $id) {
        $id_existe = true;
        
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM equipo WHERE idEquipo = :id";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    $id_existe = true;
                } else {
                    $id_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $id_existe;
    }
    
    public static function obtener_equipos_por_idUser($conexion, $idUser) {
        $datos = array();
        
        if (isset($conexion)) {
            try {
                include_once 'Equipo.inc.php';
                
                $sql = "SELECT * FROM equipo WHERE idUsuario = :idUsuario";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':idUsuario', $idUser, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach ($resultado as $fila){
                        $datos[] = new Equipo(
                                $fila['idEquipo'], $fila['nombreEqp'], $fila['idUsuario']
                                );
                    }
                }else{
                    print 'No hay resultado';
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $datos;
    }

}
