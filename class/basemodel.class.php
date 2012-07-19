<?PHP
	/**
	/* @description:  This class contains all basic functions of controller.
	/* @author: indranil
	/* @created: 10may2012
	/* @updated: 11may2012
	*/
	include("db.class.php");

	class BaseModel extends Db{
		
		public function dbConnect(){
			$db = Db::getInstance();  //Step1: Create a singleton object
			$db->mysqlConnect(); //Establish connection.
			return $db;
		}
		
		public function sendMail($from, $fromName, $to, $toName, $subject, $text, $html, $attachedFile){
			
			require_once '/xpmmail/MAIL.php';
		
			// get ID value (random) for the embed image
			$id = MIME::unique();

			// initialize MAIL class
			$m = new MAIL;
			
			// set from address and name
			$m->From($from, $fromName);
			// add to address and name
			$m->AddTo($to, $toName);
			// set subject
			$m->Subject('$subject');
			// set text/plain version of message
			$m->Text('$text');
			// set text/html version of message
			$m->Html('$html');
			// add attachment ('text/plain' file)
			$m->Attach('source file', 'text/plain');
			$f = $attachedFile;
			// add inline attachment '$f' file with ID '$id'
			$m->Attach(file_get_contents($f), FUNC::mime_type($f), null, null, null, 'inline', $id);

			// send mail
			//echo $m->Send('localhost') ? 'Mail sent !' : 'Error !';
			if(/**$m->Send('localhost')*/$m){
				return 1;
			}else{
				return 0;
			}

			// optional for debugging ----------------
			/**echo '<br /><pre>';
			// print History
			print_r($m->History);
			// calculate time
			list($tm1, $ar1) = each($m->History[0]);
			list($tm2, $ar2) = each($m->History[count($m->History)-1]);
			echo 'The process took: '.(floatval($tm2)-floatval($tm1)).' seconds.</pre>';*/
		
		}
		
		/**Password generation during set up process of store*/
		public function generatePassword($pass){
			return strtolower(substr(crypt($pass),0,4));
		}
			
		/**Check and instantiate session*/
	/**	public function setSession($name, $value){
			session_start();
			$_SESSION[$name] = $value;
			var_dump($_SESSION);
		}*/
		
		/**Check weather session exist*/
		/**	public function sessionCheck($name){
			if(session_is_registered($name)) {
				return 1; //session exist.
			}else{
				return 0;//session does not exist.
			}
		}*/
		
		/**destroy if session exist*/
		/**	public function sessionDestroy(){
			 unset($_SESSION['username']);
			 session_destroy('username');
			 session_commit();
			 echo "session destroyed";
		}*/
		
		/**start session*/
		/**	public function sessionStart(){
			session_start();
		}*/
	}

?>