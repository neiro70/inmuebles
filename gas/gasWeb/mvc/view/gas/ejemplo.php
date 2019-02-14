<?php
// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{

  header('Content-Type: text/html; charset=UTF-8');
  include("../../../mvc/util/MysqlDAO.php");

    $input = $_POST;
    /*$cdireccion=trim($_POST['cdireccion']);
    $cnombre=trim($_POST['cnombre']);
    $ctelefono=trim($_POST['ctelefono']);
    $cimporte=trim($_POST['cimporte']);
    $clitros=trim($_POST['clitros']);
    $cpesos=trim($_POST['cpesos']);
    $cpago=trim($_POST['cpago']);
    $cmonto=trim($_POST['cmonto']);
    $cfecha=trim($_POST['cfecha']);*/
    $crfc=trim($_GET['crfc']);
    //$cobeservaciones=trim($_POST['cobeservaciones']);
    $d1 = date('Y-m-d',(strtotime('2018-01-01')));

    $db = new MySQL();   
  
    $sql="SELECT idt03cliente as cliente from t03cliente where rfc ='{$crfc}' ";
    
    $conn=$db->getConexion();
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {//el cliente existe
      while($row = $result->fetch_assoc()) {
            $numCliente=$row["cliente"];  
            $sql="INSERT INTO t02suministro (idcliente, idusuario, idtipopago, importe, litros, monto, fecha, comentarios, psuminstro) VALUES ('{$numCliente}', '1', '1', '30000', '10', '40000', CURRENT_TIMESTAMP, 'comentrio', '{$d1}')";
            if ($conn->query($sql) === TRUE) {
              $input['exito'] = $conn->insert_id;
            }else{
              $input['exito'] = 0;
            }
      }
    }else if ($result->num_rows == 0) {//si el cliente no existe lo crea
      $sql="INSERT INTO t03cliente (nombre, apaterno, amaterno, telefono, direccion, rfc) VALUES ('jorge', 'martinez', 'alfonso', '5554146857', 'av aquiles', '{$crfc}')";
      if ($conn->query($sql) === TRUE) {
          $numCliente= $conn->insert_id; 
          $sql="INSERT INTO t02suministro (idcliente, idusuario, idtipopago, importe, litros, monto, fecha, comentarios, psuminstro) VALUES ('{$numCliente}', '1', '1', '30000', '10', '40000', CURRENT_TIMESTAMP, 'comentrio', '{$d1}')";
          if ($conn->query($sql) === TRUE) {
            $input['exito'] = $conn->insert_id;
          }else{
            $input['exito'] = 0;
          }
      }else{
        $input['exito'] = 0;
      }
     
    } else{
      $input['exito'] = 0;
    }   
    //Para ver el log tail -f /Applications/AMPPS/apache/logs/error_log
    error_log("exito:{$input['exito']}", 0);
    $db->closeSession();
    

      header("HTTP/1.1 200 OK");
      echo json_encode($input);
      exit();
     
}
?>
