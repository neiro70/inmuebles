<?php
 
	$context= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	$var =explode("/",$context);
	if (strpos($context, "localhost") !== false) {
		$context="http://" .$var[0]."/".$var[1];
	}else{
		$context="http://" .$var[0];
	}
?>

<html>
	<head>
		<script language="Javascript" type="text/javascript">
			window.location.href="<?php echo $context ?>/site";     
		</script>
	</head>
</html>

