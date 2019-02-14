<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   
   echo 'Saliendo de la session del sistema';
   header('Refresh: 2; URL = index.php');
?>
