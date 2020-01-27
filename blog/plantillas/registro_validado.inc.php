<div class="form-group">
    <label>Nombre de usuario</label>
    <input type="text" class="form-control mb-2 mr-sm-2" name="nombre" placeholder="usuario" <?php $validador -> mostrar_nombre() ?>>
    <?php
    $validador -> mostrar_error_nombre();
    ?>
</div>
<div class="form-group">
    <label>Contraseña</label>
    <input type="password" class="form-control mb-2 mr-sm-2" name="clave1">
    <?php
    $validador -> mostrar_error_clave1();
    ?>
</div>
<div class="form-group">
    <label>Repite la contraseña</label>
    <input type="password" class="form-control mb-2 mr-sm-2" name="clave2">
    <?php
    $validador -> mostrar_error_clave2();
    ?>
</div>
<br>
<button type="reset" class="btn btn-default btn-primary">Limpiar formulario</button>
<br>
<br>
<button type="submit" class="btn btn-default btn-primary" name="enviar">Enviar datos</button>
