<?php
/*
 * Andrés Ramírez Salas <aramirez@elsiglo.com.mx> 
 * Listar empleados en una respectiva área o departamento.
 * 2014-03-14
 */
$mysqli = new MySQLi("192.168.7.52", "nomina", "eT9Cuu932a", "nomina");

if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    die();
}

if ($_POST) {
    /*
      print_r($_GET);
      print_r($_POST);
      echo "<br>";
      echo "<br>";
     */
    $empleado = $_GET["e"];
    /*print_r($empleado);
    echo "<br>";
    echo "<br>";
     */

    if (empty($_POST["dias"])) {
	die("No hay cambios.");
    } else {

	$existeEmpleado = $mysqli->Query("SELECT empleado FROM nomjhor WHERE empleado = $empleado LIMIT 1;");

	if ($existeEmpleado->num_rows) {
	    $mysqli->Query("DELETE FROM nomjhor WHERE  empleado = $empleado;");
	}
	$duracionTotal = 0;
	$guardado = false;
	foreach ($_POST["dias"] as $dia => $value) {
	    /*print_r($dia);
	    echo "->";
	    print_r($value);
	    echo "<br>";
	     * 
	     */

	    foreach ($value as $row => $hora) {
		/*print_r($row);
		echo "->";
		print_r($hora);
		echo "<br>";*/
		if (!empty($hora["1"])) {
		    $horini = $hora["1"];
		    $horfin = $hora["2"];
		    $duracion = round(abs(strtotime($horfin) - strtotime($horini)) / 60, 2);
		    $mysqli->Query("INSERT INTO nomjhor (empleado,dia,horini,horfin,duraci,diacon) VALUES ($empleado,$dia,'$horini','$horfin',$duracion,0);");
		    $duracionTotal += $duracion;
		    $guardado = true;
		}
	    }
	}

	if ($guardado == true) {
	    $desjor = substr($empleado, -3);
	    if ($existeEmpleado->num_rows) {
		$mysqli->Query("DELETE FROM nomjorc WHERE  empleado = $empleado LIMIT 1;");
	    }
	    $mysqli->Query("INSERT INTO nomjorc (empleado,desjor,numdia,horjor,aplicado) VALUES ($empleado,$desjor,7,$duracionTotal,0);");
	}
	header("Location: listaEmpleados.php");
	die();
    }
}

$listaEmpleados = $mysqli->Query("SELECT empleado, UPPER(nombre) AS nombre, UPPER(puesto) AS puesto, UPPER(estado) AS estado FROM personas WHERE depto = 430 ORDER BY nombre");
//$listaEmpleados = $mysqli->use_result();
//print_r($listaEmpleados);

$dias = array(
    "2" => "LUNES",
    "3" => "MARTES",
    "4" => "MIERCOLES",
    "5" => "JUEVES",
    "6" => "VIERNES",
    "7" => "SABADO",
    "8" => "DOMINGO"
);
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
		    <p class="text-right"><strong>Total Horas:<strong><span id="totalHoras"> 0  <span></strong></p>
					<form role="form" method="POST" action="">
					    <ul class="list-unstyled">

						<?php
						$grupo = 1;
						foreach ($dias as $diaNum => $diaNom) {
						    $input = 1;
						    ?>
    						<li>
    						    <label class="checkbox-inline">
    							<input type="checkbox" name="<?= $diaNom ?>" value="true"> <?= $diaNom ?>
    						    </label>
    						    <div id="<?= $diaNom ?>" class=" hide">                
    							<div class="row">
								<?php
								for ($g = 1; $g <= 2; $g++) {
								    if ($g != 1) {
									?>
	    							    <div class="col-lg-1">                      
	    								<p class="text-center">---</p>
	    							    </div><!-- /.col-lg-2 -->
								    <?php } ?>
								    <div class="grupoHoras" id="grupo<?= $grupo ?>">
									<div class="col-lg-2">
									    <div class="input-group">                      
										<input type="text" class="time form-control inicial <?= $diaNom ?>" type="text" name="dias[<?= $diaNum ?>][<?= $g ?>][1]"  disabled>
										<span class="input-group-addon">
										    <span class="glyphicon glyphicon-time"></span>
										</span>
									    </div><!-- /input-group -->
									</div><!-- /.col-lg-2 -->
									<div class="col-lg-2">
									    <div class="input-group">                      
										<input type="text" class="time form-control final <?= $diaNom ?>" type="text" name="dias[<?= $diaNum ?>][<?= $g ?>][2]"  disabled>
										<span class="input-group-addon">
										    <span class="glyphicon glyphicon-time"></span>
										</span>
									    </div><!-- /input-group -->
									</div><!-- /.col-lg-2 -->
								    </div>

								    <?php
								    $grupo++;
								}
								if ($diaNum != 2) {
								    ?>
								    <button type="button" class="btn btn-primary btnigualar" value="<?= $diaNum ?>">Igualar</button>
								<?php }
								?>    							    
    							</div><!-- /.row -->
    						    </div>
    						</li>

						    <?php
						}
						?>


					    </ul>


					    <button type="sumit" class="btn btn-success">Guardar</button>
					</form><!-- /.form -->
					</div>
					</div>
					</div>


					<script type="text/javascript">

					    function n(n) {
						return n > 9 ? "" + n : "0" + n;
					    }
					    function totalHoras(){
						var horas = 0;
						var minutos = 0;
						$('.grupoHoras').each(function() {
						    //if($(this).val() != ""){

						    var grupoid = $(this).attr("id");
						    var inicial1 = $("#" + grupoid + " .inicial").val();
						    var final2 = $("#" + grupoid + " .final").val();


						    if (final2 != "") {
							var date1 = new Date("December 17, 1995 " + inicial1);
							var date2 = new Date("December 17, 1995 " + final2);
							if (date2 < date1) {
							    date2.setDate(date2.getDate() + 1);
							}

							var diff = date2 - date1;

							var msec = diff;
							var hh = Math.floor(msec / 1000 / 60 / 60);
							msec -= hh * 1000 * 60 * 60;
							var mm = Math.floor(msec / 1000 / 60);
							msec -= mm * 1000 * 60;
							var ss = Math.floor(msec / 1000);
							msec -= ss * 1000;

							horas += hh;
							minutos += mm;
							if (minutos >= 60) {
							    horas += 1;
							    minutos -= 60;
							}
							$("#totalHoras").html(n(horas) + ":" + n(minutos) + ":00");

						    }
						});
					    }
					    
					    $(".time").change(function() {
						totalHoras();
					    });

					    $(':checkbox').change(function() {
						var dia = $(this).attr("name");
						//console.log("Dia :" + dia)
						if ($(this).is(':checked')) {
						    //console.log("checked");
						    $("#" + dia).removeClass("hide");
						    $("." + dia).removeAttr("disabled");
						} else {
						    //console.log("unchecked");
						    $("#" + dia).addClass("hide");
						    $("." + dia).attr("disabled", "disabled");
						}
					    });

					    //Timers
					    $('.time').timepicker({'timeFormat': 'H:i:s'});

					    //Boton igualar
					    $(".btnigualar").click(function() {
						var diaNum = parseInt($(this).val());
						var diaNombre = "";
						var inicial1 = "";
						var final1 = "";
						var inicial2 = "";
						var final2 = "";
						var diaAnt = (diaNum - 1);
						diaAnt = diaAnt.toString();

						inicial1 = $("input[name='dias[" + diaAnt + "][1][1]']").val();
						final1 = $("input[name='dias[" + diaAnt + "][1][2]']").val();
						inicial2 = $("input[name='dias[" + diaAnt + "][2][1]']").val();
						final2 = $("input[name='dias[" + diaAnt + "][2][2]']").val();

						$("input[name='dias[" + diaNum + "][1][1]']").val(inicial1);
						$("input[name='dias[" + diaNum + "][1][2]']").val(final1);
						$("input[name='dias[" + diaNum + "][2][1]']").val(inicial2);
						$("input[name='dias[" + diaNum + "][2][2]']").val(final2);
						totalHoras();
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