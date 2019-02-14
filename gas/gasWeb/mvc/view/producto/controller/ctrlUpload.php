<?php 
// You need to add server side validation and better error handling here
header('Content-Type: text/html; charset=UTF-8');
include("../../../../mvc/util/MysqlDAO.php");
$data = array();

if(isset($_GET['files']))
{
	$files = array();

	$idProducto=trim($_POST['idProducto']);
	$idTipoImg=trim($_POST['idTipoImg']);

	
$db = new MySQL ();  		
	$conn=$db->getConexion();
	
	foreach($_FILES as $file){	
		
		$txtNombre=$file['name'];
		$base64=base64_encode(file_get_contents($file['tmp_name']));
		$sql="INSERT INTO t03imgproducto (idproducto, txtnombre, ntipo,txtbase64)
		VALUES ('{$idProducto}','{$txtNombre}','{$idTipoImg}','{$base64}')";
		
		if ($conn->query($sql) === TRUE) {
			$data = array('success' => 1);
		} else {
			$data = array('error' => 0);
		}
		
	
	}
	
	$db->closeSession();

}
else
{
	$data = array('error' => 0);
}


echo json_encode($data);

?>

	

			