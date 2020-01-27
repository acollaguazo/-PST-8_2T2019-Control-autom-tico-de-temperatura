<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/ControlSesion.inc.php';

if (ControlSesion :: sesion_iniciada()){
    Redireccion::redirigir(RUTA_PAG_PRINCIPAL);
}
    
if (isset($_POST['login'])) {
    Conexion::abrir_conexion();

    $validador = new ValidadorLogin($_POST['nombre'], $_POST['clave'], Conexion::obtener_conexion());

    if ($validador->obtener_error() === '' &&
            !is_null($validador->obtener_usuario())) {
        
        $id_user =$validador -> obtener_usuario()->obtener_id() ;
        $name_user = $validador -> obtener_usuario()->obtener_nombre();
        ControlSesion::iniciar_sesion($id_user,$name_user);
        
        Redireccion::redirigir(RUTA_PAG_PRINCIPAL);
    }
    Conexion::cerrar_conexion();
}

$titulo = 'Login';

include_once 'plantillas/encabezado.inc.php';
?>

<div class="container">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h4>Iniciar sesión</h4>
                </div>
                <div class="panel-body text-center">
                    <form role="form" method="post" action="pantallaGrafico.php">
                        <h2>Introduce tus datos</h2>
                        <br>
                        <label for="nombre" class="sr-only">Usuario</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="usuario" 
                        <?php
                        if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
                            echo 'value="' . $_GET['nombre'] . '"';
                        }

                        if (isset($_POST['login']) && isset($_POST['nombre']) && !empty($_POST['nombre'])) {
                            echo 'value="' . $_POST['nombre'] . '"';
                        }
                        ?>
                               required autofocus>
                        <br>
                        <label for="clave" class="sr-only">Contraseña</label>
                        <input type="password" name="clave" id="clave" class="form-control" placeholder="Contraseña" required>
                        <br>
                        <?php
                        if (isset($_POST['login'])) {
                            $validador->mostrar_error();
                        }
                        ?>
                        <button type="submit" name="login" class="btn btn-lg btn-primary btn-block">
                            Iniciar sesión
                        </button>
                        <br>
                        <br>
                        <a href="index.php">Crear cuenta</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>