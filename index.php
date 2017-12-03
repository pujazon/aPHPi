<h1> Shopify aPHPi 1.Acceder a la API Shopify </h1>
<?php  

  $API_KEY = 'X';
  $SECRET = 'Y';
  $STORE_URL = 'Z';

  //Aquí tendremos la base de las URL que usará la API
  //Usaremos la variable $opcion para poner la ruta que neceseitará para cada
  //petición concreta

  $api_url = 'https://'.$API_KEY.':'.$SECRET.'@'.$STORE_URL;
  $opcion = '/admin/shop.json';

  $url_conexion = $api_url.$opcion;

  echo('<p>Conectamos via URL usando API KEY y SECRET y sacamos pe nombre del primer producto del array del mensaje products.json</p>');

  $mensaje = @file_get_contents( $url_conexion );
  $mensaje_json = json_decode($mensaje, true);


  $output_test = $mensaje_json['shop']['name'];


  echo('<p>El titulo de la tienda es <h1>'.$output_test.'</h1></p>');


?>
