<?php 
 
 	header('Content-Type: text/html; charset=iso-8859-1');
 	include("../../../../mvc/util/MysqlDAO.php");

 	$txtnombre=trim($_POST['txtnombre']);
 	$fprecio=$_POST["txtprecio"]!=null ?$_POST["txtprecio"]:0;
 	$txtfabricante=trim($_POST['txtfabricante']);
 	$txtemblema=trim($_POST['txtemblema']);
 	$txtmo= trim($_POST['txtmo']);
 	$txtcaraterinova=trim($_POST['txtcaraterinova']);
 	$txtdefinicion=trim($_POST['txtdefinicion']);
 	$txtvalores=trim($_POST['txtvalores']);
 	
 	$finalizar=isset($_POST["finalizar"])?$_POST["finalizar"]:0;
 	
 	//LOCAL
 	//$txtnombre = utf8_decode(trim($_POST['txtnombre']));
	//$txtfabricante=utf8_decode(trim($_POST['txtfabricante']));
	//$txtemblema=utf8_decode(trim($_POST['txtemblema']));
	//$txtmo= utf8_decode(trim($_POST['txtmo']));	
	//$txtcaraterinova=utf8_decode(trim($_POST['txtcaraterinova']));
	//$txtdefinicion=utf8_decode(trim($_POST['txtdefinicion']));
	//$txtvalores=utf8_decode(trim($_POST['txtvalores']));
	$idproducto=$_POST['idproducto'];
	
	$db = new MySQL();  
	
	$sql="UPDATE t02producto SET txtnombre='{$txtnombre}',txtfabricante='{$txtfabricante}',txtemblema='{$txtemblema}',nestatus={$finalizar},
			txtmo='{$txtmo}',fprecio='{$fprecio}',txtcaraterinova='{$txtcaraterinova}',txtdefinicion='{$txtdefinicion}',txtvalores='{$txtvalores}',
			fhmodifica= CURRENT_TIMESTAMP 
			WHERE idproducto = {$idproducto}";
	
	
	$conn=$db->getConexion();
	 
	
	if ($conn->query($sql) === TRUE) {
		echo "Se actualizo producto! ";
	} else {
		echo "Error: ".$conn->error;
	}
	

	$db->closeSession();
	
	//echo "'{$txtnombre}','{$txtfabricante}','{$txtemblema}','{$txtmo}','{$fprecio}','{$txtcaraterinova}','{$txtdefinicion}','{$txtvalores}')";
?>

    

 
