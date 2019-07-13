<?php

// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{ 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: text/html; charset=UTF-8');
  include("../../../mvc/util/MysqlDAO.php");

   
    $idUsuario=trim($_GET['idUsuario']);

    $db = new MySQL();   
  
    $sql="select * from t05checklist t5  LEFT JOIN  t06imgchecklits t6 on t5.idChecklist=t6.idcheck where idUsuario = ${idUsuario}";
    
    $conn=$db->getConexion();
    
    $result = $conn->query($sql);
    $rows = array();
   
    if ($result->num_rows > 0) {//el cliente existe
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
