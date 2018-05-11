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

	$newURL="";
	$db_name = date('M');
	$table_name = $_POST["track_link"];
	$count="";
	$dia = date('D');
	$ndia = date('j');
	$hora = date('G');
	$minuto = date('i');

  	//CheckDB(){
	//db =getDB()
	//if (!db) CreateTable($db_name);
	//else ... }

	/*Development Home
    $db = new mysqli('localhost:3306', 'root', 'root', $db_name);

	Development Work

    $db = new mysqli('localhost:3306', 'root', '', $db_name);

	Produccion

	*/
	$db = @mysqli_connect('localhost:3306', 'dummy', 'Dummy123456_', '$db_name');
	
	if (!$db) {
	    echo "Error: " . mysqli_connect_error();
		exit();
	}
  
  	//CheckTabl(){
	//table =getTable()
	//if (!table) CreateTable($table_name);
	//else ... }

	////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////// SUMAR TRACKEO LINK////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////
  	

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
	$sql = "INSERT INTO ".$table_name."(`id`, `ndia`, `dia`, `hora`, `min`) VALUES (".$count.",".$ndia.",'".$dia."',".$hora.",".$minuto.")";

	if ($db->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $db->error;
	}

	//DEBUG:
	//Count number Clicks on link

	$count = 0;


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

	////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////


	////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////SWITCH PARA HACER ACCIO (URL, JS...)//////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////


	switch ($table_name) {
	    case "lacarta":
	    	$msg = "Soy Facebook HARDCODED";	    
	    	$newURL="google.es";
	    	header('Location: '.$newURL);		
	    	die();	
			break;

	    case "facebook":
			$msg = "Soy Facebook HARDCODED";
	    	$newURL="facebook.com";
	    	header('Location:http://'.$newURL);				
	    	die();
	       	break;
	}

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
		<link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
		<link rel="manifest" href="/favicon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<style>
			a{
			text-decoration: none;
			}
			a.disabled {
				pointer-events: none;
			}
			.asterisk{
				font-weight: bolder;
			}
			.popup{
				font-family: "Arial";
				margin:0 37%;
				border-radius: 10px;
				position: fixed;
				background-color: white;
				width: 25%;
				top: 25%;
				border: 1px solid grey;
				padding: inherit;
				font-family: arial;
				opacity: 0.95;
			}
			
			.mc-field-group{
				padding-bottom: 1em;
			}
			.oculto{
				display: none;
			}
			.button{
				font-size: 14px;
				height: 45px;
				border: 1px solid #5a5a5a;
				border-radius: 3px;
				min-width: 22%;
				color: #FFF;
				background-color: #5a5a5a;
				margin:1% 2% ;
			}
			.button:hover{
				cursor: pointer;
				background-color: #646060
			}
			input[type="email"]{
					width: 90%;
			}
			.icono_cerrar{
			    width: 6.5%;
				position: absolute;
				background-color: white;
				border-radius: 100%;
				top: -3%;
				right: -3%;
				padding: 1%;
				border: 1px solid grey;	
			}
			@media (max-width: 767px) {
				#mc_embed_signup_menu{
					width: 60%;
					top: 20%;
					margin: 0 20%;
				}
				.menu_diario_titulo{
					font-size: 0.75em !important;
				}
				.menu_diario_email{
					font-size: 0.75rem !important;
				}
				.menu_diario_button{
					font-size: 10px ;
					height: 25px ;
					margin: 1% 3% ;
				}
				input[type="email"]{
					height: 1%;
				}
				#logo_carta{
					width: 85%;	
				}
				li{
					width: 30%;
				}
				ul{
					text-decoration: none;
				    list-style: NONE;
				    padding: 0;
				    text-align: right;
				    margin: 0 25% 0 -10%;
				}
			}
			
		</style>
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
	<body onclick="state_action(event)">
		<div id="wrapper" style="opacity: 1;">
			<div id="content">
				<div id="logo-claim">
					<div id="logo">
						<a href="https://www.instagram.com/metricmarket/" target="_blank">
							<img src="img/logo.png" alt="Metric Market" title="Metric Market">
						</a>
					</div>
				</div>
				<ul class="hide-for-small-only">
					<li>
						<a href="https://goo.gl/vMgSfK" target="_blank">
							<img  id="logo_carta" src="img/lacarta.png" alt="Menú Metric Market" title="Menú Metric Market"  style="width: 75%;">
						</a>
					</li>
					<li onclick="popup_open()">
						<img src="img/menudiario.png" alt="Recibe en tu correo nuestro menú diario!" title="Recibe nuestro menú diario!"  style="cursor: pointer;">
					</li>
				</ul>
				<center class="show-for-small-only">
					<ul>
						<li>
							<a href="https://goo.gl/vMgSfK" target="_blank">
								<img  id="logo_carta" src="img/lacarta.png" alt="Menú Metric Market" title="Menú Metric Market"  style="width: 75%;">
							</a>
						</li>
						<li onclick="popup_open()">
							<img src="img/menudiario.png" alt="Recibe en tu correo nuestro menú diario!" title="Recibe nuestro menú diario!"  style="cursor: pointer;">
						</li>
					</ul>
				</center>
				<div id="texto">
					<img src="img/7ways.png" alt="Metric Market" title="Metric Market">
				</div>
				
				<div id="hashtag">
					<a href="https://www.instagram.com/explore/tags/7ways2love/" target="_blank">
						<img src="img/hashtag.png" alt="+ info" title="+ info">
					</a>
				</div>
				<div id="puntos">
					<img src="img/puntos.png" alt="" title="">
				</div>
				
				<div id="mdos">
					<!--<a href="https://www.instagram.com/m2restaurante/" target="_blank">-->
					<a href="http://www.m2glutenfree.com" target="_blank">
						<img src="img/m2.png" alt="M2 restaurante" title="M2 restaurante">
					</a>
				</div>
				
				<div id="delivery">
					<a href="http://www.m2glutenfree.com" target="_blank">
						<img style="width:75%;" src="img/mensaje delivery2.jpg" alt="Delivery Schedule de 12h a 16h y de 20h a 23h" title="Information Delivery">
					</a>
					<br clear="all" />
				</div>
				
				<div id="social">
					<div class="social-item">
						<a href="https://goo.gl/4So8r5" target="_blank">
							<img src="img/facebook.png" alt="Visitanos en Facebook" title="Visitanos en Facebook">
						</a>
					</div>
					<div class="social-item">
						<a href="https://goo.gl/6mQ85t" target="_blank">
							<img src="img/insta.png" alt="Visitanos en instagram" title="Visitanos en instagram">
						</a>
					</div>
					<div class="social-item">
						<a href="https://goo.gl/EqATTq" target="_blank">
							<img src="img/spotify.png" alt="Escuchanos en soundcloud" title="Escuchanos en Spotify">
						</a>
					</div>
					<div class="social-item">
						<a href="https://goo.gl/xmo2Lh" target="_blank">
							<img src="img/mixcloud.png" alt="Escuchanos en MixCloud" title="Escuchanos en MixCloud">
						</a>
					</div>
					<div class="social-item">
						<a href="https://goo.gl/wbLvny" target="_blank">
							<img src="img/blog.png" alt="Visitanos nuestro Blog" title="Visita nuestro Blog">
						</a>
					</div>
					
					<div class="social-item">
						<a href="http://www.m2glutenfree.com" target="_blank">
							<img src="img/deliveroo.png" alt="Deliveroo" title="Deliveroo">
						</a>
					</div>
					
					<br clear="all" />
				</div>
				<!-- Begin MailChimp Signup Form -->
				<div class="show-for-small-only">
					<link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
					<style type="text/css">
						#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; width:100%;}
					/*Add your own MailChimp form style overrides in your site stylesheet or in this style block.
					We recommend moving this block and the preceding CSS link to the HEAD of your HTML file.*/
					</style>
					<div id="mc_embed_signup">
						<form action="https://mc.us13.list-manage.com/subscribe/post?u=9a010a5289a628df33a8d5f31&id=a354db57da&e=91d138b8ab" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							<div id="mc_embed_signup_scroll">
								<label for="mce-EMAIL" style="font-size: 14px;">Suscribete a nuestra newsletter</label>
								<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required style="width: 70%;margin-bottom: 0.5em;font-size: 12px;">
								<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups -->
								<div style="position: absolute; left: -5000px;" aria-hidden="true">
									<input type="text" name="b_4ef684eff3544b6068d0bd04f_4360823997" tabindex="-1" value="">
								</div>
								<div class="clear">
									<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button" style="width: 30%; margin-left: 0%;">
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="show-for-large">
					<link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
					<style type="text/css">
						#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; width:100%;}
					/*Add your own MailChimp form style overrides in your site stylesheet or in this style block.
					We recommend moving this block and the preceding CSS link to the HEAD of your HTML file.*/
					</style>
					<div id="mc_embed_signup">
						<form action="https://mc.us13.list-manage.com/subscribe/post?u=9a010a5289a628df33a8d5f31&id=a354db57da&e=91d138b8ab" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							<div id="mc_embed_signup_scroll">
								<label for="mce-EMAIL" style="font-size: 25px; margin-bottom:0.5em;">Suscribete a nuestra newsletter</label>
								<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required style="margin-bottom: 1.5em;font-size: 20px;">
								<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups -->
								<div style="position: absolute; left: -5000px;" aria-hidden="true">
									<input type="text" name="b_4ef684eff3544b6068d0bd04f_4360823997" tabindex="-1" value="">
								</div>
								<div class="clear">
									<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button" style="margin-left: 0%;">
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- End mc_embed_signup-->
			

				<div id="direc">
					<div id="dir">
						<a href="https://goo.gl/maps/vmATL4N5Y3P2" target="_blank">
							<img src="img/direccion.png">
						</a>
						<br clear="all" />
					</div>
				</div>



						<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
						  <input name="c1" value="c1">
						  <br><br>
						  <input type="submit" name="track_link" value="lacarta">  
						</form>


						<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
						  <input name="c1" value="c1">
						  <br><br>
						  <input type="submit" name="track_link" value="facebook">  
						</form>

				<?php
					echo "<h2>When submit -> Connect to DB</h2>";
					echo $msg;
					echo "<br>";
					?>



			</div>
		</div>
						<div class="popup oculto" id="mc_embed_signup_menu" na>
			<form action="https://mc.us13.list-manage.com/subscribe/post?u=9a010a5289a628df33a8d5f31&id=a354db57da&e=91d138b8ab" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
				<img class="icono_cerrar" src="img/icono_cerrar.png" onclick="popup_close()">
				
				<div id="mc_embed_signup_scroll">
					<img src="img/imagen_popup.png" style="width: 105.5%; border-top-left-radius: 10px; border-top-right-radius: 10px;" >
					<center><h3 class="menu_diario_titulo" style="margin-top: 0.2em; padding: 1%; font-size: 1.4em;">Suscríbete para recibir los menús semanales.</h3></center>
					<div class="mc-field-group" style=" padding: 1% 2%;">
					<label class="menu_diario_email" for="mce-EMAIL">E-mail Address <span class="asterisk">*</span></label>
					<input style="padding: 1%;margin: 3% 0%;" type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" autofocus>
				</div>
				<div id="mce-responses" class="clear">
					<div class="response" id="mce-error-response" style="display:none"></div>
					<div class="response" id="mce-success-response" style="display:none"></div>
					</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_4ef684eff3544b6068d0bd04f_4360823997" tabindex="-1" value=""></div>
					<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button  menu_diario_button" onclick="popup_close()"></div>
				</div>
				
			</form>
		</div>
	</body>
</html>
<script>
	//Esto se activa solo cuando se le da al botón de "Suscribirse" Por lo que no ha de actuar
	//Como un Toggle sino que simplement
	
	//Lo metemos con delay de 100 ms para que serialize este script el script del
	//state_action() y primero haga el de state_action, el estadao no estara cambiado,
	//y luego hace el analisis
	
	function popup_open(){
	setTimeout( function(){
		var popup = document.getElementById("mc_embed_signup_menu");
		var body = document.getElementById("wrapper");
		
		popup.classList.remove("oculto");
		body.style.opacity = 0.2;
		
		//Desactivar todos los links
		var a_array = document.getElementsByTagName("A");
		var n = a_array.length;
		
		for (var i = 0; i < n; i++) a_array[i].classList.add("disabled");
		
		}
		,100);
	}
	//Vamos a usar esta funcion para cerrarlo porque el Submit redirige en vez de confirmar
	function popup_close(){
		
		var popup = document.getElementById("mc_embed_signup_menu");
		var body = document.getElementById("wrapper");
		
		popup.classList.add("oculto");
		body.style.opacity = 1;
		
		//Acrtivar todos los links
		var a_array = document.getElementsByTagName("A");
		var n = a_array.length;
		
		for (var i = 0; i < n; i++) a_array[i].classList.remove("disabled");
		
		}
		
		
		//Usaremos una funcion en el body, que analize cada 100 ms, es decir CTE en el tiempo
		//En que eestado estamos:
		//NH := Not Hover, Significa que no hay PopUp => if (document.getElementById("wrapper").style.opacity = 1) then NOTHING
		//H  := Hover, Significa que hay popup => if (document.getElementById("wrapper").style.opacity < 1) then popup_close
				
		function state_action(evt) {
		
			
			var state = document.getElementById("wrapper").style.opacity;
		
			if (state != 1){
			//Hay que mirar que picamos fuera del rectangulo, si es dentro no tiene que hacer popup_out
			
				var popup = document.getElementById("mc_embed_signup_menu");
			
			var out_of_bounds = 1;
			
						var rect = popup.getBoundingClientRect();
			var x = evt.clientX;
			var y = evt.clientY;
			
			if (x > rect.left && x < rect.right && y > rect.top && y < rect.bottom) out_of_bounds = 0;
			
			if (out_of_bounds) popup_close();
			
			}
		}
</script>

