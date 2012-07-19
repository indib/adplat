<?PHP
	/**
	/* @description:  This is a model class.
	/* @author: indranil
	/* @created: 10may2012
	/* @updated: 23may2012
	*/
	
	include_once("../../class/fileinclude.class.php");		/**Include all required class*/
	
	if(class_exists('AdminModel') != true)		/**Check point if class is already declared*/
	{
		class AdminModel extends BaseModel{
		
		private $password;
		
			public function index(){
					echo "Test is successfull";
			}
			
			/**Checks if its a valid url*/
			public function checkAdminUrl($emailId){
				$objModel = $this->dbConnect();/**Creation of singleton instance*/
				
				$resultSize = $objModel->uniqueResult("shop_master", "shop_emailid = '$emailId'");/**Check already store exist with same emailid*/
				
				if($resultSize == 0){
					return 0; //Invalid registered emaiid
				}else{
					return 1;	//Valid registered emaiid
				}
				
			}
			
			/**Check login credential*/
			public function checkLoginCredential($username, $password){
				$objModel = $this->dbConnect();/**Creation of singleton instance*/
				
				$resultSize = $objModel->uniqueResult("shop_master", "shop_emailid = '$username' and shop_password = '$password'");/**Check already store exist with same emailid*/
				
				if($resultSize == 0){
					return 0; //Invalid registered emaiid
				}else{
					return 1;	//Valid registered emaiid
				}	
			}
			
			/**Check login credential with url*/
			public function checkUrlLogin($username, $urlparm){
							
				if($username != $urlparm){
					return 0; //email not autheticated for url
				}else{
					return 1;	//email autheticated for url
				}	
			}
			
			/**get shop id from emailid*/
			public function getShopName($emailid){
				$objModel = $this->dbConnect();/**Creation of singleton instance*/
				
				$result = $objModel->selectResult("shop_master", array("shop_id"), "shop_emailid = '$emailid'", "", ""); 
				
				return $result;
			}
			
			/**insertion of product details*/
			public function insertProductDetails($prodData){
				$objModel = $this->dbConnect();/**Creation of singleton instance*/
				
				$resultSize = $objModel->uniqueResult("shop_template", "shop_id = '$prodData[shop_id]'");/**Check already store exist with same emailid*/
				
			if($resultSize > 0){
					return 0; /**If already store exist with same emailid*/
				}else{
					$shopTemplateId = $objModel->insertData("shop_template", array("shop_id", "shop_product_1_desc", "shop_product_2_desc", "shop_product_3_desc", "shop_header_desc", "shop_sidebar_desc", "shop_offer_1", "shop_offer_2", "shop_offer_3", "template_id", "shop_template_creation_date"), array("'$prodData[shop_id]'", "'$prodData[productdtls1]'", "'$prodData[productdtls2]'", "'$prodData[productdtls3]'", "'$prodData[productdtls]'", "'$prodData[productattrct]'", "'$prodData[shopoffer1]'", "'$prodData[shopoffer2]'", "'$prodData[shopoffer3]'", "'$prodData[template_id]'", "CURRENT_TIMESTAMP"));
					if($shopTemplateId > 0){//succefully inserted data
						return 1;
					}else{//something went wrong, could not insert value 
						return 0;
					}
				
			}
			
		}
		
		}
	}

	





?>