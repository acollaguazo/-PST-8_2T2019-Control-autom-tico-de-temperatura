<?php

if (isset($_POST['selectEquipo'])) {
    foreach ($datos_temp as $fila) {
        $idDato = $fila -> obtenerIdDato();
        $fecha = $fila -> obtenerFecha();
        $temperatura = $fila -> obtenerTemperatura();

        echo '<tr class ="'.'table-light'.'">';
        echo "<td>$idDato</td>";
        echo "<td>$fecha</td>";
        echo "<td>$temperatura</td>";
        echo "</tr>";
    }
}