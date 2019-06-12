<?php
// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  header('Content-Type: text/html; charset=UTF-8');
  include("../../../mvc/util/MysqlDAO.php");

    //$input = $_POST;
    
    $crfc=trim($_POST['crfc']);
    $ctelefono=trim($_POST['ctelefono']);
    $cfecha=trim($_POST['cfecha']);
    $cdireccion=trim($_POST['cdireccion']);

    $db = new MySQL();   
  
    $sql="SELECT idt03cliente as cliente from t03cliente where rfc ='{$crfc}' ";
    
    $conn=$db->getConexion();
    
    $result = $conn->query($sql);
   
    if ($result->num_rows > 0) {//el cliente existe
     // error_log("El cliente existe", 0);
      while($row = $result->fetch_assoc()) {
            $numCliente=$row["cliente"];  
            $sql="INSERT INTO t04agendar (idcliente,telefono,direccion,fecha) VALUES ('{$numCliente}','{$ctelefono}','{$cdireccion}',CURRENT_TIMESTAMP)  " ;
            if ($conn->query($sql) === TRUE) {
              $input['exito'] = $conn->insert_id;
            }else{
              $input['exito'] = 0;
            }
      }
     }else if ($result->num_rows == 0) {//si el cliente no existe lo crea
      $input['exito'] = 0;
     }
    //Para ver el log tail -f /Applications/AMPPS/apache/logs/error_log
  //  error_log("exito:{$input['exito']}", 0);
    $db->closeSession();
    

      header("HTTP/1.1 200 OK");
      echo json_encode($input);
      exit();
     
}
?>
