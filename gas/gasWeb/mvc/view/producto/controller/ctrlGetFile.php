<?php

$idimg=trim($_GET['idimg']);
include("../../../../mvc/util/MysqlDAO.php");


$db = new MySQL (); 

$sql="SELECT  txtnombre, txtbase64 FROM t03imgproducto WHERE idimgproducto = $idimg  ";

$conn=$db->getConexion();

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		
		$encodedString = str_replace(' ','+',$row["txtbase64"]);
		$data = base64_decode($encodedString);
		$nombre=$row["txtnombre"];
		file_put_contents($nombre,$data);
		$stream = fopen($nombre, 'r');
		header('Content-type:application/octet-stream');
		header("Content-disposition:attachment;filename={$nombre}");
		echo stream_get_contents($stream);
		//cierra el flujo
		fclose($stream);
		//borra el archivo
		unlink($nombre);
	}
}

$db->closeSession();

?>