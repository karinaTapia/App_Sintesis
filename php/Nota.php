
<?php
include("../../includes/conexion.php");
include('../../funciones.php'); 


$id=$_POST['id'];


$select_app="SELECT * FROM app_articulos WHERE id='".$id."'";
	$r_app=mysql_query($select_app,$conexion);
	while($f_app=mysql_fetch_assoc($r_app)):
		$id_nota_app=$f_app['id'];
		$id_articulo_app=$f_app['id_articulo'];
		$plaza_app=$f_app['plaza'];
	

	$select_ar="SELECT titulo,sumario,id_seccion,autor,fecha_creacion,nota FROM articulos_".$plaza_app." WHERE id=".$id_articulo_app."";

	$r_ar=mysql_query($select_ar,$conexion);
	while($f_ar=mysql_fetch_assoc($r_ar)):
		$Titulo=$f_ar['titulo'];
		$Sumario=$f_ar['sumario'];
		$Id_Seccion=$f_ar['id_seccion'];
		$Autor=$f_ar['autor'];
		$Nota=$f_ar['nota'];
		$Fecha_Creacion=$f_ar['fecha_creacion'];
		
		$Titulo=utf8_encode($Titulo);
		$Sumario=utf8_encode($Sumario);
		$Autor=utf8_encode($Autor);
		$Nota=utf8_encode($Nota);
		
		$imagen=extraer_imagen($Nota);
		$imagen=utf8_decode($imagen);
	endwhile;
	
	$imagen=$url_dominio_.'/images/imagenes-articulos/'.$imagen;
	$Nota=str_replace($imagen,'',$Nota);
	$Nota=str_replace('<img src="" alt="" />','',$Nota);
	
	
	$imagen='<img src="'.$imagen.'">';
	
	$select_se="SELECT seccion,seudonimo FROM secciones WHERE id='".$Id_Seccion."'";
	$r_se=mysql_query($select_se,$conexion);
	while($f_se=mysql_fetch_assoc($r_se)):
		$Seccion=$f_se['seccion'];
		$SeccionSeudonimo=$f_se['seudonimo'];
		$Seccion=utf8_encode($Seccion);
	endwhile;
endwhile;


$html="back_".$SeccionSeudonimo.'&'.$Seccion.'&'.$imagen.'&'.$Titulo.'&'.$Sumario.'&'.$Autor.'&'.$Fecha_Creacion.'&'.$Nota;

	  
$select_app="SELECT * FROM app_articulos WHERE id!='".$id."' AND plaza='".$plaza_app."' ORDER BY id DESC LIMIT 3";
$r_app=mysql_query($select_app,$conexion);
while($f_app=mysql_fetch_assoc($r_app)):
	$id_nota_app=$f_app['id'];
	$id_articulo_app=$f_app['id_articulo'];
	$plaza_app=$f_app['plaza'];
	

$select_ar="SELECT titulo,sumario,id_seccion,autor,fecha_creacion,nota FROM articulos_".$plaza_app." WHERE id=".$id_articulo_app."";

	$r_ar=mysql_query($select_ar,$conexion);
	while($f_ar=mysql_fetch_assoc($r_ar)):
		$Titulo=$f_ar['titulo'];
		$Sumario=$f_ar['sumario'];
		$Id_Seccion=$f_ar['id_seccion'];
		$Autor=$f_ar['autor'];
		$Nota=$f_ar['nota'];
		$Fecha_Creacion=$f_ar['fecha_creacion'];
		
		$Titulo=utf8_encode($Titulo);
		$Sumario=utf8_encode($Sumario);
		$Autor=utf8_encode($Autor);
		$Nota=utf8_encode($Nota);
		
		$imagen=extraer_imagen($Nota);
		$imagen=utf8_decode($imagen);
	endwhile;
	
	$imagen=$url_dominio_.'/images/imagenes-articulos/'.$imagen;
	$Nota=str_replace($imagen,'',$Nota);

$ContenidoExtra.='
			<div class="NotaExtraContenedor">
            	<div class="NotaExtraTitulo back_'.$SeccionSeudonimo.'">
					'.$Titulo.'
				</div>
				
				<div class="NotaExtraImagen">
					<img src="'.$imagen.'">
				</div>
				
				<div class="NotaExtraSumario">
					'.$Sumario.'
				</div>
				
				<a href="#nota" onclick="LeerNota('.$id_nota_app.')">
				<div class="NotaExtraLeerMas back_'.$SeccionSeudonimo.'">
					Leer Más
				</div>
				</a>
            </div>
			';
endwhile;

$html.="&".$ContenidoExtra;
echo $html;


?>