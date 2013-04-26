<?php
/*CRAGAR EL  SLIDE PRINCIPAL*/
include("../../includes/conexion.php");
include('../../funciones.php'); 
//Slide Principal


//Consulta de datos
	if(isset($_POST['accion'])){
		if($_POST['accion'] == 'leer'){
			$arr = array();
			$i=0;//contador
			
			$select_app="SELECT * FROM app_articulos WHERE posicion='Slide-Principal' AND estatus='1' ORDER BY id DESC";
	$r_app=mysql_query($select_app,$conexion);
	while($f_app=mysql_fetch_assoc($r_app)):
		$id_nota_app=$f_app['id'];
		$id_articulo_app=$f_app['id_articulo'];
		$plaza_app=$f_app['plaza'];
		
		$select_ar="SELECT titulo,sumario,id_seccion,autor,fecha_creacion,nota FROM articulos_".$plaza_app." WHERE id=".$id_articulo_app."";
		
		$r_ar=mysql_query($select_ar,$conexion);
		while($f_ar=mysql_fetch_assoc($r_ar)):
		$TituloSlidePrincipal=$f_ar['titulo'];
		$SumarioSlidePrincipal=$f_ar['sumario'];
		$Id_SeccionSlidePrincipal=$f_ar['id_seccion'];
		$AutorSlidePrincipal=$f_ar['autor'];
		$NotaSlidePrincipal=$f_ar['nota'];
		$Fecha_CreacionSlidePrincipal=$f_ar['fecha_creacion'];
		
		$TituloSlidePrincipal=utf8_encode($TituloSlidePrincipal);
		$SumarioSlidePrincipal=utf8_encode($SumarioSlidePrincipal);
		$AutorSlidePrincipal=utf8_encode($AutorSlidePrincipal);
		$NotaSlidePrincipal=utf8_encode($NotaSlidePrincipal);
		
		$imagen=extraer_imagen($NotaSlidePrincipal);
		$imagen=utf8_decode($imagen);
	endwhile;
	
			$select_se="SELECT seccion FROM secciones WHERE id='".$Id_SeccionSlidePrincipal."'";
			$r_se=mysql_query($select_se,$conexion);
		while($f_se=mysql_fetch_assoc($r_se)):
		$SeccionSlidePrincipal=$f_se['seccion'];
		$SeccionSlidePrincipal=utf8_encode($SeccionSlidePrincipal);
	endwhile;
		
		$html.='
	<a href="#nota" onclick="LeerNota('.$id_nota_app.')">
      <div class="ContenedorContenidoPrincipal">
        <div class="SlidePrincipalImagen" > <img src="'.$url_dominio_.'/images/imagenes-articulos/'.$imagen.'" > </div>
        <div class="SlidePrincipalContenido">
          <div class="SlidePrincipalTitulo">'.$TituloSlidePrincipal.'</div>
          <div class="SlidePrincipalSeccion">'.$SeccionSlidePrincipal.'</div>
          <div class="SlidePrincipalAutor">'.$AutorSlidePrincipal.'</div>
          <div class="SlidePrincipalFecha">'.$Fecha_CreacionSlidePrincipal.'</div>
          <div class="SlidePrincipalSumario">'.$SumarioSlidePrincipal.'</div>
        </div>
      </div>
      </a>
	';
	$mensaje="mensaje1";
	
	$arr[$i]=array(
	'id' => $mensaje
	);
	$i++;
	

endwhile;
			
			
			
			echo json_encode($arr);
		}
	}else{
		echo 0;
	}





/*
$html='<!--Slide Principal-->
    <div  class="SlidePrincipal ContenedorSlidePrincipal" >
	
	';
	$select_app="SELECT * FROM app_articulos WHERE posicion='Slide-Principal' AND estatus='1' ORDER BY id DESC";
	$r_app=mysql_query($select_app,$conexion);
	while($f_app=mysql_fetch_assoc($r_app)):
		$id_nota_app=$f_app['id'];
		$id_articulo_app=$f_app['id_articulo'];
		$plaza_app=$f_app['plaza'];
	

	$select_ar="SELECT titulo,sumario,id_seccion,autor,fecha_creacion,nota FROM articulos_".$plaza_app." WHERE id=".$id_articulo_app."";

	$r_ar=mysql_query($select_ar,$conexion);
	while($f_ar=mysql_fetch_assoc($r_ar)):
		$TituloSlidePrincipal=$f_ar['titulo'];
		$SumarioSlidePrincipal=$f_ar['sumario'];
		$Id_SeccionSlidePrincipal=$f_ar['id_seccion'];
		$AutorSlidePrincipal=$f_ar['autor'];
		$NotaSlidePrincipal=$f_ar['nota'];
		$Fecha_CreacionSlidePrincipal=$f_ar['fecha_creacion'];
		
		$TituloSlidePrincipal=utf8_encode($TituloSlidePrincipal);
		$SumarioSlidePrincipal=utf8_encode($SumarioSlidePrincipal);
		$AutorSlidePrincipal=utf8_encode($AutorSlidePrincipal);
		$NotaSlidePrincipal=utf8_encode($NotaSlidePrincipal);
		
		$imagen=extraer_imagen($NotaSlidePrincipal);
		$imagen=utf8_decode($imagen);
	endwhile;
	
	$select_se="SELECT seccion FROM secciones WHERE id='".$Id_SeccionSlidePrincipal."'";
	$r_se=mysql_query($select_se,$conexion);
	while($f_se=mysql_fetch_assoc($r_se)):
		$SeccionSlidePrincipal=$f_se['seccion'];
		$SeccionSlidePrincipal=utf8_encode($SeccionSlidePrincipal);
	endwhile;
	
$html.='
	<a href="#nota" onclick="LeerNota('.$id_nota_app.')">
      <div class="ContenedorContenidoPrincipal">
        <div class="SlidePrincipalImagen" > <img src="'.$url_dominio_.'/images/imagenes-articulos/'.$imagen.'" > </div>
        <div class="SlidePrincipalContenido">
          <div class="SlidePrincipalTitulo">'.$TituloSlidePrincipal.'</div>
          <div class="SlidePrincipalSeccion">'.$SeccionSlidePrincipal.'</div>
          <div class="SlidePrincipalAutor">'.$AutorSlidePrincipal.'</div>
          <div class="SlidePrincipalFecha">'.$Fecha_CreacionSlidePrincipal.'</div>
          <div class="SlidePrincipalSumario">'.$SumarioSlidePrincipal.'</div>
        </div>
      </div>
      </a>
	';
endwhile;

$html.='    </div>
    <!--Slide Principal-->';

*/
?>