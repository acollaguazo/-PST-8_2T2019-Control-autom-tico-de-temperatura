


google.charts.load('current', {'packages': ['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var equipo = document.getElementById("allEquipos").value;
    
    
    
    
    console.log(equipo);
    
    var options = {
        title: 'Company Performance',
        curveType: 'function',
        legend: {position: 'bottom'}
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
}

/*
 * <?php
        if (isset($datos_graph)) {
            foreach ($datos_graph as $info) {
                echo "<h3>" . $info[0] . $info[1] . "</h3>";
            }
        }
        ?>
 */
