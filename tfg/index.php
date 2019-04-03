<?php
require_once( 'smarty_config.php' );
session_start();
?>
<html lang="en"><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" href="images/ecoem.png">
<link href="/bootstrap4.1.3/css/bootstrap.css" rel="stylesheet">
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/tfg/js/popper.min.js"></script>
	
<script src="/bootstrap4.1.3/js/bootstrap.min.js"></script>
	
<script src="/tfg/js/holder.min.js"></script>
<link href="/bootstrap4.1.3/css/icons.css" rel="stylesheet">


	
<script>
function noback(){
   window.location.hash="no-back-button";
   window.location.hash="Again-No-back-button";
   window.onhashchange=function(){
       window.location.hash="no-back-button";
   }
}
</script>

<link href="/tfg/css/album.css" rel="stylesheet">


</head>
<header>

<?php include("cabecera.php");?>

</header>
<body onLoad="noback();">    

<main  role="main">
  <section class="text-center" onload="noback();" style="background: url('/tfg/images/4.jpg') no-repeat center center fixed;
        background-size: 100%;
        -moz-background-size: 100%  ;
        -webkit-background-size: 100%;
        -o-background-size: 100%;"class=" text-center">
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      
    <div class="container ">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
      
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
    <br>
    <br>
 </section>
</main>

    
</body>
<footer style="background-color:white; position:fixed; bottom:0 ;width:100%;" class="text-muted text-center text-small border-top">
    <p class="mb-1">&copy; 2018-2019 Ecoembes</p>
</footer>

</html>