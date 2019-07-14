
<?php
header("Access-Control-Allow-Origin: *");
// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  header('Content-Type: text/html; charset=UTF-8');
  include("../../../mvc/util/MysqlDAO.php");

    //$input = $_POST;
    
    $litros=trim($_POST['litros']);
    $aceite=trim($_POST['aceite']);
    $anticongelante=trim($_POST['anticongelante']);
    $llantas=trim($_POST['llantas']);
    $limpieza=trim($_POST['limpieza']);
    $reporte=trim($_POST['reporte']);
    $idUsuario=trim($_POST['idUsuario']);
    $foto=trim($_POST['foto']);
    $idImg=trim($_POST['idImg']);

    $db = new MySQL();      
    $conn=$db->getConexion();
    $sql = "INSERT INTO t05checklist ( litros, aceite, anticongelante, llantas, limpieza, reporte, foto, idUsuario,fecha) VALUES ('{$litros}', '{$aceite}', '{$anticongelante}', '{$llantas}', '{$limpieza}', '{$reporte}', '{$foto}' ,'{$idUsuario}', CURRENT_TIMESTAMP ) ";

    if ($conn->query($sql) === TRUE) {
      $idCheck=$conn->insert_id;

      $sql = "UPDATE t06imgchecklits SET  idcheck={$idCheck} WHERE idimg ={$idImg} ";
      if ($conn->query($sql) === TRUE) {
        $input['exito'] = $idCheck;
      }else{
        $input['exito'] = 0;
      }

    }else{
      $input['exito'] = 0;
    }

    //Para ver el log tail -f /Applications/AMPPS/apache/logs/error_log
    //error_log("exito:{$input['exito']}", 0);
    $db->closeSession();
    

      header("HTTP/1.1 200 OK");
      echo json_encode($input);
      exit();
     
}
?>
