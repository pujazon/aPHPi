<?php

//Debug///////////////////////////////////////////////////////////
	//phpinfo();
	ini_set('display_errors', 'On');
	$msg ="";
//////////////////////////////////////////////////////////////////


if ($_SERVER["REQUEST_METHOD"] == "POST"){	

	//Primero nos conectamos a la base de datos correspondiente
	//Tenemos 1 BD por Mes. En ella tendremos tantas tablas como links a trackear
	//Nos conectamos a la BD del mes que toca. Si no existe la creamos.
	//El nombre de la tabla esta puesto en el value del form que hace de enlace del 
	//link a trackear.

	$db_name = date('M');
	$table_name = $_POST["track_link"];
	$count="";
	$ndia = date('j');
	$dia = date('D');
	$hora = date('G');
	$minuto = date('i');

  	//CheckDB(){
	//db =getDB()
	//if (!db) CreateTable($db_name);
	//else ... }

	$db = new mysqli('localhost:3306', 'root', '', $db_name);
	//Produccion -> $db = @mysqli_connect('localhost:3306', 'dummy', 'Dummy123456_', $db_name);
	
	if (!$db) {
	    echo "Error: " . mysqli_connect_error();
		exit();
	}

	//Debug
	$msg = "Conencted to ".$db_name."At table".$table_name;
  
  	//CheckTabl(){
	//table =getTable()
	//if (!table) CreateTable($table_name);
	//else ... }

  	//Ahora tendremos que añadir una entrada a la tabla del link a trackear.
  	//El id será la suma de tods las tablas que hay +1

	$sql = "SELECT * FROM ".$table_name;
	$result = $db->query($sql);

	if ($result->num_rows > 0) {
	    while($result->fetch_assoc()) {$count++;}
	}
	else {
	    echo "Estaba vacío";
	}

	//Una vez tenemos los clicks hechos, sumamos 1 y añadimos.
	$count++;
	$sql = "INSERT INTO ".$table_name."(`id`,`ndia`,`dia`, `hora`, `minuto`) VALUES (".$count.",'".$dia."',".$ndia.",".$hora.",".$minuto.")";

	if ($db->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $db->error;
	}

	//Debug: Output del numero de clicks

	$count=0;

	$sql = "SELECT * FROM ".$table_name;
	$result = $db->query($sql);

	if ($result->num_rows > 0) {
	    while($result->fetch_assoc()) {$count++;}
	}
	else {
	    echo "Estaba vacío";
	}

	echo "Han clicado sobre ".$table_name," ".$count." veces!\n";
	echo "Date: ".$db_name."/".$dia." -- ".$hora." : ".$minuto;

  }
  
?>



<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>Restaurante Metric Market, no convencional. | M2 Restaurante, gluten free.</title>
		<meta name="description" content="Restaurante Barcelona. Cocktail-Bar. Cocina internacional, tapas para comer aquí o llevar. Cenas para grupos, fiestas privadas y eventos . Coctelería creativa. Eventos de arte. Live Music. Siempre acompañado de la mejor música. M2 Restaurant. Healthy. Gluten Free. Delivery. Take Away.">
		<meta name="viewport" content="initial-scale=1, width=device-width">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation-float.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation-rtl.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation-prototype.css" />
		<link rel="stylesheet" href="style.css" type="text/css" />

		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-83202153-1', 'auto');
		ga('send', 'pageview');
		</script>
		<script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">require(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us13.list-manage.com","uuid":"9a010a5289a628df33a8d5f31","lid":"1f3becfca1"}) })</script>
	</head>
	<body>
		<div id="wrapper" style="opacity: 1;">
			<div id="content">
				<h1> Git mastered support </h1>
						<div onclick="tpopup()">
							<h2> Enlace a JS function() </h2>
						</div>
						<a href="./cmain.php">
							<h2> Enlace a resource interno </h2>
						</a>
						<a href="https://www.instagram.com/metricmarket/" target="_blank">
							<h2> Enlace a resource externo, link </h2>
						</a>

						<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
						  <input name="c1" value="c1">
						  <br><br>
						  <input type="submit" name="track_link" value="lacarta">  
						</form>

				<?php
					echo "<h2>When submit -> Connect to DB</h2>";
					echo $msg;
					echo "<br>";
					?>
				</div>
		</div>
	</body>
</html>
<script>

	function tpopup(){
		alert("Enlace");
	}
	
</script>
