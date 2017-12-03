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
    <div class="col-6">
      <a class="btn btn-primary" href="/conect.php"> 1. Conect</a>
    </div>
    <div class="col-6">
      <a class="btn btn-primary" href="/stock.php"> 2. Stock </a>
    </div>
  </div>

  <div class="row text-center" style="margin-right: 10%; margin-left: 10%;">

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


      $mensaje = file_get_contents( $url_conexion );
      $mensaje_json = json_decode($mensaje, true);


      $output_test = $mensaje_json['shop']['name'];

      echo('<p>El titulo de la tienda es <h3>'.$output_test.'</h3></p>');
      echo('<p>Ahora vamos a coger el nombre de un producto con una nueva petición</p>');

      $opcion = '/admin/products.json';
      $url_conexion = $api_url.$opcion;

      $mensaje = file_get_contents($url_conexion);
      $mensaje_json = json_decode($mensaje,true);

      $product_array = $mensaje_json['products'];

      $product_title = $product_array[0]['title'];

      echo('<p>El titulo del primer product de la lista es <h3>'.$product_title.'</h3></p>');


    ?>
  </div>
</body>