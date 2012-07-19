<?PHP
	/**
	/* @description:  This is a model class.
	/* @author: indranil
	/* @created: 10may2012
	/* @updated: 23may2012
	*/
	
	include_once("../class/fileinclude.class.php");		/**Include all required class*/
	
	if(class_exists('WelcomeModel') != true)		/**Check point if class is already declared*/
	{
		class WelcomeModel extends BaseModel{

		public function storeDetails(){
				$objModel = $this->dbConnect();
				}
		}
	}

	





?>