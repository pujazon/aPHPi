<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>PHP Counters</title>
		<meta name="description" content="Restaurante Barcelona. Cocktail-Bar. Cocina internacional, tapas para comer aquí o llevar. Cenas para grupos, fiestas privadas y eventos . Coctelería creativa. Eventos de arte. Live Music. Siempre acompañado de la mejor música. M2 Restaurant. Healthy. Gluten Free. Delivery. Take Away.">
		<meta name="viewport" content="initial-scale=1, width=device-width">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation-float.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation-rtl.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation-prototype.css" />
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body>
		<h1> PHP Counters </h1>
		
<?php

	$con = @mysqli_connect('http://51.38.46.56:3306/', 'dummy', 'Dummy123456_', 'counters');

	if (!$con) {
	    echo "Error: " . mysqli_connect_error();
		exit();
	}
	echo 'Connected to MySQL';

?>
	</body>
</html>