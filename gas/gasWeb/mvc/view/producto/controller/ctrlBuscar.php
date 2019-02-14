<?php
$server =$_SERVER["HTTP_HOST"];
$contexto = "http://" . $server ."/gasweb";
//$idProducto=trim($_GET['idProducto']);
header('Content-Type: application/json; charset=ISO-8859-1');
include("../../../util/MysqlDAO.php");

$db = new MySQL (); 


$fhInicio=isset($_GET['fhInicio'])? trim($_GET['fhInicio']): '';
$fhfin=isset($_GET['fhfin'])?trim($_GET['fhfin']):'';




if($fhInicio!=null && $fhfin!=null)	{// sino tiene fecha
	
	$sql="SELECT  t1.idproducto,t1.txtnombre,t1.txtfabricante,t1.txtemblema,t2.txtusuario,t1.fhregistro,t1.fhmodifica,t1.txtmo,t1.nestatus
	FROM t02producto t1,t01usuario t2  WHERE 1=1 AND t1.idusuario=t2.idusuario
	AND (t1.fhregistro BETWEEN '{$fhInicio} 00:00:01' AND '{$fhfin} 23:59:59')";
	
	$conn=$db->getConexion();
	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
				
			$txtnombre=$row["txtnombre"];
			$txtfabricante=$row["txtfabricante"];
			$txtemblema=$row["txtemblema"];
			$txtmo=$row["txtmo"];
			$idproducto=$row["idproducto"];
			$ligaEditar="";
			
			//$txtnombre=mb_convert_encoding($row["txtnombre"],'UTF-8','ISO-8859-1');
			//$txtfabricante=mb_convert_encoding($row["txtfabricante"],'UTF-8','ISO-8859-1');
			//$txtemblema=mb_convert_encoding($row["txtemblema"],'UTF-8','ISO-8859-1');
			$txtusuario=$row["txtusuario"];
			$nestatus=$row["nestatus"];
			
			$txtmo=$row["txtmo"];
	/*
			if($row["fhregistro"]!=null){
				$fhregistro=date_format(date_create($row["fhregistro"]), 'd/m/Y  g:i:s a');
			}else{
					
				$fhregistro="";
			}*/
			//$fhmodifica=$row["fhmodifica"];
	
	
		   if($nestatus == 0){
				$ligaEditar="
				 			<button type='button class='btn btn-success'  onclick='editarProducto({$idproducto})' 
		                           		style='cursor: pointer;' title='Editar'>
		                           		<i class='fa fa-pencil-square-o'></i></button>
							</a>";
				$nestatus="EDICI&Oacute;N";
			}else{
				
				$nestatus="TERMINADO";
			}
			$ligaEliminar="
						<button type='button class='btn btn-success'  onclick='eliminarProducto({$idproducto})'
	                           		style='cursor: pointer;' title='Eliminar'><i class='fa fa-trash'></i></button>";
			$ligaPreview="
						<button type='button class='btn btn-success' onclick='previewProducto({$idproducto})' data-toggle='modal' data-target='#myModalFrame'
									style='cursor: pointer;' title='ver'><i class='fa fa-eye'></i></button> ";
	
	
			$entrys[]= array( $idproducto,$txtmo,$txtnombre,$txtfabricante,$txtemblema,$txtusuario,$nestatus,$ligaPreview.$ligaEditar.$ligaEliminar);
	
			}
		}
		if(count($entrys) > 0) {
			$data=array('data'=>$entrys);
		}
	
		
	
}else{
	$data=array('data'=>isset($entrys)?$entrys:array());
	
}


if(count(isset($entrys)?$entrys:array()) == 0) {
	$data=array('data'=>array());
}

$db->closeSession();
$json_string = json_encode($data);
echo $json_string;
?>