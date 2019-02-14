<?php 
header('Content-Type: text/html; charset=UTF-8');
include("../../../../mvc/util/MysqlDAO.php");
$idimg=trim($_POST['idimg']);
$error = false;

$db = new MySQL (); 

$sql="DELETE FROM t03imgproducto WHERE idimgproducto = {$idimg}";


$conn=$db->getConexion();


if ($conn->query($sql) === TRUE) {
	$error=false;
}


$db->closeSession();




$data = ($error) ? 0 : 1;
echo json_encode($data);
?>

	

			