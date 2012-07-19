<?PHP
	/**
	/* @description:  This class contains all basic functions of base controller which are inherited by different base controller class.
	/* @author: indranil
	/* @created: 10may2012
	/* @updated: 11may2012
	*/


	class BaseController extends Config{
		
	private $viewPath = "view/";	
	private $cssPath = "css/";
	private $jsPath = "js/";
	private $libPath = "lib/";
	private $classPath = "class/";
	private $modelObj;
	private $objClass;
	
		/**loadView function loads view file*/
		protected function loadView($path){
			include_once($this->hostServer."/".$this->viewPath.$path);
		}
		
		/**loadCss function loads css file*/
		protected function loadCss($path){
			include_once($this->hostServer.$this->cssPath.$path);
		}
		
		/**loadJs function loads js file*/
		protected function loadJs($path){
			include_once($this->hostServer.$this->jsPath.$path);
		}
		
		/**loadView function loads lib file*/
		protected function loadLib($path){
			include_once($this->hostServer.$this->libPath.$path);
		}
		
		/**loadView function loads lib file*/
		protected function loadClass($path, $class){
			include_once($this->hostServer."/".$this->classPath.$path);
			$this->objClass = new $class();
			return $this->objClass;
		}
		
		protected function loadModel($path){
		try{
			$arrPath = explode("/", $path);
			//var_dump($arrPath);
			$count = count(explode("/", $path)) - 1;
			$class = ucfirst(str_replace(".class.php","",$arrPath[$count]));
			
			if(!strpos($class, "Model")){echo "test1";
				throw new exception("Wrong model name, ideal model name should be: ".$class);
			}
			//echo str_replace("../","",$this->hostServer."/model/".strtolower($path));
			include_once(str_replace("../","",$this->hostServer."/model/".strtolower($path)));
			//echo "included";
			$this->modelObj = new $class();
			return $this->modelObj;//include_once($this->hostServer."/model/".$path);
			}catch(Exception $e){
			$this->logIt($e->getMessage());
			echo $e->getMessage();
			}
			
		}
	}


?>