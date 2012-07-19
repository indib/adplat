<?PHP
	/**
	/* @description:  This class contains all basic functions of controller.
	/* @author: indranil
	/* @created: 10may2012
	/* @updated: 23may2012
	*/
	include_once("../class/fileinclude.class.php");		/**Include all required class*/
			
	if(class_exists('Welcome') != true)		/**Check point if class is already declared*/
	{
		class Welcome extends BaseController{
		
			public function index(){
				$GLOBALS['data'] = array("1"=>"indranil", "2"=>"bhattacharya");
				$obj = $this->loadModel("welcomeModel.class.php"); /**Instantiation object of class, just pass */
				$obj->storeDetails();
				$this->loadView("../view/home/header.php");
				$this->loadView("../view/home/main.php");
				$this->loadView("../view/home/footer.php");
				
			}
			
			/**Assign array to different parameter of the function*/
			function registration($array){
			$this->test();
				echo "This is registration function ".var_dump($array);
				
			}
		}
	}

	





?>