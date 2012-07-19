<?php
/**This funciton */
	function __autoload($class_name) {
		$stringClassPath = $_SERVER['DOCUMENT_ROOT']."/controller/".strtolower($class_name) . ".class.php";
		include $stringClassPath;
	}
?>