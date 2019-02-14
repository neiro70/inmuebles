<?php

	session_start();
	if(!isset($_SESSION['username'])){
		header("location:/gasweb/index.php");
	}
	include("../../../mvc/util/MysqlDAO.php");
	$server =$_SERVER["HTTP_HOST"];
	$contexto = "http://" . $server ."/gasweb";
	$usuario=$_SESSION['username'];
	$idusuario=$_SESSION['idusuario'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>XTC Registro de producto</title>
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
    
    <link href="<?=$contexto?>/css/bootstrap3-dialog/css/bootstrap-dialog.css" rel="stylesheet" type="text/css" />
 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <img alt="xtc" src="<?=$contexto?>/img/xtc.png" width="65px"  style="padding-top: 10px;">
         
                
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                   
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $usuario; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Perfil</a>
                        </li>
                        <li>
                            <a href="<?=$contexto?>/logout.php"><i class="fa fa-fw fa-power-off"></i> Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#producto"><i class="fa fa-fw fa-book"></i> Producto <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="producto" class="collapse">
                            <li>
                                <a href="<?=$contexto?>/mvc/view/producto/viewNuevo.php" ><i class="fa fa-fw fa-edit"></i> Registro</a>
                            </li>
                            <li>
                                <a href="<?=$contexto?>/mvc/view/producto/viewBuscar.php"><i class="fa fa-fw fa-search"></i> Buscar</a>
                            </li>
                             <li>
                                <a href="<?=$contexto?>/mvc/view/producto/viewFacturar.php"><i class="fa fa-fw fa-money"></i> Facturar</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    
                        <h1 class="page-header">
                            Registro de Producto
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> Producto
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Registro
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                <form id="formProducto" name="formProducto" role="form">
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label># Producto</label>
                                <input  type="hidden" class="form-control" id="idproducto" name="idproducto">
                                <input  type="text" disabled="disabled" class="form-control" id="idproductotmp" name="idproductotmp">
                            </div>
                            <div class="form-group">
                                <label>Nombre Producto</label>
                                <input class="form-control" id="txtnombre" name="txtnombre">
                                <p class="help-block">Ejemplo 'Quaker Granola'.</p>
                            </div>
                            <div class="form-group">
                                <label>Nombre Fabricante</label>
                                <input class="form-control" id="txtfabricante" name="txtfabricante">
                                <p class="help-block">Ejemplo 'Pepsico M�xico'.</p>
                            </div>
                            <div class="form-group">
                                <label>Emblema</label>
                                <input class="form-control" id="txtemblema" name="txtemblema">
                                <p class="help-block">Ejemplo 'Tiendas Soriana'.</p>
                            </div>
							<div class="form-group input-group">
                            	
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control" id="txtprecio" name="txtprecio">
                             
                            </div>
                            
                            <div class="form-group">
                            	<span class="btn btn-default fileinput-button">
							                    <i class="glyphicon glyphicon-plus"></i>
							                    <span>Imagenes Adjuntas</span>
							                    <input type="file" name="fileImagen"  id="fileImagen" >
							    </span>   
                            	
                            </div>


                    </div>
                    <div class="col-lg-6">  
                             <div class="form-group">
                                <label>MO</label>
                                <input class="form-control" id="txtmo" name="txtmo">
                                <p class="help-block">Ejemplo 1234567.</p>
                            </div>                                              

                            <div class="form-group">
                                <label>Caracter Inovador</label>
                                <input class="form-control" id="txtcaraterinova" name="txtcaraterinova">
                                <p class="help-block">Ejemplo 'Leche de almendras sin gluten'.</p>
                            </div>
                            <div class="form-group">
                                <label>Definici�n completa</label>
                                <textarea class="form-control" rows="3" id="txtdefinicion" name="txtdefinicion" ></textarea>
                            </div>
							<div class="form-group">
                            	<span class="btn btn-default fileinput-button">
							                    <i class="glyphicon glyphicon-plus"></i>
							                    <span>Imagen tabla nutrimentales</span>
							                    <input type="file" name="fileNutrimental"  id="fileNutrimental" >
							    </span>   
                            
                            </div>
                            <div class="form-group">
                                <label>Valores Nuntrimentales</label>
                                <textarea class="form-control" rows="3" id="txtvalores" name="txtvalores"></textarea>
                            </div>                            
					</div>
                </form>
                </div>
                <!-- /.row -->
                <div class="row">
                           <div class="col-lg-12">
	                           <div class="form-group">
                        			<div class="panel panel-info">
                            			<div class="panel-heading">
			                                <h3 class="panel-title">Lista de archivos</h3>
			                            </div>
			                            <div class="panel-body table-responsive" >
			                           			<table id="example"  class="display" cellspacing="0" width="100%">
					        						<thead>
														<tr>
															<th>NOMBRE</th>
															<th>TIPO</th>
															<th>PREVIEW</th>
															<th>ELIMINAR</th>						
														</tr>
														
														</thead>
					    							</table>
			                            </div>
                        			</div>
	                             </div>
                            </div>  
                			<div class="col-lg-12">
                                 <div class="form-group pull-right">
                                                <button type="button" class="btn btn-warning" style="cursor: pointer;" id="idBuscar" 
                                 				name="idBuscar" data-toggle='modal' data-target='#myModalFrame'><i class='fa fa-search'></i> Buscar</button>
                                 
                                                <button type="button" class="btn btn-info" style="cursor: pointer;" id="idPreview" 
                                 				name="idPreview" data-toggle='modal' data-target='#myModalFrame'><i class='fa fa-eye'></i> Preview</button>
                           		          		<button type="button" class="btn btn-primary" style="cursor: pointer;" 
                           		          		id="idGuardar" name="idGuardar"><i class='fa fa-floppy-o'></i> Guardar</button>
                           		          		<button type="button" class="btn btn-success" style="cursor: pointer;" 
                           		          		id="idFinalizar" name="idFinalizar"><i class='fa fa-check'></i> Finalizar</button>
                            	</div>	
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
 <!-- Modal -->
<div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body�</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

    <!-- Modal -->
<div class="modal fade" id="myModalFrame">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #428BCA; color:#FFF;  border-top-left-radius: 5px; border-top-right-radius: 5px; ">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
        <h4 class="modal-title">Vista del Producto</h4>
      </div>
      <div class="modal-body">
        <iframe src="" frameborder="0" id="targetiframe" style=" height:500px; width:100%;" name="targetframe" allowtransparency="true"></iframe> <!-- target iframe -->
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
	<script src="<?=$contexto?>/css/bootstrap3-dialog/js/bootstrap-dialog.js"></script>
	<script type="text/javascript">

	$( document ).ready(function() {

		toastr.options = {
				"debug" : false,
				"positionClass" : "toast-top-full-width",
				"onclick" : null,
				"fadeIn" : 300,
				"fadeOut" : 1000,
				"timeOut" : 5000,
				"extendedTimeOut" : 1000,
			};



		  BootstrapDialog.show({
	            title: 'Registro de nuevo producto',
	            message: '�Esta seguro que quiere registar un nuevo producto?',
	            buttons: [{
	                label: 'No',
	                cssClass:"btn-danger",
	                action: function(dialog) {
		                parent.location.href="viewBuscar.php";
	                	dialog.close();
	                }
	            }, {
	                label: 'Registrar',
	                cssClass:"btn-success",
	                action: function(dialog) {
	            		//genera documento y estructura de carpetas
	            		creaDocumento();
	            		dialog.close();
	                    
	                }
	            }]
	        });




       
	
			


	});
	//oprimir boton buscar
	$("#idBuscar").click(function(){
		parent.location.href="<?=$contexto?>/mvc/view/producto/viewBuscar.php";
	});

	//oprimir boton preview
	$("#idPreview").click(function(){
		previewProducto();
	});
	
	//oprimir boton guardar
	$("#idGuardar").click(function(){
		$.ajaxSetup ({ cache: false });	
		var params= $("#formProducto").serialize();
		   $.ajax('<?=$contexto?>/mvc/view/producto/controller/ctrlGuardar.php', {
			   	  data:params,
			  	  type: 'POST', 
			  	   beforeSend: function( xhr ) {
		  	       showloading();
			  	  },
			      success: function(data) {
			    	  toastr.success(data);
			    	  //limipiar();
			       	},
			      error: function(jqXHR, textStatus, errorThrown) {
			    	  toastr.error('ERRORS: ' + textStatus);
			      },
			      complete: function() {
			          hideloading();
			      }
			   });
		

	});

	//oprimir boton Finalizar
	$("#idFinalizar").click(function(){


		 BootstrapDialog.show({
	            title: 'Finalizar Producto',
	            message: '��sta seguro que quiere finalizar el producto? <br> �Recuerde que al finalizarlo estar� listo para facturar y no podra editarlo!',
	            buttons: [{
	                label: 'No',
	                cssClass:"btn-danger",
	                action: function(dialog) {
		                  	dialog.close();
	                }
	            }, {
	                label: 'Finalizar',
	                cssClass:"btn-success",
	                action: function(dialog) {

						//guadra el documento con estatus finalizado
	                	$.ajaxSetup ({ cache: false });	
	            		var params= $("#formProducto").serialize()+"&finalizar=1";
	            		   $.ajax('<?=$contexto?>/mvc/view/producto/controller/ctrlGuardar.php', {
	            			   	  data:params,
	            			  	  type: 'POST', 
	            			  	   beforeSend: function( xhr ) {
	            		  	       showloading();
	            			  	  },
	            			      success: function(data) {
	            			    	  toastr.success(data);
	            			    	  parent.location.href="viewBuscar.php";
	            			    	  
	            			       	},
	            			      error: function(jqXHR, textStatus, errorThrown) {
	            			    	  toastr.error('ERRORS: ' + textStatus);
	            			      },
	            			      complete: function() {
	            			          hideloading();
	            			      }
	            			   });
	                	
	                    
	                }
	            }]
	        });

		
	
		

	});

	// Variable to store your files
	var files;

	// Add events
	$('input[type=file]').on('change', 
			function prepareUpload(event){
	  
	  		files = event.target.files;
	  		uploadFiles(event,this.id);
	 
	});


	// Catch the form submit and upload the files
function uploadFiles(event,idInputFile)
	{
	  event.stopPropagation(); // Stop stuff happening
	    event.preventDefault(); // Totally stop stuff happening

	    // START A LOADING SPINNER HERE

	    // Create a formdata object and add the files
	    var data = new FormData();
		data.append('idProducto',$("#idproducto").val());

		//data.append('idProducto',246);
	    $.each(files, function(key, value)
	    {
	        data.append(key, value);
	    });

		if(idInputFile == 'fileImagen'){	
			data.append('idTipoImg',1);
		}else{
			data.append('idTipoImg',2);
		}
	    
	    $.ajaxSetup ({ cache: false });	
	    $.ajax({
	        url: '<?=$contexto?>/mvc/view/producto/controller/ctrlUpload.php?files',
	        type: 'POST',
	        data: data,
	        cache: false,
	        dataType: 'json',
	        processData: false, // Don't process the files
	        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
		  	 beforeSend: function( xhr ) {
		  	     //  showloading();
			  	  },
	        success: function(data, textStatus, jqXHR)
	        {
							        
	            if( typeof data.error === 'undefined')
	            {
	                // Success so call function to process the form
	               toastr.success("Exito al subir archivo!");
	               reloadTable();
	            	 
	            }else{
	            
	            	toastr.error('Error al subir el archivo!');
	            }
	            
	        },
	        error: function(jqXHR, textStatus, errorThrown)
	        {
	            // Handle errors here
	            toastr.error('ERRORS: ' + textStatus);
	            // STOP LOADING SPINNER
	        },
		      complete: function() {
		         // hideloading();
		          
		      }
	    });
	}

	

	
function creaDocumento() {
		$.ajaxSetup ({ cache: false });
		//iniciar el registro
		$.ajax('<?=$contexto?>/mvc/view/producto/controller/ctrlCrear.php', {
		  	  type: 'POST', 
		  	   beforeSend: function( xhr ) {
	  	       showloading();
		  	  },
		      success: function(data) {

		    	  if(data != '0' ){
			      		$("#idproducto").val(data);
			      		$("#idproductotmp").val(data);
			      		 crearTablaArchivos(data);
			      }else{
			    	  toastr.error('ERROR al generar doc!');
				     }
		    	  
		       	},
		      error: function(jqXHR, textStatus, errorThrown) {
		    	  toastr.error('ERRORS: ' + textStatus);
		      },
		      complete: function() {
		          hideloading();
		      }
		   });

	}




function reloadTable(){
	showloading();
	$("#example").DataTable().ajax.reload();
	hideloading();
}

function crearTablaArchivos(idproducto){


	$('#example').dataTable({
		"processing": true,
        "serverSide": false,
		"ajax": "controller/ctrlTableFiles.php?idProducto="+idproducto,
		"info" : false,
		"bAutoWidth": false,
		"bFilter" : false,	
		"bLengthChange": false,
		"paging" : true,
		"iDisplayLength": 4,
		"oLanguage" : {
			"oPaginate" : {
				"sPrevious" : "<i class='fa fa-arrow-left'></i>",
				"sNext" : "<i class='fa fa-arrow-right'></i>"
			},
			"sLoadingRecords" : "Cargando datos...",
			"sSearch" : "Buscar",
			"sProcessing": "Procesando..." ,
			"sEmptyTable" : "No existen registros para mostrar"
		},		    		
		"aaSorting" : [[1, 'desc']],					
		"columns": [
		    {
				
                "visible": true,
                "searchable": false			                
           	},
		    {
           		"width": "5%",
                "visible": true,
                "searchable": false			                
           	},
		    {
           		"width": "5%",
                "visible": true,
                "className": 'dt-body-center',
                "searchable": false			                
           	},		   
           	 {
           		"width": "5%",
                "visible": true,
                "className": 'dt-body-center',
                "searchable": false			                
           	}
           	
       	]		           			       			        
    });

}

function eliminarFile(idimg){

var params="idimg="+idimg;
$.ajaxSetup ({ cache: false });
//iniciar el registro
$.ajax('<?=$contexto?>/mvc/view/producto/controller/ctrlBorrarFile.php', {
  	  type: 'POST', 
  	  data:params,
  	   beforeSend: function( xhr ) {
	       showloading();
  	  },
      success: function(data) {

    	  if(data != '0' ){
    		  toastr.success("Exito al borrar archivo!");
    		  
	      }else{
	    	  toastr.error('ERROR al borrar archivo!');
		     }
    	  
       	},
      error: function(jqXHR, textStatus, errorThrown) {
    	  toastr.error('ERRORS: ' + textStatus);
      },
      complete: function() {
          hideloading();
          reloadTable();
      }
   });
	
}


function previewProducto(){
    var src = "viewProducto.php?idproducto="+$("#idproducto").val();
    var height = $(this).attr('data-height') || 250;
    var width = $(this).attr('data-width') || 400;
    
    $("#targetiframe").attr({'src':src,
                        'height': height,
                        'width': width});
	
}



	</script>

</body>

</html>
