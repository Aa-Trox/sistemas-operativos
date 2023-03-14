<!--  Autores:  - Victor Luis Seleme Carballo 
                - David Abraham Pardo Cordova
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <script src="contenido/prioridad/js/prueba.js"></script>
    <link type="text/css" href="styles/style.css" rel="stylesheet">

</head>
<body>

  <header class="page-header">
    <h1>&#160Simulador por Prioridad</h1>
  </header>

  <div class="container-1">
    <form class="input-form">
      <div class="form-group">
        <label>Proceso ID: </label>
        <input type="number" id="PID" name="PID" value="">
      </div>
      <div class="form-group">
        <label>Tiempo de Ejecucion: </label>
        <input type="number" id="ejecucionTiempo" value="">
      </div>
      <div class="form-group">
        <label>Tiempo de Llegada: </label>
        <input type="number" id="llegadaTiempo" value="">
      </div>
      <div class="form-group">
        <label>Prioridad: </label>
        <input type="number" id="prioridad" value="">
      </div>
     
      <div class="form-group">
        <button class="button" type="button" onclick="crearTabla()">Ingrese Valores</button>
      </div>

      <div class="form-group">
        <button class="button" type="button" onclick="printGanttChart()">Simular</button>
      </div>  
    </form>
  </div>
  </div>  
  <div class="container">
    <table id="inputTable">
      <tr>
        <th>PID</th>
        <th>Tiempo de Servicio</th>
        <th>Tiempo de Llegada</th>
        <th>Prioridad</th>
      </tr>
    </table>
  </div>
  <section class="container-3">
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/gantt.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/dark.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <div id="chartdiv"></div>   

    <script type="text/javascript">
    </script>   
  </section>

  <div>
    <table id="statTable">
      <tr>
        <th>PID</th>
        <th>Tiempo Completado</th>
        <th>Tiempo de Respuesta</th>
        <th>Tiempo de Espera</th>
      </tr>
    </table>
  </div>

  <div id="statTable-s">
    <div class="block">
      <label>Tiempo de Espera Promedio: </label>
      <label id="wtOutput"></label>
    </div>

    <div class="block">
      <label>Tiempo de Respuesta Promedio: </label>
      <label id="taOutput"></label>
    </div>

  </div>

</body>
</html>