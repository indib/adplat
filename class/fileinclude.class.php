<?PHP
	/**
	/* @description: This class include required file.
	/* @author: indranil
	/* @created: 10may2012
	/* @updated: 11may2012
	*/
	include("config.class.php");

	class FileInclude extends config{
	
		private static $instance;
		public $pageUrl;
		
		/**Constructor loads base controller base model/ config class*/
		function __construct(){
			parent::__construct(); 
			try{
				if(!include_once($this->hostServer."/class/basecontroller.class.php")){
					throw new exception("basecontroller.class.php coundnot be included");
				 }
				 
				if(!include_once($this->hostServer."/class/basemodel.class.php")){
					throw new exception("basemodel.class.php coundnot be included");
				}
				
				if(!include_once($this->hostServer."/class/session.class.php")){
					throw new exception("session.class.php coundnot be included");
				}
				
			}catch(exception $e){
			 $this->logIt($e->getMessage());
			 echo $e->getMessage();
			 }
		}
						
		public static function getInstance()
		{
			if (!isset(self::$instance))
			{
				self::$instance = new FileInclude();
			}
			
			return self::$instance;
		}
		
		/**This function includes all class file required*/
		public function FileInclude() {
			 try{
			 if(!include_once($this->hostServer."/class/autogenerateurlinfo.class.php")){
				throw new exception("autogenerateurlinfo.class.php coundnot be included");
			 }
			 }catch(exception $e){
			 $this->logIt($e->getMessage());
			 echo $e->getMessage();
			 }
		}
	}
	
	$FileInclude = FileInclude::getInstance();
	$FileInclude->FileInclude();



?>