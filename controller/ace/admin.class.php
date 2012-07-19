<?PHP
	/**
	/* @description:  This class contains all basic functions of controller.
	/* @author: indranil
	/* @created: 10may2012
	/* @updated: 23may2012
	*/
	include_once("../class/fileinclude.class.php");		/**Include all required class*/
			
	if(class_exists('Admin') != true)		/**Check point if class is already declared*/
	{
		class Admin extends BaseController{
		
			public function index(){
				$this->loadView("../view/error/header.php");
				$this->loadView("../view/error/errorForbidden.php");
				$this->loadView("../view/error/footer.php");			
			}
			
			/**Check whether activation link is valid*/
			public function check($emailId){
				$emailId = $emailId[0];
				
				$obj = $this->loadModel("ace/adminModel.class.php"); /**Instantiation object of class, just pass */
				
				if(($emailId != "")&&($obj->checkAdminUrl($emailId) == 1)){//Vaild backoffice URL
					$this->loadView("../view/ace/header.php");
					$this->loadView("../view/ace/main.php");
					$this->loadView("../view/ace/footer.php");
					$sess = &Session::start();
					$sess->initialize();
					// Setting a var with it's value.. 
					$sess->set('usernameURL', $emailId);//Creating session to check whether emailid is authentic to use the url or not.
				}else{//Invalid backoffice URL
					$this->loadView("../view/error/header.php");
					$this->loadView("../view/error/invalidBackoffice.php");
					$this->loadView("../view/error/footer.php");
				}
			}
			
			/**Login functionality*/
			public function login(){
					$obj = $this->loadModel("ace/adminModel.class.php"); /**Instantiation object of class, just pass */
					$sess = &Session::start();
					//If not logged in and username & password is null
					if(($sess->get('username') == "Guest")&&($_REQUEST["username"] == '')&&($_REQUEST["password"] == '')){
					$this->loadView("../view/error/header.php");
					$this->loadView("../view/error/errorForbidden.php");
					$this->loadView("../view/error/footer.php");
					die();
					}
					
					//If user tries to refresh the page
					if(($sess->get('username') != "")&&($_REQUEST["username"] == '')&&($_REQUEST["password"] == '')){
					$this->loadView("../view/error/header.php");
					$this->loadView("../view/error/dontrefresh.php");
					$this->loadView("../view/error/footer.php");
					}
					
					//If logged in and username & password is not null
					if(($sess->get('username') != "")&&($_REQUEST["username"] != '')&&($_REQUEST["password"] != '')){
					
					if($obj->checkUrlLogin($_REQUEST["username"], $sess->get('usernameURL')) == 0){
						$this->loadView("../view/ace/header.php");
						$this->loadView("../view/ace/mainWrongCredential.php");
						$this->loadView("../view/ace/footer.php");
						die();
					}
					$login = $obj->checkLoginCredential($_REQUEST["username"], $_REQUEST["password"]);
					if($login == 0){//If login fails or null username or password.
						$this->loadView("../view/ace/header.php");
						$this->loadView("../view/ace/mainWrongCredential.php");
						$this->loadView("../view/ace/footer.php");
					}else{//If successfully loged in
						// check if we done that
						if ($sess->initialised == FALSE)
						$sess->initialize();
						// Setting a var with it's value.. 
						if($_REQUEST["username"] != ''){
							$sess->set('username', $_REQUEST["username"]);
						}else{
							$sess->set('username', $_SESSION["username"]);
						}
						$this->loadView("../view/ace/registration/header.php");
						$this->loadView("../view/ace/registration/main.php");
						$this->loadView("../view/ace/registration/footer.php");
					}
				}
			}
			
			public function logout(){
				$obj = $this->loadModel("ace/adminModel.class.php"); /**Instantiation object of class, just pass */
				$sess = &Session::start();
				$sess->drop();    //destroy session
				$this->loadView("../view/ace/header.php");
				$this->loadView("../view/ace/main.php");
				$this->loadView("../view/ace/footer.php");
			}
			
			/**password change function*/
			public function changePassword(){
				$sess = &Session::start();
				$this->loadView("../view/ace/header.php");
				$this->loadView("../view/ace/changepassword.php");
				$this->loadView("../view/ace/footer.php");
			}
			
			/**Display product display function*/
			public function productDetails(){
				$sess = &Session::start();
				if($sess->get('username') == "Guest"){
					$this->loadView("../view/error/header.php");
					$this->loadView("../view/error/errorForbidden.php");
					$this->loadView("../view/error/footer.php");
					die();
				}else{
					$this->loadView("../view/ace/registration/product/header.php");
					$this->loadView("../view/ace/registration/product/main.php");
					$this->loadView("../view/ace/registration/product/footer.php");
				}
			}
			
			public function productInsert(){
				$obj = $this->loadModel("ace/adminModel.class.php");
				$sess = &Session::start();
				if($sess->get('username') == "Guest"){//Incase session expired
					$this->loadView("../view/error/header.php");
					$this->loadView("../view/error/errorForbidden.php");
					$this->loadView("../view/error/footer.php");
					die();
				}else{
					$result = $obj->getShopName($sess->get('username'));
					$shop_id = $result['0']['shop_id'];
					$_REQUEST["shop_id"] = $shop_id;
					$_REQUEST["template_id"] = '1';
					//$succInsertion = $obj->insertProductDetails($_REQUEST);
					$succInsertion = 1;
					if($succInsertion == 0){
						$GLOBALS["wrong"] = "(Something went wrong, please, submit again.) ";
						$this->loadView("../view/ace/registration/product/header.php");
						$this->loadView("../view/ace/registration/product/main.php");
						$this->loadView("../view/ace/registration/product/footer.php");
					}else{
						$this->loadView("../view/ace/registration/product-photo-tag/header.php");
						$this->loadView("../view/ace/registration/product-photo-tag/main.php");
						$this->loadView("../view/ace/registration/product-photo-tag/footer.php");
					}
				}
			}
		}
	}

	





?>