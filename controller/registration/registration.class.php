<?PHP
	/**
	/* @description:  This class contains all basic functions of controller.
	/* @author: indranil
	/* @created: 10may2012
	/* @updated: 23may2012
	*/
	include_once("../class/fileinclude.class.php");		/**Include all required class*/
			
	if(class_exists('Registration') != true)		/**Check point if class is already declared*/
	{
		class Registration extends BaseController{
		
			/**load the registration form and validate the form*/
			public function index(){
				//$obj = $this->loadModel("welcomeModel.class.php"); /**Instantiation object of class, just pass */
				//$obj->storeDetails();
				$this->loadView("../view/registration/header.php");
				$this->loadView("../view/registration/main.php");
				$this->loadView("../view/registration/footer.php");
			}
			
			/**Check the registration form and confirm if everything is okay otherwise go back*/
			public function formSubmit(){
				if(count($_REQUEST) <= 1){ //If user wants to access this page directly without fill in the regsitration form
					$this->loadView("../view/registration/headerConfirm.php");
					$this->loadView("../view/error/errorForbidden.php");
					$this->loadView("../view/registration/footer.php");
				}else{
					$obj = $this->loadModel("registration/registrationModel.class.php"); /**Instantiation object of class, just pass */
				$regError = $obj->insertRegistrationData($_REQUEST);
				if($regError == 1){//If setup process is okay
					$this->loadView("../view/registration/headerConfirm.php");
					$this->loadView("../view/registration/mainConfirm.php");
					$this->loadView("../view/registration/footer.php");
				}elseif($regError == 2){//If store already exist
					$this->loadView("../view/registration/headerConfirm.php");
					$this->loadView("../view/registration/mainStoreAlreadyExist.php");
					$this->loadView("../view/registration/footer.php");
				}else{//If something wrong during setup process
					$this->loadView("../view/registration/headerConfirm.php");
					$this->loadView("../view/registration/mainNotConfirm.php");
					$this->loadView("../view/registration/footer.php");
				}
				}
			}
		}
	}
?>