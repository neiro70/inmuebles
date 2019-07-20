<?php
header("Access-Control-Allow-Origin: *");
// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  header('Content-Type: text/html; charset=UTF-8');
  include("../../../mvc/util/MysqlDAO.php");

    $cnombre=trim($_POST['cnombre']);
    $cusername=trim($_POST['cusername']);
    $cpassword=trim($_POST['cpassword']);
    $crol=trim($_POST['crol']);
 


    $db = new MySQL();   
  
    $sql="SELECT idt01usuario as usuario from t01usuario where txtusuario ='{$cusername}' ";
    
    $conn=$db->getConexion();
    
    $result = $conn->query($sql);
   
 if ($result->num_rows == 0) {//si el cliente no existe lo crea
      $sql=" INSERT INTO t01usuario (idrol,txtusuario,txtpassword,txtnombre) VALUES ('{$crol}','{$cusername}','{$cpassword}','{$cnombre}')";
      if ($conn->query($sql) === TRUE) {
        $input['exito'] = $conn->insert_id;
      }else{
        $input['exito'] = 0;
      }
     
    } else{
      $input['exito'] = 1;//si existe
    }   
    //Para ver el log tail -f /Applications/AMPPS/apache/logs/error_log
    error_log("exito:{$input['exito']}", 0);
    $db->closeSession();
    

      header("HTTP/1.1 200 OK");
      echo json_encode($input);
      exit();
     
}
?>
