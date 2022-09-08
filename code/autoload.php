<?php
function carregar_classes($classe) {
	if(file_exists("classes/".$classe.".class.php")){
		include("classes/".$classe.".class.php");
	}
}
spl_autoload_register("carregar_classes"); 

?>