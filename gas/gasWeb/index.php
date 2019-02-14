<?php
	$status = session_status();
	if($status == PHP_SESSION_NONE){
	    //There is no active session
	    session_start();
	    
	}else
	if($status == PHP_SESSION_DISABLED){
	    //Sessions are not available
	}else
	if($status == PHP_SESSION_ACTIVE){
	    //Destroy current and start new one
	    session_destroy();
	    session_start();
	  
	}
	$context= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	$var =explode("/",$context);
	if (strpos($context, "localhost") !== false) {
		$context="http://" .$var[0]."/".$var[1];
	}else{
		$context="http://" .$var[0];
	}

	include("mvc/util/MysqlDAO.php");

?>



<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="ISO-8859-1">
	<meta name="viewport" content="width=1,initial-scale=1,user-scalable=1" />
	  <title>OperaGas Web</title>
	  <link rel="shortcut icon" href="img/logo.png" type="image/png">
      <link href = "css/bootstrap.min.css" rel = "stylesheet">
	  <link rel="stylesheet" type="text/css" href="css/styles.css" />
	  <link href="http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900" rel="stylesheet" type="text/css">

	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

		<section class="container">
			<section class="login-form">
				<?php
		            $msg = '';
			            
			            if (isset($_POST['login']) && !empty($_POST['username']) 
			               && !empty($_POST['password'])) {
			               	
							
			               $db = new MySQL();  //$db = new MySQL ("u801037716_xtc"); 
			               	$sql="SELECT COUNT(idt01usuario) as existe  FROM t01usuario WHERE txtusuario='".$_POST['username']."' AND txtpassword = '".$_POST['password']."' ";
			               	$con=$db->getConexion();
						
			               	$result = $con->query($sql);
							   
			               	if ($result->num_rows > 0) {
								   // output data of each row
								 
			               		while($row = $result->fetch_assoc()) {
									
			               			if($row ['existe'] == 1){	
										
			               				$_SESSION['valid'] = true;
			               				$_SESSION['timeout'] = time();
			               				$_SESSION['username'] = $_POST['username'];
			               				
			               				$sql="SELECT idusuario FROM t01usuario WHERE txtusuario = '{$_POST['username']}'  ";
			               				$conn=$db->getConexion();
			               				$result = $conn->query($sql);
			               				
			               				if ($result->num_rows > 0) {
			               					while($row = $result->fetch_assoc()) {
			               						$_SESSION['idusuario']=$row["idusuario"];
			               					}
			               				}
			               				

			               				
			               				header("location:{$context}/gas/gasWeb/mvc/view/producto/viewBuscar.php");
			               			}else{
			               				$msg = '&iexcl;Datos incorrectos!';
			               			
			               			}
			               		}
			               	} else {
			               		$msg = '&iexcl;Datos incorrectos!';
			               	}
			                      	
				           	$db->closeSession();
			               	
			            }
			         ?>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" role="login">
					<img src="img/logo.png" class="img-responsive" width="35%" />
					<h4 class = "form-signin-heading" style="color:red;"><?php echo $msg; ?></h4>
					<input type="text" name="username" placeholder="Usuario" required class="form-control input-lg" />
					<input type="password" name="password" placeholder="Contrase�a" required class="form-control input-lg" />
					<button type="submit" name="login" class="btn btn-lg btn-primary btn-block">Entrar</button>
<!-- 					<div> -->
<!-- 						<a href="#">Create account</a> or <a href="#">reset password</a> -->
<!-- 					</div> -->
				</form>
<!-- 				<div class="form-links"> -->
<!-- 					<a href="#">www.website.com</a> -->
<!-- 				</div> -->
			</section>
	
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>