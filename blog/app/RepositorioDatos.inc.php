<?php

class RepositorioDatos {

    public static function obtener_todos($conexion) {

        $datos = array();

        if (isset($conexion)) {
            try {

                include 'Datos.inc.php';

                $sql = "SELECT * FROM datos";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $datos[] = new Datos(
                                $fila['idDato'], $fila['fecha'], $fila['temperatura'], $fila['idEquipo']
                        );
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

    public static function obtener_cant_datos($conexion) {
        $total_datos = null;

        if (isset($conexion)) {
            try {
                $sql = "SELECT COUNT(*) as total FROM datos";

                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                $total_datos = $resultado['total'];
            } catch (Exception $ex) {
                print 'ERROR ' . $ex->getMesasge();
            }
        }

        return $total_datos;
    }

    public static function obtener_datos_por_idEqp($conexion, $idEqp) {
        $datos = array();

        if (isset($conexion)) {
            try {
                include_once 'Datos.inc.php';

                $sql = "SELECT * FROM datos WHERE idEquipo = :idEquipo";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':idEquipo', $idEqp, PDO::PARAM_STR);

                $sentencia->execute();

                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $datos[] = new Datos(
                                $fila['idDato'], $fila['fecha'], $fila['temperatura'], $fila['idEquipo']
                        );
                    }
                } else {
                    echo "<br><div class='alert alert-danger' role='alert'>";
                    echo 'No ha sensado aun el dispositivo';
                    echo "</div><br>";
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $datos;
    }

}
