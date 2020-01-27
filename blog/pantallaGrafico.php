<!DOCTYPE html>
<?php
include_once 'app/Conexion.inc.php';
include_once 'app/Equipo.inc.php';
include_once 'app/Datos.inc.php';
include_once 'app/Accion.inc.php';
include_once 'app/usuario.inc.php';
include_once 'app/RepositorioDatos.inc.php';
include_once 'app/RepositorioEquipos.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioAccion.inc.php';
include_once 'app/ValidarEquipo.inc.php';
include_once 'app/ControlSesion.inc.php';



$idUser = '2';

if (isset($_POST['enviarEqp'])) {

    Conexion :: abrir_conexion();
    $validador_equipo = new ValidarEquipo($_POST['idEquipo'], $_POST['nombreEquipo'], Conexion :: obtener_conexion());

    if ($validador_equipo->equipo_valido()) {
        $equipo_insertar = new Equipo($validador_equipo->obtener_idEquipo(), $validador_equipo->obtener_nombEquipo(), $idUser);

        $actuador_insertar = new Accion("", $validador_equipo->obtener_idEquipo(), "0");

        $equipo_insertado = RepositorioEquipos:: insertar_equipo(Conexion::obtener_conexion(), $equipo_insertar);

        $actuador_insertado = RepositorioAccion:: insertar_accion(Conexion::obtener_conexion(), $actuador_insertar);

        if ($equipo_insertado) {
            //print 'aquipo valiado correctamente';
        }
    }
    Conexion::cerrar_conexion();
}


if (isset($_POST['selectEquipo'])) {

    $data_equipo = explode("/", $_POST['allEquipos']);

    Conexion :: abrir_conexion();
    $actuador_info = RepositorioAccion::obtener_estado(Conexion :: obtener_conexion(), $data_equipo[0]);

    $datos_temp = RepositorioDatos::obtener_datos_por_idEqp(Conexion :: obtener_conexion(), $data_equipo[0]);
    Conexion::cerrar_conexion();
    if (count($datos_temp)) {
        $datos_graph = array();
        foreach ($datos_temp as $info) {
            $fecha = explode(" ", $info->obtenerFecha());
            $dato = [$fecha[1], $info->obtenerTemperatura()];
            $datos_graph[] = $dato;
        }
    } 
}



/*
if (isset($_POST['aumentar'])) {
        print $actuador_info->obtener_estado();
        $valor = $actuador_info->obtener_estado();
        print $_POST['aumentar'];
        $error = "";
        if ($valor >= 0) {
            $valor += 1;
            Conexion :: abrir_conexion();
            $actualizar = RepositorioAccion:: actualizar_estado(Conexion::obtener_conexion(),
                            $actuador_info->obtener_idAccion(), $valor);

            Conexion::cerrar_conexion();
        } else {
            $error = "El dispositivo esta en su mas bajo estado";
        }
    }

*/

include_once 'plantillas/encabezado.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="text-center">Graficas termicas</h1>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4 text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"> Ingresar nuevo equipo</h3>
                </div>
                <div class="panel-body" >  
                    <br>
                    <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                        <div class="form-group">
                            <label class="mr-sm-2">ID del equipo:</label>                                
                            <input type="text" class="form-group mb-2 mr-sm-2" id="idEqp" placeholder="ID equipo" name="idEquipo">  
                            <?php
                            if (isset($_POST['enviarEqp'])) {
                                $validador_equipo->mostrar_error_idEquipo();
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label class="mr-sm-2">Nombre del equipo:</label>                                
                            <input type="text" class="form-group mb-2 mr-sm-2" id="nameEquipo" placeholder="Nombre" name="nombreEquipo"> 
                            <?php
                            if (isset($_POST['enviarEqp'])) {
                                $validador_equipo->mostrar_error_nomEquipo();
                            }
                            ?>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-default btn-primary mb-2" name="enviarEqp">Submit</button>
                    </form>                    

                </div>
            </div>
        </div>

        <div class="col-md-4 text-center"></div>

        <div class="col-md-4 text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"> Sesion de control de temperatura</h3>
                </div>
                <div class="panel-body" >  
                    <br>
                    <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

                        <div class="form-group">
                            <select id="allEquipos" name="allEquipos" onchange="ShowSelected();"> 

                                <?php
                                include_once 'plantillas/listaEquipos.inc.php';
                                ?>
                            </select>
                            <br><br>
                            <button type="submit" class="btn btn-default btn-primary mb-2" name="selectEquipo">Submit</button>
                        </div>
                    </form>
                    <form role="form" method="post" name="control" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                        <div class="form-group">
                            <input type="int" method="post" id="cantidad" name="cantidad"
                            <?php
                            if (isset($_POST['selectEquipo'])) {
                                echo 'value="' . $actuador_info->obtener_estado() . '"';
                            }
                            ?>
                                   ReadOnly>
                            
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <input type="button" id="aumentar" name="aumentar" value="aumentar" onclick="control.cantidad.value++; 
                                           validaForm(this.form)"><i class="fas fa-angle-double-up"></i>

                                </div>
                                <br>
                                <div class="col-md-6 text-center" >
                                    <input type="button" id="disminuir" name="disminuir" value="disminuir" onclick="control.cantidad.value--; 
                                           validaForm(this.form)"><i class="fas fa-angle-double-down"></i>

                                </div>
                            </div>
                        </div>

                        <br>
                        <br>
                    </form>  
                </div>
            </div>
            <br>
            <br>
            <br>
        </div>
    </div>
</div>

<div class="container">

    <div>
        <div id="curve_chart"></div>

    </div>
    <br>
    <br>
    <br>
    <br>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>id</th>
                <th>Fecha</th>
                <th>Temperatura</th>
            </tr>                    
        </thead>
        <tbody>
            <?php
            include_once 'plantillas/tablaDatos.inc.php';
            ?>
        </tbody>
    </table>
    <div class="panel-heading">
        <span class="glyphicon glyphicon-time"></span>
    </div>
    <div class="panel-body">

    </div>
</div>

<?php
include_once 'plantillas/piePag.inc.php';
?>
        







