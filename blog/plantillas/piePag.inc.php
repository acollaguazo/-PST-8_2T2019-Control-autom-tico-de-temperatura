<script src="js/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="https://kit.fontawesome.com/6cca0ba487.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/selectEquipo.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<?php
if (isset($_POST['selectEquipo'])) {
    ?>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Horas', 'Temperatura']
    <?php
    if (isset($datos_graph)) {
        foreach ($datos_graph as $info) {
            ?>
                        , [<?php echo "'" . $info[0] . "'"; ?>, <?php echo $info[1]; ?>]
        <?php }
    } ?>
            ]);

            var options = {
                title: 'Company Performance',
                curveType: 'function',
                legend: {position: 'bottom'}
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>
    <?php
}
?>

<script type="text/javascript">
    function validaForm(form) {
        if (form.cantidad.value >= 1 && form.cantidad.value <= 5) {
            if (form.cantidad.value !== "<?php echo $actuador_info->obtener_estado(); ?>" ) {
                <?php 
                Conexion :: abrir_conexion();
            $actualizar = RepositorioAccion:: actualizar_estado(Conexion::obtener_conexion(),
                            $actuador_info->obtener_idAccion(),  '<script> document.write(form.cantidad.value) </script>');

            Conexion::cerrar_conexion();
                ?>
               
                alert(" <?php echo $actuador_info -> obtener_estado(); ?>");
            }
        }
        if (form.cantidad.value < 1) {
            form.cantidad.value = 1;
            alert("El dispositivo se encuentra en su estado mas bajo");
        }
        if (form.cantidad.value > 5) {
            form.cantidad.value = 5;
            alert("El dispositivo se encuentra en su estado mas alto");
        }

    }
</script>
</body>
</html>
