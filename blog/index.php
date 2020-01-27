<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/usuario.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorRegistro.inc.php';
include_once 'app/Redireccion.inc.php';

if (isset($_POST['enviar'])) {
    Conexion :: abrir_conexion();
    
    $validador = new ValidadorRegistro($_POST['nombre'],
            $_POST['clave1'], $_POST['clave2'], Conexion :: obtener_conexion());
    
    if ($validador -> registro_valido()) {
        
        $usuario = new usuario('', $validador-> obtener_nombre(), 
                password_hash($validador -> obtener_clave(), PASSWORD_DEFAULT));
        
        $usuario_insertado = RepositorioUsuario :: insertar_usuario(Conexion :: obtener_conexion(), $usuario);
        
        if ($usuario_insertado) {           
            
            Redireccion::redirigir(RUTA_LOGIN. '?nombre=' . $usuario -> obtener_nombre());
            
        }
    }
    
    Conexion:: cerrar_conexion();
}

$titulo = 'Registro';

include_once 'plantillas/encabezado.inc.php';
?>

<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Formulario de registro</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Instrucciones
                    </h3>
                </div>  
                <div class="panel-body">
                    <br>
                    <p class="text-justify">
                        Para unirte al blog de AST (Analizador de Sensores Termicos), 
                        introduce un nombre de usuario y una contraseña, para que empieces
                        a utilizar todas las herramientas que presentamos para el analisis 
                        en tiempo real de datos de sensores termicos.
                        Te recomendamos que uses una contraseña que contenga letras
                        minúsculas, mayúsculas, números y símbolos.
                    </p>
                    <br>
                    <a href="login.php">¿Ya tienes cuenta?</a>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Introduce tus datos
                    </h3>
                </div>  
                <div class="panel-body">
                    <form role="form" method="post">
                        <?php
                        if (isset($_POST['enviar'])) {
                            include_once 'plantillas/registro_validado.inc.php';
                        } else {
                            include_once 'plantillas/registro_vacio.inc.php';
                        }
                        
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'plantillas/piePag.inc.php';
?>