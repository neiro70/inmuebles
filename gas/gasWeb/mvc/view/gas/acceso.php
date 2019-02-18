<?php
// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{

  header('Content-Type: text/html; charset=UTF-8');
  include("../../../mvc/util/MysqlDAO.php");

    //$input = $_POST;
    $usuario=trim($_GET['usuario']);
    $password=trim($_GET['password']);

    $db = new MySQL();   
  
    $sql="SELECT * from t01usuario where txtusuario ='{$usuario}' and txtpassword ='{$password}'";
     $conn=$db->getConexion();
    
    $result = $conn->query($sql);
    $rows = array();
   
    if ($result->num_rows > 0) {//el usuario existe
     // error_log("El cliente existe", 0);
      while($row = $result->fetch_assoc()) {
        $rows[]=$row;

      }
    }  
    $db->closeSession();
    

      header("HTTP/1.1 200 OK");
      echo json_encode($rows);
      exit();
}
?>
