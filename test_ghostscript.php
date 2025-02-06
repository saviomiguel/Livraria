<?php  
// Executando o Ghostscript para verificar se funciona através do PHP  
exec('"C:\\Program Files\\gs\\gs10.04.0\\bin\\gswin64c.exe" --version', $output, $return_var);  
var_dump($output, $return_var);  
?>