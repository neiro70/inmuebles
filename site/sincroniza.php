<?php

$salida = shell_exec('git status');
echo "<pre>$salida</pre>";

$salida = shell_exec('git pull origin master');
echo "<pre>$salida</pre>";
?>
