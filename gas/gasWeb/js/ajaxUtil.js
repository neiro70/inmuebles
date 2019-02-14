/* ************************************************
* Utileria Ajax
* Autor: Ing. Jorge Luis Martinez
* E-mail: neiro70@gmail.com
* Esta pequeña libreria depende de el framework JQuery
*/

/**
* Funcion que realiza una peticion mediante post a determinada url y actualiza con la respuesta una division
* Contiene las siguientes opciones
* @param {String}   url La URL donde realiza la peticion
* @param {Object}   optionsRequest Un objeto con las siguientes caracteristicas {parameters: '', container: '', loader: '', postFunction: function(){}}
* parameters:       Una serie de parametros definidos con el formato JSON {param1:valor1,param2:valor2} (por default una cadena vacia)
* container:       Identificador de una division en la cual se reflejara la respuesta a la peticion (por default 'container')
* loader:          El nombre de un identificador de una division que logra el efecto de cargando (por default no aparecera)
 * postFunction:  	Referencia a una funcion que se ejecutara despues de  haber recibido respuesta y haber actualizado el contenido
*/
function doAjaxRequest(strURL, optionsRequest,parameters){
    
	if(strURL){

		var component ='#'+ __$AnalizaValor(optionsRequest, "component");
		var postFunction = __$AnalizaValor(optionsRequest, "postFunction");
		var errorFunction = __$AnalizaValor(optionsRequest, "errorFunction");
		var loader=__$AnalizaValor(optionsRequest, "loader","clock-loader");
     	  	__$PrepareAndShowLoading(loader);
    	  	$.ajax({  
    	  			url:strURL,
    	  			cache:false,
    	  			data:parameters,
    	  			success:function(respuesta){
    								  			$(component).html(respuesta);
    								  			
    						                    if(postFunction){
    						                        try{
    						                            postFunction();
    						                        }catch(error){
    						                        	alert(error);
    						                    	}
    						                	}

    								  			},
    				error:function(){
    								alert("No hubo respuesta del servidor");
				                    if(errorFunction){
				                        try{
				                        	errorFunction();
				                        }catch(error){
				                        	alert(error);
				                    	}
				                	}
    				},
    				complete:function(){
    						__$TerminateLoading();
    				}
    	  	
    	  	});
        }
	
}

function doAjaxRequestFields(strURL, optionsRequest,parameters){
    
	if(strURL){

		var component ='#'+ __$AnalizaValor(optionsRequest, "component");
		//var postFunction = __$AnalizaValor(optionsRequest, "postFunction");
		var loader=__$AnalizaValor(optionsRequest, "loader","clock-loader");
     	  	__$PrepareAndShowLoading(loader);
    	  	$.ajax({  
    	  			url:strURL,
    	  			cache:false,
    	  			data:parameters,
    	  			dataType: 'application/json; charset=utf-8',
    	  			success:function(respuesta){
    	  				alert(respuesta);
//    	  				document.getElementById("region").value=respuesta.region;
//            			document.getElementById("nomSitio").value=respuesta.nombre;
//            			document.getElementById("faseProy").value=respuesta.fase;
//            			document.getElementById("tech").value=respuesta.tecnologia;
//            			document.getElementById("ciudad").value=respuesta.ciudad;
//            			document.getElementById("pep").value=respuesta.elementoPep;
//            			document.getElementById("ot").value="";

    								  			},
    				error:function(){
    								alert("No hubo respuesta del servidor");
    								
    				},
    				complete:function(){
    						__$TerminateLoading();
    				}
    	  	
    	  	});
        }
	
}

/*
* Funcion que realiza una peticion mediante post a determinada url y actualiza un componente <select> con datos de una lista en formato JSON con formato  .Value  .Text
 los cuales fueron resultado del servidor.
* Contiene las siguientes opciones
* @param {String}   (-)url La URL donde realiza la peticion.
* @param {Object}   optionsRequest Un objeto con las siguientes caracteristicas {parameters:{}, container: '', loader: '', component='',classComponent='',postFunction: function(){}}
 					(-)component:        Identificador del componente en la cual se reflejara la respuesta a la peticion.
					(-)container:        Contenedor del component al cual se actualizara el contenido html.
					(+)classComponent:   Estilo del componente por default 'chzn-select' solo modificar si el estilo cambia.
					(+)tipoJson:	     Tipo de json que devueleve el server por default 'ComboCascadeJson'.
					(+)(-)label:         Texto descriptivo o carateristica de la funcionalidad del combo.
				    (+)loader:           El nombre de un identificador de una division que logra el efecto de cargando.
					(+)postFunction:  	 Referencia a una funcion que se ejecutara despues de  haber recibido respuesta y haber actualizado el contenido. 
* @param 			(-){parameters}      Una serie de parametros definidos con el formato JSON {param1:valor1,param2:valor2}.
* 					(+)isChosen          crea el combo sin estilo de chosen por default false.
					(+)isDiseable        Pone inabilitado el combo por default false.
					(+)isTodos			 Pone el texto TODOS a los combos con el parametro true

NOTA: 
(+) Datos parametrizables.
(-) Datos obligatorios.
*/
function doAjaxRequestCombo(strURL, optionsRequest,parameters){
    
	if(strURL){

		var container = "#"+__$AnalizaValor(optionsRequest, "container", "container");
		var component = "#"+ __$AnalizaValor(optionsRequest, "component","component");
		var classComponent="."+ __$AnalizaValor(optionsRequest, "classComponent","chzn-select");
		var postFunction = __$AnalizaValor(optionsRequest, "postFunction");
		var label = __$AnalizaValor(optionsRequest, "label","Label no definido");
		var loader=__$AnalizaValor(optionsRequest, "loader","clock-loader");
		var tipoJson=__$AnalizaValor(optionsRequest,"tipoJson", "ComboCascadeJson");
		var isChosen=__$AnalizaValor(optionsRequest,"isChosen", "true");
		var isDiseable=__$AnalizaValor(optionsRequest,"isDiseable", "true");
		var istodos=__$AnalizaValor(optionsRequest,"isTodos", "false");
		var isDefaultEnable=__$AnalizaValor(optionsRequest,"isDefaultEnable", "false");
		
		
     	  	__$PrepareAndShowLoading(loader);
     	  		$.ajaxSetup({ scriptCharset: "ISO-8859-1" , contentType: "application/json; charset=ISO-8859-1"});
									     	  	$.getJSON(strURL,parameters, 
											     	  	function(json) {
									     	  							
									     	  							try{
											     	  							if(component == "#component"){
											     	  								throw "Falta definir (component)";
											     	  							}
											     	  							if(container == "#container"){
											     	  								throw "Falta definir (container)";
											     	  							}
											     	  							
													     	  					var id=$(component).attr("id");	
													     	  					var html="";
													     	  					var bTipoJson=false;
													     	  					
													     	  					if(isChosen == 'true'){
														     	  					html+="<script type='text/javascript'>";
														     	  					html+="$('"+classComponent+"').chosen();";
														     	  					html+="</script>";
													     	  					}
													     	  					
													     	  					html+="<div id='div"+id +"' >";											     	  					
													     	  					html+="<label>"+label+":</label>";		
													     	  				 
													     	  					if(isChosen != 'true'){
													     	  						html+="<select id="+id+" name="+id+" style=width:300px;";
													     	  						if(isDiseable != 'true'){
													     	  							html+=" disabled='disabled' ";
													     	  						}
													     	  						
													     	  						html+=">";
													     	  						
													     	  					}else{
													     	  						html+="<select id="+id+" name="+id+" style=width:300px; class='"+classComponent.substring(1)+"'>";
													     	  					}
													     	  					
													     	  					var items=0;
													     	  					$.each(json, function(i,obj){   ///TIPOS de json
													     	  						items++;
															     	  				    	if(tipoJson=="ComboCascadeJson"){
															     	  				    		html+="<option value='"+obj.value+"'>"+obj.text+"</option>";													     	  				    		
															     	  				    	}else if(tipoJson=="ConfigPrenomJson"){
															     	  				    		html+="<option value='"+obj.idConfPrenomina+"'>"+obj.nbPrenomina+"</option>";
															     	  				    	}else if(tipoJson=="NominaJson"){
															     	  				    		html+="<option value='"+obj.idNomina+"'>"+obj.nbNomina+"</option>";
															     	  				    	}else if(tipoJson=="JSONObject"){
															     	  				    		html+="<option value='"+obj.id+"'>"+obj.nombre+"</option>";
															     	  				    	}else{
															     	  				    		throw "No existe tipo json("+tipoJson+")"; 
															     	  				    	}							     	  				    	
															     	  				    		
																		     	        	
																		     	        });
													     	  					
													     	  					/*
														     	  					if(istodos=='false')
														     	  						{
															     	  						if(!isDefaultEnable) {
															     	  							html+="<option value='-1'>----</option>";
															     	  						}
														     	  						}else
														     	  							{
														     	  							html+="<option value='0'>TODOS</option>";
														     	  							}*/
													     	  					
														     	  				if(items == 0){														     	  					
														     	  					html+="<option value='-1' selected='selected'>----</option>";
														     	  				}
													     	  					
														     	  					
															     	  			html+="</select>";																     	  			
															     	  		//	html+="<form:errors path=" + id + "/>";
															     	  			html+="</div>";	
															     	  			
															     	  			//alert(items);
		//													     	  				    
															     	  		   $(container).html(html);	
													     	  		   
									     	  							}catch(Excepcion){
							     	  									alert(Excepcion);
							     	  							    }

											     	  	})
											     	  	.success(function() {
														     	  		if(postFunction){
								    						                        try{
								    						                            postFunction();
								    						                        }catch(error){
								    						                        	alert(error);
								    						                    	}
								    						                	}
											     	  		
											     	  	})
											     	  	.error(function(xhr, ajaxOptions, thrownError) {  alert(xhr.status);
											            alert(thrownError);
											            alert(ajaxOptions);
											     	  	})
											     	  	.complete(function() { 
											     	  							__$TerminateLoading(); 
											     	  	}); 
									     	  			

    								  			

        }
     	  	
     	  	
   	  	

 }
/*
* Funcion que realiza una peticion mediante post a determinada url y actualiza un componente <select> con datos de una lista en formato JSON con formato  .Value  .Text
 los cuales fueron resultado del servidor.
* Contiene las siguientes opciones
* @param {String}   (+)url La URL donde realiza la peticion.
* @param {Object}   optionsRequest Un objeto con las siguientes caracteristicas {parameters:{}, container: '', loader: '', component='',classComponent='',postFunction: function(){}}
					(+)container:        Contenedor del component al cual se actualizara el contenido html.
					(+)label:            Texto descriptivo o carateristica de la funcionalidad del combo.
				    loader:           El nombre de un identificador de una division que logra el efecto de cargando.
					(+)postFunction:  	 Referencia a una funcion que se ejecutara despues de  haber recibido respuesta y haber actualizado el contenido. 
* @param {parameters}   Una serie de parametros definidos con el formato JSON {param1:valor1,param2:valor2} (por default una cadena vacia).

NOTA: (+) Datos parametrizables.
*/	
function doAjaxRequestPost(strURL, optionsRequest,parameters){
    
	if(strURL){

		var container ='#'+ __$AnalizaValor(optionsRequest, "container");
		var postFunction = __$AnalizaValor(optionsRequest, "postFunction");
		var loader=__$AnalizaValor(optionsRequest, "loader","clock-loader");
		var postFunction = __$AnalizaValor(optionsRequest, "postFunction");
		var callback = __$AnalizaValor(optionsRequest, "callback","true");
		
	if(callback!="false"){
				__$PrepareAndShowLoading(loader);
				}
    	  	$.ajax({  
    	  			url:strURL,
    	  			cache:false,
    	  			data:parameters,
    	  			success:function(respuesta){

    	  										$(container).html(respuesta);
    						                    if(postFunction){
    						                        try{
    						                            postFunction();
    						                        }catch(error){
    						                        	alert(error);
    						                    	}
    						                	}
    								  			
    								  			},
    				error:function(){
    								alert("No hubo respuesta del servidor");
    								
    				},
    				complete:function(){
    					if(callback!="false"){
    						__$TerminateLoading();
    						}
    						
    						
    				}
    	  	
    	  	});
        }
	
}	

/**
* Funcion interna que se encarga de entregar un parametro opcional
* o un valor por defecto desde una coleccion tipo JSON
*/
function __$AnalizaValor(coleccion, parametro, defecto) {
    if (coleccion==undefined || parametro==undefined) {
        return defecto;
    }
    else{
        var valor = coleccion[parametro];
        if(valor==undefined){
            return defecto;
        }
        return valor;
    }
}


/**
* Funcion que establece los valores necesarios en las divisiones mask y loader 
* para mostrar un efecto de cargando y ponerlo como si fuera una ventana modal
*/
function __$PrepareAndShowLoading(loader){
    
	$.blockUI({ 
    	message: $('#'+loader),
    	css: { 
    		border: 'none',
    		opacity: .5,
    		 padding: '15px',
             backgroundColor: '#000', 
             '-webkit-border-radius': '10px', 
             '-moz-border-radius': '10px', 
           // top:  ($(window).height() - 200) /2 + 'px', 
            left: ($(window).width() - 180) /2 + 'px' ,
            width: '150px',	
            height:'150px'
    } }); 
}

/*
* Funcion que oculta las divisiones que realizan el efecto de cargando.
*/
function __$TerminateLoading(){
	 $.unblockUI();
}

function showloading(){
	__$PrepareAndShowLoading('clock-loader');       

}

function hideloading(){
	__$TerminateLoading();     

}

function showAyuda(msg){
	 $.blockUI({ 
         message: msg, 
         fadeIn: 700, 
         fadeOut: 700, 
         timeout: 8000, 
         showOverlay: false, 
         centerY: false, 
         css: { 
             width: '350px',
             top: '10px', 
             left: '', 
             right: '10px', 
             border: 'none', 
             padding: '5px', 
             backgroundColor: '#000', 
             '-webkit-border-radius': '10px', 
             '-moz-border-radius': '10px', 
             opacity: .6, 
             color: '#fff' 
         } 
     }); 
	
}


