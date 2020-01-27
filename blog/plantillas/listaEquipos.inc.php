<?php


    
    Conexion :: abrir_conexion();
    
    $idEquipos = RepositorioEquipos :: obtener_equipos_por_idUser(Conexion::obtener_conexion(),$idUser);
    foreach ($idEquipos as $fila){       
        
        $nombreEqp = $fila -> obtener_nombreEqp();
        $idEqp = $fila->obtener_idEquipo();
        
        $texto = $idEqp."/".$nombreEqp;
        echo "<option value= $texto >$nombreEqp</option>";     
        
    }
    
    Conexion::cerrar_conexion();

                    
                    
