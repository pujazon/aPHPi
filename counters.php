
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>Tracnkins links</title>
	</head>
	<body>
		<h1> Links clicados: </h1>

		<br> <hr> <hr> <br>

		<?php

			//Primero nos conectamos a la base de datos correspondiente
			//Tenemos 1 BD por Mes. En ella tendremos tantas tablas como links a trackear
			//Nos conectamos a la BD del mes que toca. Si no existe la creamos.
			//El nombre de la tabla esta puesto en el value del form que hace de enlace del 
			//link a trackear.

			$db_name = date('M');
			$v = array("lacarta", "menud", "facebook", "instagram");
			$N = count($v);
			echo "Hay ".$N." elementos <br>";
			$count=0;
			$i=0;

			for ($i=0; $i < $N ; $i++) { 

			  	//CheckDB(){
				//db =getDB()
				//if (!db) CreateTable($db_name);
				//else ... }

			    $db = @mysqli_connect('localhost:3306', 'root', 'root', $db_name);
				//Produccion -> $con = @mysqli_connect('devphp.lafamiglia.me:3306', 'dummy', 'Dummy123456_', 'counters');
				
				if (!$db) {
				    echo "Error: " . mysqli_connect_error();
					exit();
				}
			  
			  	//CheckTabl(){
				//table =getTable()
				//if (!table) CreateTable($table_name);
				//else ... }

				////////////////////////////////////////////////////////////////////////////////////////////////
				///////////////////// OUTPUT TRACK TABLE////////////////////////////////////////////////////////
				////////////////////////////////////////////////////////////////////////////////////////////////

				$table_name = $v[$i];

				echo "<h1>".$table_name."</h1>";

				$count=0;

				$sql = "SELECT * FROM ".$table_name;
				$result = $db->query($sql);

				if ($result->num_rows > 0) {
				    while($row = $result->fetch_assoc()) {
	        			echo "id: ".$row["id"]."-Date: ".$row["ndia"]. " ".$row["dia"]." ".$row["hora"]." ".$row["min"]."<br>";
				    	$count++;
				    }
				}
				echo "Clicks: ".$count."<br><br><hr><hr><br><br>";
			}

		?>

	</body>
</html>