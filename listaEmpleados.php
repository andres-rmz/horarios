<?php
/*
 * Andrés Ramírez Salas <aramirez@elsiglo.com.mx> 
 * Listar empleados en una respectiva área o departamento.
 * 2014-03-14
 */
ob_implicit_flush();
set_time_limit(0);
$mysqli = new MySQLi("192.168.7.52", "nomina", "eT9Cuu932a", "nomina") or die("no se pudo conectar a la base de datos Nomina.");

if ($_POST) {
    /*
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";*/
    $msql = mssql_connect("192.168.7.220","NOM2001","sa") or die("No se pudo conectar a la base de datos NOM2001.");
    foreach ($_POST["aplicar"] as $key => $empleado) {
	$nomjorcQuery = $mysqli->Query("SELECT empleado, desjor, numdia, horjor FROM nomjorc WHERE empleado = $empleado LIMIT 1;");
	$nomjorc = $nomjorcQuery->fetch_object();
	$cvecia = "00".substr($nomjorc->empleado, 0, 1);
	$cvejor = substr($nomjorc->empleado, -3);
	
	/*
	 * Guardar jornada en NOM tabla NOMJORC
	 */
	$mysqli->Query("INSERT INTO NOMJORC (cvecia,cvejor,desjor,numdia,horjor) VALUES ($cvecia,$cvejor,$nomjorc->desjor,$nomjorc->numdia,$nomjorc->horjor) LIMIT 1;");

	
    }
}
if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    die();
}
$listaEmpleados = $mysqli->Query("SELECT p.empleado, UPPER(p.nombre) AS nombre, UPPER(p.puesto) AS puesto, UPPER(p.estado) AS estado, nj.aplicado FROM personas AS p LEFT JOIN nomjorc AS nj ON p.empleado = nj.empleado WHERE depto = 430 ORDER BY nombre,aplicado");
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

	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->


    </head>
    <style type="text/css">
	.navbar-form {
	    width: 40%;
	}
	#empleados td:hover {
	    cursor: pointer;
	}
    </style>
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
			<li><a href="#">Salir</a></li>
		    </ul>
		    <form class="navbar-form navbar-right">
			<input type="text" class="form-control" placeholder="Buscar...">
		    </form>
		</div>
	    </div>
	</div>

	<div class="container-fluid">
	    <div class="row">
		<div class="col-sm-12 col-md-12 main">
		    <h1 class="page-header">Empleados</h1>
		    <form role="form" method="POST" action="">
			<p class="text-right"><button type="submit" class="btn btn-success">Aplicar</button></p>
			<div class="table-responsive">

			    <table class="table table-hover" id="empleados">
				<thead>
				    <tr>
					<th></th>
					<th>EMPEADO</th>
					<th>NOMBRE</th>
					<th>PUESTO</th>
					<th>ESTADO</th>
					<th>APLICADO</th>
				    </tr>
				</thead>
				<tbody>
				    <?php
				    while ($empleado = $listaEmpleados->fetch_object()) {
					if ($empleado->aplicado == 1) {
					    $aplicado = "APLICADO";
					    $class = "";
					    $checkbox = "";
					} else {
					    $aplicado = "NO APLICADO";
					    $class = "warning";
					    $checkbox = '<label class="checkbox-inline">' .
						    '<input type="checkbox" id="" value="' . $empleado->empleado . '" name="aplicar[]">' .
						    '</label>';
					}
					?>
    				    <tr class="<?= $class ?>">
    					<td><?= $checkbox ?></td>
    					<td><a href="jornada.php?e=<?= $empleado->empleado ?>"><?= $empleado->empleado ?></a></td>
    					<td><?= $empleado->nombre ?></td>
    					<td><?= $empleado->puesto ?></td>
    					<td><?= $empleado->estado ?></td>
    					<td><?= $aplicado ?></td>
    				    </tr>
				    <?php } ?>                
				</tbody>
			    </table>
			</div>
		    </form>
		</div>
	    </div>
	</div>

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
	    $(document).ready(function() {
		$('#empleados tr').dblclick(function() {
		    var href = $(this).find("a").attr("href");
		    if (href) {
			window.location = href;
		    }
		});

	    });
	</script>
    </body>
</html>
<?php
$mysqli->close();
?>
