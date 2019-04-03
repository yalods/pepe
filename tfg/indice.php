<?php
require_once( 'smarty_config.php' );
require_once( 'clases/GestorBD.php' );

$gbd = new GestorBD();
session_start();

$value = $_GET['value'];

//panel de proyectos con las lineas que hay.
if ( $value == 'proyectos' ) {
	if ( isset( $_SESSION[ 'usr' ] ) ) {
		$linea = $gbd->listaLinea();
		$linea = array_values( array_unique( $linea ) );
        $usr=$_SESSION['usr'];
        $smarty->assign('usr',$usr);
		$smarty->assign( 'linea', $linea );

		$smarty->display( "proyectos.tpl" );
	} else {
		header( "Location: login.php" );
        exit();
	}
}

if ( $value == 'cuenta' ) {
	$smarty->display( "registro.tpl" );

}

//nos lleva al formulario para crear un nuevo reto/nuevo proyecto
if ( $value == 'nuevoReto' ) {

	if ( isset( $_SESSION[ 'usr' ] ) ) {
        
		header( "Location: nuevoReto.php" );
        exit();

	} else {
		header( "Location:login.php" );
        exit();

	}

}

if ( $value == 'salir' ) {
//SALIMOS DE LA APP
    session_destroy();
	header( "Location: login.php" );
    exit();
	//$smarty->display("login.");
}

//tablero de areas tematicas y estado.

if($value=='tablero'){
    if ( isset( $_SESSION[ 'usr' ] ) ) {
		$linea=$_GET['linea'];
        $at=$gbd->listaTema($linea);
        $at = array_values( array_unique($at) );
        
        $notas=$gbd->listaNotas();
        $proy=$gbd->listaProyectosLinea($linea);
        $estadoCurso=$gbd->listaProyectosLineae($linea,"En Curso");
        $estadosStand=$gbd->listaProyectosLineae($linea,"Stand By");
        $estadoFin=$gbd->listaProyectosLineae($linea,"Finalizado");
        
        $estadoEvaluar=$gbd->listaProyectosLineae($linea,"a evaluar");
        $estadoDefinicion=$gbd->listaProyectosLineae($linea,"en definicion");
        $estadoDescartados=$gbd->listaProyectosLineae($linea,"descartados");
        $presupuesto=$gbd->listaPresupuesto();
        $proveedor=$gbd->listaProvedor();
        $listA=$gbd->listaAdjudicacion();
        $lip=$gbd->obtener_archivos_pro();
        
        $smarty->assign('listAd',$listA);
        $smarty->assign('evaluar',$estadoEvaluar);
        $smarty->assign('definicion',$estadoDefinicion);
        $smarty->assign('descartados',$estadoDescartados);
         $smarty->assign('li',$lip);
        
        $smarty->assign('curso',$estadoCurso);
        $smarty->assign('gbd',$gbd);
        $smarty->assign('stand',$estadosStand);
        $smarty->assign('fin',$estadoFin);
        $smarty->assign('notas',$notas);
        $smarty->assign('presupuesto',$presupuesto);
        $smarty->assign('proy',$proy);   
        $smarty->assign('at',$at);
        $smarty->assign('provee',$proveedor);
        
        $smarty->assign('linea',$linea);
        
        $usr=$_SESSION['usr'];
        $smarty->assign('usr',$usr);
		$smarty->display('tableroAreas.tpl');
    
        
     if(isset($_GET['id'])){
        $id=$_GET['id'];
        echo "<script>window.location='/tfg/pdf.php?id=$id'</script>";   
    }
    }else {
		header( "Location:login.php" );
        exit();
	}

}
//Redirigimos al tablero Kanban
if($value=='tableroKanban'){
    if ( isset( $_SESSION[ 'usr' ] ) ) {
		$nombre=$_GET['nombre'];
        
        $tareas=$gbd->listaTareasProyecto($nombre);
        $proyecto=$gbd->proyectoNom($nombre);
        $linea=$proyecto['linea'];
        $smarty->assign('linea',$linea);
        $smarty->assign('tareas',$tareas);
        $smarty->assign('nombre',$nombre);
        $usr=$_SESSION['usr'];
        $smarty->assign('usr',$usr);
		$smarty->display('tableroKanban.tpl');
	} else {
		header( "Location:login.php" );
        exit();
	}

}
//ELIMINAR TAREAS DEL TABLERO KANBAN
if($value=='eliminarT'){
    if ( isset( $_SESSION[ 'usr' ] ) ) {
        $id=$_GET['id'];
		$nombre=$_GET['proy'];
        $gbd->eliminarTarea($id);
        $tareas=$gbd->listaTareasProyecto($nombre);
        
        $smarty->assign('tareas',$tareas);
        $smarty->assign('nombre',$nombre);
        $usr=$_SESSION['usr'];
        $smarty->assign('usr',$usr);
		$smarty->display('tableroKanban.tpl');
	} else {
		header( "Location:login.php" );
        exit();
	}

}
if($value=='A3'){
    if ( isset( $_SESSION[ 'usr' ] ) ) {
        $proyecto=$_GET['proyecto'];
		
        $presupuesto=$gbd->presupuestoId($proyecto);
        $proy=$gbd->proyectoId($proyecto);
        $em=$gbd->listaEmpleados();
        $smarty->assign('em',$em);
        $smarty->assign('pre',$presupuesto);
        $smarty->assign('proy',$proy);
         $usr=$_SESSION['usr'];
        $smarty->assign('usr',$usr);
		$smarty->display('A3.tpl');
	} else {
		header( "Location:login.php" );
        exit();
	}

}
if($value=='A3m'){
    if ( isset( $_SESSION[ 'usr' ] ) ) {
        $proyecto=$_GET['p'];
		
        $presupuesto=$gbd->presupuestoId($proyecto);
        $proy=$gbd->proyectoId($proyecto);
        $em=$gbd->listaEmpleados();
        $smarty->assign('em',$em);
        $smarty->assign('pre',$presupuesto);
        $smarty->assign('proy',$proy);
         $usr=$_SESSION['usr'];
        $smarty->assign('usr',$usr);
		$smarty->display('A3Modificar.tpl');
	} else {
		header( "Location:login.php" );
        exit();
	}

}
if($value=='adjudicacion'){
    if ( isset( $_SESSION[ 'usr' ] ) ) {
        $proyecto=$_GET['id'];
        $departamento=$gbd->listaDepartamento();
        
        $smarty->assign('id',$proyecto);
        $smarty->assign('dep',$departamento);
         $usr=$_SESSION['usr'];
        $smarty->assign('usr',$usr);
		$smarty->display('Adjudicacion.tpl');
	} else {
		header( "Location:login.php" );
        exit();
	}
}
if($value=='editarAdj'){
    if ( isset( $_SESSION[ 'usr' ] ) ) {
        $proyecto=$_GET['proyecto'];
        $ida=$_GET['ida'];
        $adj=$gbd->Adjudicacion($ida);
        $departamento=$gbd->listaDepartamento();
        $adje=$gbd->listaAdjudE($ida);
        
        $smarty->assign('ida',$ida);
        $smarty->assign('ae',$adje);
        $smarty->assign('a',$adj);
        $smarty->assign('id',$proyecto);
        $smarty->assign('dep',$departamento);
    
         $usr=$_SESSION['usr'];
        $smarty->assign('usr',$usr);
        
		$smarty->display('ModificarAdjudicacion.tpl');
	} else {
		header( "Location:login.php" );
        exit();
	}
}

if($value=='nota'){
    if ( isset( $_SESSION[ 'usr' ] ) ) {
        $idproy=$_GET['id'];
        $linea=$_GET['linea'];
        
        $smarty->assign('linea',$linea);
        $smarty->assign('id',$idproy);
         $usr=$_SESSION['usr'];
        $smarty->assign('usr',$usr);
        
		$smarty->display('NotaInterna.tpl');
	} else {
		header( "Location:login.php" );
        exit();
	}
    
    
    
    
    
}



?>