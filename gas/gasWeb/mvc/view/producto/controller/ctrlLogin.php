<?php


$server =$_SERVER["HTTP_HOST"];
$contexto = "http://" . $server ."/gasweb";
include("../../../../mvc/util/MysqlDAO.php");

$msg = "&iexcl;Datos incorrectos!";
 
if (isset($_POST['login']) && !empty($_POST['username'])
		&& !empty($_POST['password'])) {
			 
			 
			$db = new MySQL();  
			$sql="SELECT COUNT(idUsuario) as existe  FROM t01usuario WHERE txtusuario='".$_POST['username']."' AND txtpassword = '".$_POST['password']."' ";
			$con=$db->getConexion();
			 
			$result = $con->query($sql);
			 
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {

					if($row ['existe'] == 1){
						$_SESSION['valid'] = true;
						$_SESSION['timeout'] = time();
						$_SESSION['username'] = $_POST['username'];

						$sql="SELECT idusuario FROM t01usuario WHERE txtusuario = '{$_POST['username']}'  ";
						$conn=$db->getConexion();
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$_SESSION['idusuario']=$row["idusuario"];
							}
						}
						header("location:../viewNuevo.php");
					}else{
						$msg = '&iexcl;Datos incorrectos!';
						 
					}
				}
			} else {
				$msg = '&iexcl;Datos incorrectos!';
			}

			$db->closeSession();
			 
		}
	echo $msg;


?>