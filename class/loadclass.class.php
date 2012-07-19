<?PHP
	/**
	/* @description: This class generates object automatically for controller class as well as function name to call.
	/* @author: indranil
	/* @created: 10may2012
	/* @updated: 15may2012
	*/
	//include("config.class.php");

	class LoadController {
	
		private static $instance;
		
		/**Generate instace of the class based on singleton pattern*/		
		public static function getInstance()
		{
			if (!isset(self::$instance))
			{
				self::$instance = new LoadClass();
			}
			
			return self::$instance;
		}
		
	
			public function loadController($path){
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
	}
?>