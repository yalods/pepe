<?php
require_once( "clases/GestorBD.php" );
require_once( "clases/Empleado.php" );
require_once( 'smarty_config.php' );
 $e = array();
if ( ! empty( $_POST ) ) {
	$gbd = new GestorBD();
   

	$usr = $_POST[ 'usr' ];
	$pwd = $_POST[ 'pwd' ];
    
	if ( $gbd->empleadoUsr($usr) !=1 ) {
		array_push( $e, "El usuario no existe" );
	} else if ( $gbd->usuarioPwd( $usr, $pwd) !=1 ) {
		array_push( $e, "La contraseña no es correcta" );
	}

	if ( count( $e ) == 0 ) {
		if ( !isset( $_SESSION ) ) {
			session_start();
			
		}
		
		$_SESSION[ "usr" ] = $usr;
		header("Location:index.php" );
        exit();
	}
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Login</title>
    <link rel="shortcut icon" href="images/ecoem.png">
	<!-- Bootstrap core CSS -->
	<link href="/bootstrap4.1.3/css/bootstrap.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="../../tfg/js/popper.min.js"></script>
	<script src="/bootstrap4.1.3/js/bootstrap.min.js"></script>
	<link href="../../tfg/css/signin.css" rel="stylesheet">	
	<script>
	function noback(){
	   window.location.hash="no-back-button";
	   window.location.hash="Again-No-back-button"
	   window.onhashchange=function(){window.location.hash="no-back-button";}
	}
</script>
</head>
<body class="" style=" background: url('/tfg/images/1.jpg') no-repeat center  fixed;
        background-size: 100%;
        -moz-background-size: 100%  ;
        -webkit-background-size: 100%;
        -o-background-size: 100%;" class="text-center shadow" onLoad="noback();">
    
	<form class="form-signin border shadow-sm bg-white" action="/tfg/login.php" method="post">


		<img src="/tfg/images/ecoembes2.png" alt=""  width="163" style="display: block;margin: auto">
		<p><p/>
        <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1>
		
		
		<?php if (!empty($e)){?>
	
		<?php for ($i = 0; $i < count($e); $i++){?>
			<div class="alert alert-success alert-dismissible fade show">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $e[$i];?>
			</div>

		<?php }}?>
			

		<label for="usr" class="sr-only">Usuario</label>
		<input type="text" id="usr" name="usr" class="form-control" placeholder="Usuario" required autofocus>

		<label for="pwd" class="sr-only">Contraseña</label>
		<input type="password" id="pwd" name="pwd" value="" class="form-control" placeholder="Contraseña" required>

		<div class="checkbox mb-3">
			<label> <a style="text-emphasis-position: left" href="/tfg/indice.php?value=cuenta">Crear cuenta </a></label>

		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
		<p class="mt-5 mb-3 text-muted">&copy; 2018-2019 Ecoembes</p>

	</form>
</body>
</html>