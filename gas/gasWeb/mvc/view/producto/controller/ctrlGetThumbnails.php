<?php

$server =$_SERVER["HTTP_HOST"];
$contexto = "http://" . $server ."/gasweb";
$idProducto=trim($_GET['idproducto']);
header('Content-Type: application/json; charset=UTF-8');
include("../../../util/MysqlDAO.php");
$entrys;
$db = new MySQL ();

$sql="SELECT idimgproducto, idproducto, txtnombre, ntipo, txtbase64 FROM t03imgproducto WHERE idproducto=$idProducto  ";

$conn=$db->getConexion();

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
			
		$txtnombre=$row["txtnombre"];
		$src=$txtnombre;
		//$data = base64_decode($row["txtbase64"]);
		$idimgproducto=$row["idimgproducto"];


		//$liga="<a href='controller/ctrlGetFile.php?idimg={$idimgproducto}' target='_blank' >{$txtnombre} </a>";
		//$ligaEliminar="<a href='#' onclick='eliminarFile({$row["idimgproducto"]})'  ><i class='fa fa-trash'></i> </a>";
		$thumbnail="<img class='img-thumbnail' src='controller/ctrlGetFile.php?idimg={$idimgproducto}' 
		alt='{$txtnombre}' onclick='setPrincipal({$idimgproducto})'  style='cursor: pointer;'  >";


		$entrys[]= array( tipo=>$row["ntipo"],thumbnail=>$thumbnail,idimg=>$idimgproducto);

	}
	/*if(count($entrys) > 0) {
		$data=array('data'=>$entrys);
	}*/

}
/*if(count(isset($entrys)?$entrys:array()) == 0) {
	$data=array('data'=>array());
}*/

$db->closeSession();
$json_string = json_encode($entrys);
echo $json_string;

?>