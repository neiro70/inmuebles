<?php 
// You need to add server side validation and better error handling here
header('Content-Type: text/html; charset=UTF-8');
include("../../../../mvc/util/MysqlDAO.php");
$data = array();

if(isset($_GET['files']))
{
	$files = array();

	$idcheck=trim($_POST['idcheck']);
	$posicion=trim($_POST['posicion']);
	$nombre=trim($_POST['nombre']);

	
	$db = new MySQL ();  		
	$conn=$db->getConexion();
	
	foreach($_FILES as $file){	
		
		$txtNombre=$file['name'];
		$base64=base64_encode(file_get_contents($file['tmp_name']));
		$sql="INSERT INTO t06imgchecklits (idcheck, posicion, nombre,base64)
		VALUES ('{$idcheck}','{$nombre}','{$txtNombre}','{$base64}')";
		
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

	

			