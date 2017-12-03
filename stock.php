<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css" />
</head>

<body>
  <div class="row text-center">
    <div class="col-sm-12">
      <h1> aPHPi Shopify </h1>
    </div>
    <div class="col-sm-12">
      <h3> 2. Stock </h3>
    </div>
    <div class="col-sm-12">
      <p> Miraremos un producto concreto de la tienda y estableceremos un valor en el stock concreto.
      Posteriormente lo haremos en funcion de condiciones como poner un umbral el qual si quedan menos actualiza,
      o hace una petición... </p>
    </div>
  </div>


  <div class="row text-center" style="margin-right: 25%; margin-left: 25%;">
    <div class="col-4">
      <a class="btn btn-primary" href="/conect.php"> 1. Conect</a>
    </div>
    <div class="col-4">
      <a class="btn btn-primary" href="/stock.php"> 2. Stock </a>
    </div>
    <div class="col-4">
      <a class="btn btn-primary" href="/index.php"> Home </a>
    </div>
  </div>

  <div class="row text-center" style="margin-right: 10%; margin-left: 10%;">
  	<div class="col-12">
  		<p>Dado el nombre de un producto veremos cuantos quedan en el stock, lo pondremos a pe: 7 y lo volveremos a mostrar</p>
  	</div>
  	<div class="col-12">
	  	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
	  		Titulo del Producto: <input type="text" name="title">
	 		<input type="submit" name="submit" value="Entra">  
		</form>
	</div>
	<div class="col-12">
	    <?php  

	      	//Primero vamos a coger el valor entrado por el input

	    	$ptitle = NULL;

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			  $ptitle = arregla_string($_POST["title"]);
			}

			function arregla_string($data) {
			  $data = trim($data);
			  $data = stripslashes($data);
			  $data = htmlspecialchars($data);
			  return $data;
			}
			if ($ptitle != NULL) echo ('<p>El nombre del producto introducido es: '.$ptitle.'. <p>');

			$API_KEY = 'X';
			$SECRET = 'Y';
			$STORE_URL = 'Z';

			//Aquí tendremos la base de las URL que usará la API
			//Usaremos la variable $opcion para poner la ruta que neceseitará para cada
			//petición concreta

			$api_url = 'https://'.$API_KEY.':'.$SECRET.'@'.$STORE_URL;

			$opcion = '/admin/products.json';
			$url_conexion = $api_url.$opcion;

			$mensaje = file_get_contents($url_conexion);
			$mensaje_json = json_decode($mensaje,true);

			$product_array = $mensaje_json['products'];


			//Busqueda del producto introducido

			$i = 0;
			$trobat = false;
			$n = sizeof($product_array);

			$product = NULL;

			while($i < $n && !$trobat){
				$current = $product_array[$i];
				echo('<p>Current: '.$current['title'].'</p>');
				if ($current['title'] == $ptitle){
					$product = $current;
					$trobat = true;
				}
				else //Es else porque abajo hago el putput que quiero que sea el mismo y sino incrementa 1 de mas. NO trascendente
				$i += 1;
			}

			if ($product != NULL) echo ('<p> El elemento $current['.$i.'] del vector era el producto '.$product['title'].'</p>');
			else echo ('Ningun product tiene el nombre introducido');

			echo ('<p> Sacamos todas las variantes y la cantidad que qeuda en el stock </p>');
	
			$n = sizeof($product['variants']);

			for ($i=0; $i < $n ; $i++) { 
				$current_variant = $product['variants'][$i];

				echo ('<p> Titulo Variant: '.$current_variant['title'].' --> #'.$current_variant['inventory_quantity'].' productos en stock. </p>');
			}

	    ?>
	</div>
  </div>
</body>


