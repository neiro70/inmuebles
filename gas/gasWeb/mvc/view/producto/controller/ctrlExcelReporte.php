<?PHP
header('Content-Type: text/html; charset=iso-8859-1');
include("../../../../mvc/util/MysqlDAO.php"); 
	$server =$_SERVER["HTTP_HOST"];
	$contexto = "http://" . $server ."/gasweb";
$db = new MySQL (); 


$fhInicio=isset($_GET['fhInicio'])? trim($_GET['fhInicio']): '';
$fhfin=isset($_GET['fhfin'])?trim($_GET['fhfin']):'';
$filename = "reporte{$fhInicio}_{$fhfin}.xls";

$server =$_SERVER["HTTP_HOST"];
$contexto = "http://" . $server ."/gasweb";



header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

?>



<table border="1" width="100%"><tr>
	<th  style="color:#FFF;" bgcolor="#17365D" height='100'>
	<img src="<?php echo $contexto;?>/img/xtc.png" width="70px">
	</th>
	<th style="color:#FFF;" bgcolor="#17365D" ><b>Producto Nombre</b></th>
	<th style="color:#FFF;" bgcolor="#17365D"><b>Nombre Fabricante</b></th>
	<th style="color:#FFF;" bgcolor="#17365D"><b>Enblema</b></th>
	<th style="color:#FFF;" bgcolor="#17365D"><b>Precio</b></th>
	<th style="color:#FFF;" bgcolor="#17365D"><b>Car&aacute;cter innovador</b></th>
	<th style="color:#FFF;" bgcolor="#17365D"><b>Definici&oacute;n completa</b></th>
	<th style="color:#FFF;" bgcolor="#17365D"><b>Valores Nutrimentales</b></th>
	<th style="color:#FFF;" bgcolor="#17365D"><b>Liga para detalle</b></th>
	</tr>
<?php 



if($fhInicio!=null && $fhfin!=null)	{// sino tiene fecha*/
	
	$sql="SELECT  t1.idproducto,t1.txtnombre,t1.txtfabricante,t1.txtemblema,t2.txtusuario,t1.fhregistro,
			t1.fhmodifica,t1.txtmo,t1.fprecio,t1.txtcaraterinova,t1.txtdefinicion,t1.txtvalores
	FROM t02producto t1,t01usuario t2  WHERE 1=1 AND t1.idusuario=t2.idusuario 
	AND (t1.fhregistro BETWEEN '{$fhInicio} 00:00:01' AND '{$fhfin} 23:59:59')";
	
	$conn=$db->getConexion();
	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		// output data of each row
		
		while($row = $result->fetch_assoc()) {
	
			$txtnombre=mb_convert_encoding($row["txtnombre"],'ISO-8859-1','UTF-8');
			$txtfabricante= mb_convert_encoding($row["txtfabricante"],'ISO-8859-1','UTF-8');
			$txtemblema=mb_convert_encoding($row["txtemblema"],'ISO-8859-1','UTF-8');
			$txtmo=$row["txtmo"];
			$fprecio=$row["fprecio"];
			$txtcaraterinova=mb_convert_encoding($row["txtcaraterinova"],'ISO-8859-1','UTF-8');
			$txtdefinicion=mb_convert_encoding($row["txtdefinicion"],'ISO-8859-1','UTF-8');
			$txtvalores=mb_convert_encoding($row["txtvalores"],'ISO-8859-1','UTF-8');
			$txtusuario=$row["txtusuario"];
			$idproducto=$row["idproducto"];
		
	
			if($row["fhregistro"]!=null){
				$fhregistro=date_format(date_create($row["fhregistro"]), 'd/m/Y  g:i:s a');
			}else{
					
				$fhregistro="";
			}
	
			echo "<tr>";
			echo "<td height='100'>{$txtmo}</td>";
			echo "<td>{$txtnombre}</td>";
			echo "<td>{$txtfabricante}</td>";
			echo "<td>{$txtemblema}</td>";
			echo "<td>{$fprecio}</td>";
			echo "<td>{$txtcaraterinova}</td>";
			echo "<td>{$txtdefinicion}</td>";
			echo "<td>{$txtvalores}</td>";
			echo "<td><a href='{$contexto}/mvc/view/producto/viewProducto.php?idproducto={$idproducto}' > link detalle </a></td>";
			echo "</tr>";
			
			
	
		}
	}
		
}
$db->closeSession();
?>
	
	
</table>



