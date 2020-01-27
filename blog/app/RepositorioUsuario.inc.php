<?php

class RepositorioUsuario {
 
    public static function obtener_todos($conexion) {
        
        $usuarios = array();
        
        if (isset($conexion)) {
            
            try {
                
                include_once 'usuario.inc.php';
                
                $sql = "SELECT * FROM usuario";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $usuarios[] = new Usuario(
                                $fila['id'], $fila['nombre'], $fila['password']
                        );
                    }
                } else {
                    print 'No hay usuarios';
                }
                
            } catch (PDOException $ex) {
                print "ERROR" . $ex -> getMessage();
            } 
        }
        
        return $usuarios;      
    }
    
    public static function obtener_numero_usuarios($conexion) {
        $total_usuarios = null;
        
        if (isset($conexion)) {
            try {
                $sql = "SELECT COUNT(*) as total FROM usuario";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                
                $total_usuarios = $resultado['total'];
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $total_usuarios;
    }
    
    public static function insertar_usuario($conexion, $usuario) {
        $usuario_insertado = false;
        
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO usuario(nombre, password) VALUES(:nombre, :password)";
                
                $sentencia = $conexion -> prepare($sql);
                
                $nom_usuario = $usuario -> obtener_nombre();
                $password_usuario = $usuario -> obtener_password();
                
                $sentencia -> bindParam(':nombre',$nom_usuario , PDO::PARAM_STR);
                $sentencia -> bindParam(':password', $password_usuario, PDO::PARAM_STR);
                
                $usuario_insertado = $sentencia -> execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        
        return $usuario_insertado;
    }
    
    public static function nombre_existe($conexion, $nombre) {
        $nombre_existe = true;
        
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuario WHERE nombre = :nombre";
                
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
    
    public static function obtener_usuario_por_nombre($conexion, $nombre) {
        $usuario = null;
        
        if (isset($conexion)) {
            try {
                include_once 'usuario.inc.php';
                
                $sql = "SELECT * FROM usuario WHERE nombre = :nombre";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetch();
                
                if (!empty($resultado)) {
                    $usuario = new Usuario($resultado['id'],
                            $resultado['nombre'],
                            $resultado['password']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $usuario;
    }
    
    public static function obtener_usuario_por_id($conexion, $id) {
        $usuario = null;
        
        if (isset($conexion)) {
            try {
                include_once 'usuario.inc.php';
                
                $sql = "SELECT * FROM usuario WHERE id = :id";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetch();
                
                if (!empty($resultado)) {
                    $usuario = new Usuario($resultado['id'],
                            $resultado['nombre'],
                            $resultado['password']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $usuario;
    }

    public static function actualizar_password($conexion, $id_usuario, $nueva_clave) {
        $actualizacion_correcta = false;

        if (isset($conexion)) {
            try  {
                $sql = "UPDATE usuario SET password = :password WHERE id = :id";

                $sentencia = $conexion -> prepare($sql);

                $sentencia -> bindParam(':password', $nueva_clave, PDO::PARAM_STR);
                $sentencia -> bindParam(':id', $id_usuario, PDO::PARAM_STR);

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
