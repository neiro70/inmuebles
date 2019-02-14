<?php 
 
	session_start();
 	header('Content-Type: text/html; charset=UTF-8');
 	include("../../../../mvc/util/MysqlDAO.php");

 	$idusuario=$_SESSION['idusuario'];
 	
 	$txtnombre = "";
	$txtfabricante="";
	$txtemblema="";
	$txtmo= "";
	$fprecio="0";
	$txtcaraterinova="";
	$txtdefinicion="";
	$txtvalores="";
	
	$db = new MySQL();   
	
	
	
	$sql="INSERT INTO t02producto (idusuario, txtnombre, txtfabricante,txtemblema,txtmo,fprecio,txtcaraterinova,txtdefinicion,txtvalores,fhregistro) 
						   VALUES ($idusuario,'{$txtnombre}','{$txtfabricante}','{$txtemblema}','{$txtmo}','{$fprecio}','{$txtcaraterinova}','{$txtdefinicion}','{$txtvalores}',CURRENT_TIMESTAMP)";
			
	$conn=$db->getConexion();
	 
	//echo "ZZZZ:".$sql;
	
	if ($conn->query($sql) === TRUE) {
		echo $conn->insert_id;
	} else {
		echo 0;
	}
	

	$db->closeSession();
	
	//echo "'{$txtnombre}','{$txtfabricante}','{$txtemblema}','{$txtmo}','{$fprecio}','{$txtcaraterinova}','{$txtdefinicion}','{$txtvalores}')";
?>

    

 
