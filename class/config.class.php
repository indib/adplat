<?PHP
	/**
	/* @description:  This class contains all basic variable and function and value which are used globally.
	/* @author: indranil
	/* @created: 10may2012
	/* @updated: 11may2012
	*/


	class Config{
		
		/**@ All following variables are used for database activity*/
		protected $dbHost = "localhost";
		protected $dbName = "adplat";
		protected $dbUserName = "root";
		protected $dbPassWord = "";
		/**###############################################*/
		
		/**@ All following variables are used for log activity*/
		private $logFile = "../log/";
		private $handle;
		private $receiver;
		private $webmaster;
		/**###############################################*/
		
		/**@All variables declared for memcache server */
		public $memPort = "11211";
		public $memStr	= "query";
		public $expireMem = 3600;
		/**@ All following variables are used for log activity*/
		protected $hostServer;
	
		/**###############################################*/
		
		public $subjectRegmail = "Hi";
		public $textRegMail = "Hi";
		public $htmlRegMail = "Hello<br>Can help u.";
		public $attachedFile = "../looknfeel/image/mail/xpertmailer.gif";
		
		/**###############################################*/
		
		function __construct(){
			$this->hostServer = $_SERVER['DOCUMENT_ROOT']; 
			$this->server = "http://localhost";
		}
		
		/**
		/* @description:  This functions resposible for logging all sort of errors/ warning to a text file datewise. Also sends mail to webmaster on error/ warning. 
		/* @author: indranil
		/* @created: 10may2012
		/* @updated: 11may2012
		*/
		public function logIt($content = null, $mail = null){
			$this->logFile = $this->logFile."log_".date('Y-m-d').".txt";
			$content = date('m/d/Y h:i:s a', time()).": ".$content." \n";
		
		try{
			// Let's make sure the file exists and is writable first.
			if (is_writable($this->logFile)) {

				// In our example we're opening $logFile in append mode.
				// The file pointer is at the bottom of the file hence
				// that's where $somecontent will go when we fwrite() it.
				if (!$this->handle = fopen($this->logFile, 'w+')) {
					 throw new exception("Cannot open file ($logFile)");
					 exit;
				}

				// Write $somecontent to our opened file.
				if (fwrite($this->handle, $content) === FALSE) {
					throw new exception("Cannot write to file ($logFile)");
					exit;
				}

			//	echo "Success, wrote ($content) to file ($this->logFile)";

				fclose($this->handle);

			} else {
				throw new exception("The file $this->logFile is not writable");
			}
			if($mail == 1){
				@error_log("Error: $content",1, $this->receiver,"From: $this->webmaster");
			}
		}catch(exception $e){
			//echo $e->getMessage();
		}
		}
	}


?>