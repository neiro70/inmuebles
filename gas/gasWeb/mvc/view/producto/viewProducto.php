<?php

	$server =$_SERVER["HTTP_HOST"];
	$contexto = "http://" . $server ."/gasweb";


	header('Content-Type: text/html; charset=ISO-8859-1');
	include("../../../mvc/util/MysqlDAO.php");
	
	$usuario=$_SESSION['username'];
	$idusuario=$_SESSION['idusuario'];
	$idproducto=trim($_GET["idproducto"]);
	$isEditar=isset($_GET['isEditar'])? trim($_GET['isEditar']): '0';
	$txtnombre = "";
	$txtfabricante="";
	$txtemblema="";
	$txtmo= "";
	$fprecio="";
	$txtcaraterinova="";
	$txtdefinicion="";
	$txtvalores="";
	
	$db = new MySQL (); 
	
	$sql="SELECT t1.txtnombre,t1.txtfabricante,t1.txtemblema,
			t1.txtmo,t1.fprecio,t1.txtcaraterinova,t1.txtdefinicion,t1.txtvalores
			FROM t02producto t1  WHERE 1=1 AND t1.idproducto={$idproducto} ";
	
	$conn=$db->getConexion();
	
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
	
			$txtnombre=mb_convert_encoding($row["txtnombre"],'ISO-8859-1','UTF-8');
			//$txtfabricante=$row["txtfabricante"];
			$txtfabricante= mb_convert_encoding($row["txtfabricante"],'ISO-8859-1','UTF-8');
			$txtemblema=mb_convert_encoding($row["txtemblema"],'ISO-8859-1','UTF-8');
			$txtmo=$row["txtmo"];
			$fprecio=$row["fprecio"];
			$txtcaraterinova=mb_convert_encoding($row["txtcaraterinova"],'ISO-8859-1','UTF-8');
			$txtdefinicion=mb_convert_encoding($row["txtdefinicion"],'ISO-8859-1','UTF-8');
			$txtvalores=mb_convert_encoding($row["txtvalores"],'ISO-8859-1','UTF-8');
		
			/*
				$txtnombre=mb_convert_encoding($row["txtnombre"],'UTF-8','ISO-8859-1');
				$txtfabricante=mb_convert_encoding($row["txtfabricante"],'UTF-8','ISO-8859-1');
				$txtemblema=mb_convert_encoding($row["txtemblema"],'UTF-8','ISO-8859-1');
				$txtmo=mb_convert_encoding($row["txtmo"],'UTF-8','ISO-8859-1');
				$fprecio=mb_convert_encoding($row["fprecio"],'UTF-8','ISO-8859-1');
				$txtcaraterinova=mb_convert_encoding($row["txtcaraterinova"],'UTF-8','ISO-8859-1');
				$txtdefinicion=mb_convert_encoding($row["txtdefinicion"],'UTF-8','ISO-8859-1');
			$txtvalores=mb_convert_encoding($row["txtvalores"],'UTF-8','ISO-8859-1');*/
	
		}
	
	}
	$db->closeSession();
	
	
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>XTC Detalle de producto</title>
   <link rel="shortcut icon" href="<?=$contexto?>/img/xtc.png" type="image/png">
    <!-- Bootstrap Core CSS -->
    <link href="<?=$contexto?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
     <link href="<?=$contexto?>/css/sb-admin.css" rel="stylesheet"> 
    <!-- Custom Fonts -->
    <link href="<?=$contexto?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link href="<?=$contexto?>/css/jquery.fileupload.css" rel="stylesheet">
    <link href="<?=$contexto?>/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?=$contexto?>/css/toastr.css" rel="stylesheet" type="text/css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


<style type="text/css">
.portfolio-item {
    margin-bottom: 25px;
}

footer {
    margin: 50px 0;
}

</style>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <img alt="xtc" src="<?=$contexto?>/img/xtc.png" width="65px" >
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-book"></i>  Producto
                            </li>
                            <li class="active">
                                <?php echo $txtnombre;?>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-8">
                <img class="img-thumbnail" id="thumbnailPrincipal" name="thumbnailPrincipal" src="" alt="">

            </div>

            <div class="col-md-4">
                <h3>Detalles del producto </h3>
                <ul>
                	<li><b>N�mero Producto:</b> <?php echo $idproducto;?>	</li>
                    <li><b>Fabricante:</b> <?php echo $txtfabricante;?>	</li>
                    <li><b>Emblema:</b> <?php echo $txtemblema;?></li>
                    <li><b>Precio:</b> <?php  setlocale(LC_MONETARY, 'es_MX');  echo money_format('%n',$fprecio);?> MXN </li>
                    <li><b>MO:</b> <?php echo $txtmo;?></li>
                </ul>
                <h3>Caracter Inovador</h3>
                <p><?php echo $txtcaraterinova?></p>
            
                <h3>Definici�n completa</h3>
                <p><?php echo $txtdefinicion?></p>


            </div>

        </div>
        <!-- /.row -->
         <div class="row" >  
            <div class="col-lg-12">
              <h3 class="page-header">Valores Nuntrimentales</h3>
                <p><?php echo $txtvalores;?></p>   
         	</div> 
         </div>
        <!-- Related Projects Row -->
        <div class="row">

            <div class="col-lg-12">
                <h3 class="page-header">Imagenes del producto</h3>
            </div>
            
        </div>
        
        <div class="row"  >    
            <div id="divThumbnails" >
            		<!-- div para cargar dinamicamente -->
            </div>

        </div>

        <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
       <div id="clock-loader" style="display: none;">				
		<div style="font-weight: bold; color: white; font-size: 12pt;">
			<img src="<?=$contexto?>/img/ajax-loader.gif" alt="" border="0" /><br>Procesando...
		</div>	
	</div>	

    <!-- jQuery -->
    <script src="<?=$contexto?>/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=$contexto?>/js/bootstrap.min.js"></script>
   	<script src="<?=$contexto?>/js/toastr.min.js"></script>
	<script src="<?=$contexto?>/js/jquery.blockUI.js"></script>
	<script src="<?=$contexto?>/js/ajaxUtil.js"></script>
	<script src="<?=$contexto?>/js/jquery.dataTables.min.js"></script>
	<script src="<?=$contexto?>/js/dataTables.buttons.min.js"></script>
	<script src="<?=$contexto?>/js/dataTables.tableTools.js"></script>
    
    <script type="text/javascript">

    $( document ).ready(function() {
 
    	getThumbnails();

    });

    function getThumbnails(){

    	var params="idproducto="+<?php echo $idproducto;?>;

    	
    	$.ajaxSetup ({ cache: false });
    	//iniciar el registro
    	$.ajax('<?=$contexto?>/mvc/view/producto/controller/ctrlGetThumbnails.php', {
    	  	  type: 'GET', 
    	  	  data:params,
    	  	   beforeSend: function( xhr ) {
    		       showloading();
    	  	  },
    	      success: function(data) {

    	    	  var idimg=0;
    	    
    	       $.each(data, function (key, val) {    	           
    	            var div="<div class='col-md-4 col-xs-6'> "+val.thumbnail;
 	                "</div>";
					 $("#divThumbnails").append(div);
					 idimg=val.idimg;
    	           
    	       });

    	       $("#thumbnailPrincipal").attr("src","controller/ctrlGetFile.php?idimg="+idimg);
    	    	  
    	       	},
    	      error: function(jqXHR, textStatus, errorThrown) {
    	    	  toastr.error('ERRORS: ' + textStatus);
    	      },
    	      complete: function() {
    	          hideloading();
    	         
    	      }
    	   });

  }




    function setPrincipal(idimg){
        showloading();
		$("#thumbnailPrincipal").attr("src","controller/ctrlGetFile.php?idimg="+idimg);
		  hideloading();
    }

    </script>

</body>

</html>
