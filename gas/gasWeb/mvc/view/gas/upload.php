<?php

    header("Access-Control-Allow-Origin: *");
    $server =$_SERVER["HTTP_HOST"];
	$contexto = "http://" . $server ."/inmuebles/gas/gasWeb/mvc/view/gas/uploads/";

    error_log("contexto:{$contexto}", 0);
 if($_FILES['file']['name'] != ''){
    $test = explode('.', $_FILES['file']['name']);
    $extension = end($test);    
    $name = rand(100,999).'.'.$extension;
    //$ABS_PATH='/opt/lampp/htdocs/inmuebles/gas/gasWeb/mvc/view/gas/';
    $ABS_PATH='/home1/dratlcom/public_html/inmuebles/gas/gasWeb/mvc/view/gas/uploads/';
    $location = $ABS_PATH.$name;
    move_uploaded_file($_FILES['file']['tmp_name'], $location);
    chmod( $location, 0755);
    
    $imagen=$contexto.$name;

    echo '<img src="'.$imagen.'" height="100" width="100" />';
}

?>