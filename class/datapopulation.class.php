<?PHP
	/**
	/* @description:  This is a model class.
	/* @author: indranil
	/* @created: 10may2012
	/* @updated: 23may2012
	*/
	
	include_once("../../class/fileinclude.class.php");		/**Include all required class*/
	
	if(class_exists('DataPopulation') != true)		/**Check point if class is already declared*/
	{
		class DataPopulation extends Db{
		
		private $password;
		
			public function insertRegistrationData($regData){
			
				$objModel = $this->dbConnect();/**Creation of singleton instance*/
				
				$resultSize = $objModel->uniqueResult("shop_master", "shop_emailid = '$regData[storeemail]'");/**Check already store exist with same emailid*/
				
				if($resultSize > 0){
					return 2; /**If already store exist with same emailid*/
				}else{
				/**Step1: shopid creation as well as inserting data into shop_master table.*/
				$this->password = $this->generatePassword('$regData[storeemail]');
				$shopId = $objModel->insertData("shop_master", array("shop_name", "shop_address", "shop_road", "shop_city", "shop_pincode", "shop_state", "shop_country", "shop_continent", "shop_landline", "shop_mobile", "shop_emailid", "shop_password", "shop_website", "shop_creation", "shop_category"), array("'$regData[storename]'", "'$regData[storeaddress]'", "'$regData[storeroad]'", "'$regData[storecity]'", "'$regData[storepin]'", "'$regData[storestate]'", "'$regData[storecountry]'", "'$regData[storecontinent]'", "'$regData[storephone]'", "'$regData[storemobile]'", "'$regData[storeemail]'", "'$this->password'", "'$regData[storeweb]'", "CURRENT_TIMESTAMP", "'$regData[storecategory]'"));
				
				/**Step2: ownerid creation as well as inserting data into shop_owner_detail table.  also creating map between tables shop_master and shop_owner_detail*/
				$ownerId = $objModel->insertData("shop_owner_detail", array("shop_id", "shop_owner_full_name", "shop_owner_email_id", "shop_owner_mobile", "shop_owner_res_address"), array("$shopId", "'$regData[shopownername]'", "'$regData[storeowneremail]'", "'$regData[shopownermob]'", "'$regData[shopowneradd]'"));
				
				/**Send email: Send an email with details to the user.*/
				$sendMailError = $this->sendMail('me@myaddress.net', 'adplat', $regData[storeemail], $regData[storename], $this->subjectRegmail, $this->textRegMail, $this->htmlRegMail, $this->attachedFile);
				
				/**If setup process goes wrong due to any of the following reasons*/
				if(($shopId == 0)||($ownerId == 0)|($sendMailError == 0)){
				$objModel->deleteResult("shop_master", "shop_id = '$shopId'", "order by code", ""); 
				$objModel->deleteResult("shop_owner_detail", "shop_owner_id = '$shopId'", "order by code", ""); 
					return 0;//If any one of the processes goes wrong.
				}else{
					return 1;//If entire setup process is okay
				}
				}
			}
		}
	}

	





?>