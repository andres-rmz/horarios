<?php
   /*
   * Andrés Ramírez Salas <aramirez@elsiglo.com.mx> 
   * Listar empleados en una respectiva área o departamento.
   * 2014-03-14
   */
ob_implicit_flush();
set_time_limit(0);
$mysqli = new MySQLi("192.168.7.52","nomina","eT9Cuu932a","nomina");

if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    die();
}
$listaEmpleados = $mysqli->Query("SELECT empleado, UPPER(nombre) AS nombre, UPPER(puesto) AS puesto, UPPER(estado) AS estado FROM personas WHERE depto = 430 ORDER BY nombre");
//$listaEmpleados = $mysqli->use_result();
//print_r($listaEmpleados);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>HORARIOS</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/jquery.timepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css" />

    <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-datepicker.css" />


  </head>
  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Horarios</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="listaEmpleados.php">Regresar</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 col-md-12 main">
          <h1 class="page-header">Jornada</h1>
          <ul class="list-unstyled">
            <li>
              <label class="checkbox-inline">
                <input type="checkbox" id="lunes" value="2"> LUNES
              </label>
              <div id="horas2" class="well hide">

                <div class="row">
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="lunes1" id="lunes1">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="lunes2" id="lunes2">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->

                  <div class="col-lg-1">                      
                      <p class="text-center">---</p>
                  </div><!-- /.col-lg-2 -->


                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="lunes3" id="lunes3">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="lunes4" id="lunes4">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->
                </div><!-- /.row -->

              </div>

            </li>
            <li>
              <label class="checkbox-inline">
                <input type="checkbox" id="martes" value="3"> MARTES
              </label>
              <div id="horas3" class="well hide">

                <div class="row">
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="martes1" id="martes1">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="martes2" id="martes2">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->

                  <div class="col-lg-1">                      
                      <p class="text-center">---</p>
                  </div><!-- /.col-lg-2 -->


                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="martes3" id="martes3">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="martes4" id="martes4">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->

                  <button type="button" class="btn btn-primary btnigualar" value="3">Igual</button>
                </div><!-- /.row -->

              </div>
            </li>
            <li>
              <label class="checkbox-inline">
                <input type="checkbox" id="miercoles" value="4"> MIERCOLES
              </label>
              <div id="horas4" class="well hide">
              <div class="row">
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="miercoles1" id="miercoles1">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="miercoles2" id="miercoles2">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->

                  <div class="col-lg-1">                      
                      <p class="text-center">---</p>
                  </div><!-- /.col-lg-2 -->


                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="miercoles3" id="miercoles3">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="miercoles4" id="miercoles4">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->

                  <button type="button" class="btn btn-primary btnigualar" value="4">Igual</button>
                </div><!-- /.row -->
              </div>
            </li>
            <li>
              <label class="checkbox-inline">
                <input type="checkbox" id="jueves" value="5"> JUEVES
              </label>
              <div id="horas5" class="well hide">
              <div class="row">
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="jueves1" id="jueves1">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="jueves2" id="jueves2">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->

                  <div class="col-lg-1">                      
                      <p class="text-center">---</p>
                  </div><!-- /.col-lg-2 -->


                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="jueves3" id="jueves3">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="jueves4" id="jueves4">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->

                  <button type="button" class="btn btn-primary btnigualar" value="5">Igual</button>
                </div><!-- /.row -->
              </div>
            </li>
            <li>
              <label class="checkbox-inline">
                <input type="checkbox" id="viernes" value="6"> VIERNES
              </label>
              <div id="horas6" class="well hide">
              <div class="row">
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="viernes1" id="viernes1">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="viernes2" id="viernes2">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->

                  <div class="col-lg-1">                      
                      <p class="text-center">---</p>
                  </div><!-- /.col-lg-2 -->


                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="viernes3" id="viernes3">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="viernes4" id="viernes4">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->

                  <button type="button" class="btn btn-primary btnigualar" value="6">Igual</button>
                </div><!-- /.row -->
              </div>
            </li>
            <li>
              <label class="checkbox-inline">
                <input type="checkbox" id="sabado" value="7"> SABADO
              </label>
              <div id="horas7" class="well hide">
              <div class="row">
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="sabado1" id="sabado1">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="sabado2" id="sabado2">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->

                  <div class="col-lg-1">                      
                      <p class="text-center">---</p>
                  </div><!-- /.col-lg-2 -->


                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="sabado3" id="sabado3">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="sabado4" id="sabado4">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->

                  <button type="button" class="btn btn-primary btnigualar" value="7">Igual</button>
                </div><!-- /.row -->
              </div>
            </li>
            <li>
              <label class="checkbox-inline">
                <input type="checkbox" id="domingo" value="1"> DOMINGO
              </label>
              <div id="horas1" class="well hide">
              <div class="row">
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="domingo1" id="domingo1">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="domingo2" id="domingo2">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->

                  <div class="col-lg-1">                      
                      <p class="text-center">---</p>
                  </div><!-- /.col-lg-2 -->


                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="domingo3" id="domingo3">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->
                  <div class="col-lg-2">
                    <div class="input-group">                      
                      <input type="text" class="time form-control" type="text" name="domingo4" id="domingo4">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-2 -->

                  <button type="button" class="btn btn-primary btnigualar" value="1">Igual</button>
                </div><!-- /.row -->
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>

    
    <script type="text/javascript">
    $(':checkbox').change(function() {
        var dia = $(this).val();
        $("#horas"+dia).toggleClass("hide");
        //console.log("Dia :"+dia)
    }); 

    //Timers
    $('.time').timepicker({ 'timeFormat': 'H:i:s' });

    //Boton igualar
    $( ".btnigualar" ).click(function() {
      var diaNum = $(this).val();
      var diaNombre = "";
      var inicial1 = "";
      var final1 = "";
      var inicial2 = "";
      var final2 = "";
      switch(diaNum){
        case "1": //Domingo
        diaNombre = "domingo";
          inicial1 = $("#sabado1").val();
          final1 = $("#sabado2").val();
          inicial2 = $("#sabado3").val();
          final2 = $("#sabado4").val();
        break;
        case "3": //Martes
          diaNombre = "martes";
          inicial1 = $("#lunes1").val();
          final1 = $("#lunes2").val();
          inicial2 = $("#lunes3").val();
          final2 = $("#lunes4").val();
        break;
        case "4": //Miercoles
          diaNombre = "miercoles";
          inicial1 = $("#martes1").val();
          final1 = $("#martes2").val();
          inicial2 = $("#martes3").val();
          final2 = $("#martes4").val();
        break;
        case "5": //Jueves
          diaNombre = "jueves";
          inicial1 = $("#miercoles1").val();
          final1 = $("#miercoles2").val();
          inicial2 = $("#miercoles3").val();
          final2 = $("#miercoles4").val();
        break;
        case "6": //Viernes
          diaNombre = "viernes";
          inicial1 = $("#jueves1").val();
          final1 = $("#jueves2").val();
          inicial2 = $("#jueves3").val();
          final2 = $("#jueves4").val();
        break;
        case "7": //Sabado
          diaNombre = "sabado";
          inicial1 = $("#viernes1").val();
          final1 = $("#viernes2").val();
          inicial2 = $("#viernes3").val();
          final2 = $("#viernes4").val();
          anterior = 6
        break;
      }
      $("#"+diaNombre+"1").val(inicial1);
      $("#"+diaNombre+"2").val(final1);
      $("#"+diaNombre+"3").val(inicial2);
      $("#"+diaNombre+"4").val(final2);
      //console.log("inicial1 :"+inicial1);
      //console.log("final1 :"+final1);
      //console.log("inicial2 :"+inicial2);
      //console.log("final2 :"+final2);
    });
    </script>
  </body>
</html>
<?php
$mysqli->close();
?>