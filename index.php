<?php
// Controlando los parametros GET que ingresaran a traves de la URL.
// Ej: localhost/cursojs/index.php?op=leccion1_prueba
if (empty($_GET["op"])){
    $ruta = "contenido_principal";
} else {
    $op = $_GET["op"];
    // Seperando nombre carpeta de archivo
    $paratemtros = explode ("_", $op);
    $carpeta = $paratemtros [0]; // Este es el nombre de la carpeta
    $archivo = $paratemtros [1]; // Este es el nombre del archivo "prueba.php"
    if ($carpeta != "") { // Si la carpeta no es vacia
        $ruta = $carpeta. "/" . $archivo; // leccion1/prueba.php
    } else {
        //Enviar a un archivo de error 404 
    }
} // if empty
?>
<!DOCTYPE html>
<html lang="en-US">
<head>  

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competencias</title>
    <!-- CSS - Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JS -- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!--Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

</head>
  
<body>

    <!-- Encabezado -->
    <div class="row bg-warning border-bottom">
        <div class="col-12 p-2 text-center">

            <?php include("archivos/encabezado.php"); ?>

        </div>
    </div>
    
    <!-- Contenido -->
    <div class="row">
        <div class="col bg-warning col-lg-3 p-2">
            
            <?php include("archivos/menuvertical.php") ?>
        
        </div>
    <div class="col col-lg-9 p-2 border" style="height: 600px">
            
            <?php include("./contenido/".$ruta.".php"); ?>

    </div>

    <!-- Pie -->
    <div class="row bg-dark">
        <div class="col-12 p-2 text-center text-white">

            <?php include("archivos/pie.php"); ?>

        </div>
    </div>

    <header class="page-header">
        <h1>Simulador de SFG (Preventivos y no Preventivos)</h1>
    </header>

    <div class="form-group-2">
            <label>
                Elegir simulaciones SJF preventivos  :
            </label>

            <label class="switch">
                <input type="checkbox" id="toggle">
                <span class="slider round"></span>
            </label>
    </div>


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
                    <button class="button" type="button" onclick="crearTabla()">Ingrese Valores</button>
                </div>

                <div class="form-group">
                    <button class="button" type="button" onclick="printGanttChart()">Mostrar Grafico de Gantt</button>
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

        function crearTabla()
        {
            var procesoID=document.getElementById("PID").value;
            var ejecucionTiempo=document.getElementById("ejecucionTiempo").value;
            var llegadaTiempo=document.getElementById("llegadaTiempo").value;

            var table=document.getElementById("inputTable");
            var primeraCelda = table.insertRow(-1);
            var celda1 = primeraCelda.insertCell(0);
            var celda2 = primeraCelda.insertCell(1);
            var celda3 = primeraCelda.insertCell(2);

            celda1.innerHTML=procesoID;
            celda2.innerHTML=ejecucionTiempo;
            celda3.innerHTML=llegadaTiempo;

            var x = document.getElementById("inputTable").rows.length;
           // console.log(x);
        }


        function GetValorCelda()
         {
            var pid =[];
            var at =[];
            var bt =[];
            var flag =[];
            var bt2=[];

            // items is the sorted list
            var items = [];

            var table = document.getElementById('inputTable');
            for (var r = 1, n = table.rows.length; r < n; r++) {
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                     //console.log(table.rows[r].cells[c].innerHTML);
                }
                pid.push(parseInt(table.rows[r].cells[0].innerHTML));
                bt.push(parseInt(table.rows[r].cells[1].innerHTML));
                bt2.push(parseInt(table.rows[r].cells[1].innerHTML));
                at.push(parseInt(table.rows[r].cells[2].innerHTML));
                flag.push(0);
            }
            
            var toggle = document.getElementById("toggle").checked;
            
            if (toggle == true)
                items = preemptiveSelection(pid,at,bt,flag,bt2);
            else
                items = nonPreemptiveSelection(pid,at,bt,flag);
            
            return items;

          }


          function nonPreemptiveSelection(pid,at,bt,flag)
          {
            var n = pid.length;
            var clock = 0;
            var tot = 0;
            var items =[];
            var ct=[];
            var ta=[];
            var wt=[];
            var avgwt=0;
            var avgta=0;
            

            while(true)
            {
                var min=100;
                var c = n; // c representa el PID presente
                if (tot == n)
                    break;
                
                for (var i=0; i< n; i++)
                {
                    
                    var count=0;
                    if ((at[i] <= clock) && (flag[i] == 0) && (bt[i]<min))
                        {
                            min=bt[i];
                            c=i;
                        } 

                }
                if (c==n) 
                    clock++;
                else
                {
                    var temp = [];
                    temp.push(pid[c]);
                    temp.push(bt[c]);
                    items.push(temp);

                    ct[c]=clock+bt[c];
                    ta[c]=ct[c]-at[c];
                    wt[c]=ta[c]-bt[c];
                    
                    clock+=bt[c];
                    flag[c]=1;
                    tot++;   
                }
            }

            for(i=0;i<n;i++)
            {
                avgwt +=wt[i];
                avgta +=ta[i];
            }

            avgwt/=n;
            avgta/=n;
            printStat(ct,ta,wt,avgwt,avgta,pid); 
            return items;
          }


          function preemptiveSelection(pid,at,bt,flag,bt2)
          {
            var n = pid.length;
            var clock = 0;
            var tot = 0;
            var items =[];
            var ct=[];
            var ta=[];
            var wt=[];
            var avgwt=0;
            var avgta=0;
            
            var count2=0;

            while (true)
            {
                var c = n;
                var min =100;
                if (tot==n)
                {
                    items.push(temp);
                    break;
                }
                    
                for (var i=0; i< n; i++)
                {
        
                    var count=0;
                    if ((at[i] <= clock) && (flag[i] == 0) && (bt[i]<min))
                        {
                            min=bt[i];
                            c=i;
                        } 

                }
                
                // Si no hay un c:
                if (c==n)
                {
                    clock+=1;
                }
                // Si hay un cc:
                else
                {
                    bt[c]--;
                    clock++;
                    if (bt[c]==0)
                    {   
                        ct[c]=clock;
                        flag[c]=1
                        tot++;
                    }

                    if (count2==0)
                    {
                        //temp2 guarda el c previo
                        var temp2=c;
                        var temp = [];
                        temp.push(pid[c]);
                        temp.push(1)
                    }

                    else
                    {
                         if (c==temp2)
                        {
                            temp[1]++;
                        }
                        else
                        {
                            items.push(temp);
                            var temp =[];
                            temp.push(pid[c]);
                            temp.push(1);
                            temp2=c;
                        }
                    }
                    console.log(c); 
                    count2++;
                }
                   
            }

            for(i=0;i<n;i++)
            {
                ta[i] = ct[i] - at[i];
                wt[i] = ta[i] - bt2[i];
                avgwt +=wt[i];
                avgta +=ta[i];
            }

            avgwt/=n;
            avgta/=n;

            printStat(ct,ta,wt,avgwt,avgta,pid);            
            return items;
                
        }


        function generateGanttChartData(data)
        {   
            var n = data.length;
            var finalData = [];
            var clock = 0;
            
            //console.log(n);

            for (var i=0; i<n; i++)
            {
                var temp = {
                        "category": "",
                        "segments": [ {
                            "start": 0,
                            "duration": 0,
                            "color": "#727d6f",
                            "task": ""
                        }, ]
                    }

                temp.category = "Proceso " + (parseInt(data[i][0])).toString();
                temp.segments[0].start = clock;
                temp.segments[0].duration = data[i][1];
                temp.segments[0].task = "Proceso " + (parseInt(data[i][0])).toString();

                clock = clock + data[i][1];
                finalData.push(temp);
            }
             
            return finalData;
        }



        function printGanttChart()
        {
            var chartData = generateGanttChartData(GetValorCelda());
            

            var chart = AmCharts.makeChart( "chartdiv", 
                {
                "type": "gantt",
                "theme": "dark",
                "marginRight": 70,
                "period": "hh:mm:ss",
                "dataDateFormat":"YYYY-MM-DD",
                "balloonDateFormat": "JJ:NN",
                "columnWidth": 0.5,
                "valueAxis": {
                    "type": "timecode"
                },
                "brightnessStep": 10,
                "graph": {
                    "fillAlphas": 1,
                    "balloonText": "<b>[[task]]</b>: [[open]] [[value]]"
                },
                "rotate": true,
                "categoryField": "category",
                "segmentsField": "segments",
                "colorField": "color",
                "startDate": "00:00:00:00",
                "startField": "start",
                "endField": "end",
                "durationField": "duration",


                // This key contains values generated by generateGanttChartData FUNCTION
                "dataProvider": chartData,


                "valueScrollbar": {
                    "autoGridCount":true
                },
                "chartCursor": {
                    "cursorColor":"#55bb76",
                    "valueBalloonsEnabled": false,
                    "cursorAlpha": 0,
                    "valueLineAlpha":0.5,
                    "valueLineBalloonEnabled": true,
                    "valueLineEnabled": true,
                    "zoomable":false,
                    "valueZoomable":true
                },
                "export": {
                    "enabled": true
                 }
            } );
        }


        function printStat(ct,ta,wt,avgwt,avgta,pid)
        {
            console.log(ct);
            console.log(ta);
            console.log(wt);
            console.log(avgwt);
            console.log(avgta);
            
            document.getElementById("wtOutput").innerHTML=avgwt;
            document.getElementById("taOutput").innerHTML=avgta;
            
            var table_2=document.getElementById("statTable");
        
            console.log("len");
            console.log(table_2.rows.length);

            for(var i = table_2. rows. length; i > 1; i--)
            {
                    console.log(i);
                    table_2. deleteRow(i-1);
            }

            for (var i=0;i<pid.length;i++)
            {   
            var primeraCelda = table_2.insertRow(i+1);
            var celda1 = primeraCelda.insertCell(0);
            var celda2 = primeraCelda.insertCell(1);
            var celda3 = primeraCelda.insertCell(2);
            var celda4 = primeraCelda.insertCell(3);
                celda1.innerHTML=pid[i];
                celda2.innerHTML=ct[i];
                celda3.innerHTML=ta[i];
                celda4.innerHTML=wt[i];
            }
            
        }

        
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