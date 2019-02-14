<?php 
header('Content-Type: text/html; charset=UTF-8');
include("../../../../mvc/util/MysqlDAO.php");
$idproducto=trim($_POST['idproducto']);
$succes = false;

$db = new MySQL (); 

$sqlArchivos="DELETE FROM t03imgproducto WHERE idproducto = {$idproducto}";
$sqlProducto="DELETE FROM t02producto WHERE idproducto = {$idproducto}";


$conn=$db->getConexion();


if ($conn->query($sqlArchivos) === TRUE) {
	if ($conn->query($sqlProducto) === TRUE) {
		$succes = true;
	
	}
}

$db->closeSession();




$data = ($succes) ? 1 : 0;
echo json_encode($data);
?>

	

			