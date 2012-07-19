<?PHP
	/**
	/* @description: This class generates object automatically for controller class as well as function name to call.
	/* @author: indranil
	/* @created: 10may2012
	/* @updated: 15may2012
	*/
	//include("config.class.php");

	class AutoGenerateUrlInfo extends Config{
	
		private static $instance;
		private $pageUrl;
		private $pageName;
		private $urlArr;
		private $count;
		private $funcArg;
		private $arrClass;
		
		
		/**Generate instace of the class based on singleton pattern*/		
		public static function getInstance()
		{
			if (!isset(self::$instance))
			{
				self::$instance = new AutoGenerateUrlInfo();
			}
			
			return self::$instance;
		}
		
		/**Return the loaded url*/	
		public function curpageUrl() {
			 $this->pageUrl = 'http';
			 if (@$_SERVER["HTTPS"] == "on") {$this->pageUrl .= "s";}
			 $this->pageUrl .= "://";
			 if (@$_SERVER["SERVER_PORT"] != "80") {
			  $this->pageUrl .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			 } else {
			  $this->pageUrl .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			 }
			 return $this->pageUrl;
		}
		
		/**Return the page name from the loaded url, which is actually the class name of the controller*/	
		public function curPageName() {
			//$this->pageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
			return str_replace(".class.php", "", $_SERVER["mainPage"]);
			
		}
		
		/**Return the function name of the class from the loaded url of controller*/	
		public function controllerFunction() {
			return $_SERVER["functionName"];
		}
		
		/**Return string of arguments of function of the class from the loaded url of controller*/	
		public function controllerFunctionArg() {
			$this->urlArr = explode("/", $_SERVER["functionArg"]);
			return $this->urlArr;
		}
		
	}
	
		$autoUrl = AutoGenerateUrlInfo::getInstance();
		$class = str_replace(".class()", "", $autoUrl->curPageName()); /**Get the class name*/
		$includefile = str_replace("()", "", $autoUrl->curPageName().".class.php"); /**include correspond class file*/
		$functionName = $autoUrl->controllerFunction(); /**Get the function name*/
		$this->funcArg = $autoUrl->controllerFunctionArg(); /**Get the string of arguments*/
		
		require("$includefile"); /**dynamic inclusion of necessary class file*/
		
		$arrClass = explode("/", $class);
		$class = $arrClass[count($arrClass) - 1];  /**To extract the class name from path like test/welcome.class.php*/
		$class = ucfirst($class); // Convert the first character of the class capital.
		
		$obj = new $class(); /**Create instance of the class*/
			
		if(!$functionName){
			$obj->index(); /**if no function name then call default index function*/
		}elseif($functionName){
			$functionName = str_replace("/","",$autoUrl->controllerFunction());
			@$obj->$functionName($this->funcArg); /**if function name then call specified function with parameters*/
		}
?>