<?PHP

/** @author:  Indranil
	@Dont change anything inside this file.  
	@Following function loads needed controller.  This function is defined in class/LoadController. This is a checkpoint or we can say router. 
	function loadClass($path){
	$arrClassPath = explode("/", $path);
	$extension = ".do";
	for($i = 0; $i < count($arrClassPath); $i++){
		if(strpos($arrClassPath[$i], $extension)){
			$funcCount = $i;
		}
	}
	for($j = 0; $j <= $funcCount; $j++){
		$arrClass[$j] = $arrClassPath[$j];
	}
	$className = implode("/", $arrClass);
	$funcArg = str_replace($className, "", $_REQUEST["path"]);
	@$funcArg = str_replace("/".$arrClassPath[$funcCount + 1]."/", "", $funcArg);
	$className = str_replace($extension, ".class.php", $className);
	$_SERVER["mainPage"] = $className;
	@$_SERVER["functionName"] = $arrClassPath[$funcCount + 1];
	$_SERVER["functionArg"] = $funcArg;
	include_once($className);
	}
*/
	include_once("../class/loadcontroller.class.php");
	$LoadController = LoadController::getInstance();
	$LoadController->controllerLoad($_REQUEST["path"]);














?> 
