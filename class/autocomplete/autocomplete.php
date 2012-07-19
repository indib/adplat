<?php
	
	include_once("../db.class.php");		/**Include all required class*/
		
		class AutoComplete extends Db{

			private static $instance;
			public $stringResult;
			public $resultSubCat;
			public $resultShopCategory;
							
			public static function getInstance()
			{
				if (!isset(self::$instance))
				{
					self::$instance = new AutoComplete();
				}
				return self::$instance;
			}
			
			/**This function fetches data from city, state, country, continent master table as well as from shop_master table because there may be a city, state, country or continent which is not inside master table.*/
			public function autoGeoData($table, $column, $key, $shop_master_colm){
				$this->mysqlConnect(); //Step1: Create a connection

				$result = $this->selectResult($table, array($column), $column." like '%".$key."%'  ", "order by ".$column, ""); 
				
				$this->resultSubCat = $this->selectResult("shop_master", array($shop_master_colm), $shop_master_colm." like '%".$key."%' ", "order by ".$shop_master_colm, ""); 
				
				for($i = 0; $i < count($result); $i++){
					$this->stringResult .= $result[$i][$column]." \n";
				}
				for($i = 0; $i < count($this->resultSubCat); $i++){
					@$this->stringResult .= $this->resultSubCat[$i][$shop_master_colm]." \n";
				}
				echo $this->stringResult;
			}
			
			public function autoCategory($key){
				$this->mysqlConnect(); //Step1: Create a connection
				$result = $this->selectResult("shop_category", array("biz_cat", "has_subcats"), "biz_cat like '%".$key."%'  ", "order by biz_cat", ""); 
				
				$this->resultSubCat = $this->selectResult("shop_category", array("biz_cat", "has_subcats"), "has_subcats like '%".$key."%' ", "order by has_subcats", ""); 
				
				$this->resultShopCategory = $this->selectResult("shop_master", array("shop_category"), " shop_category like '%".$key."%' ", "order by shop_category", ""); 
				
			
				for($i = 0; $i < count($result); $i++){
					$this->stringResult .= $result[$i]['biz_cat']." (".$result[$i]['has_subcats'].") \n";
				}
				for($i = 0; $i < count($this->resultSubCat); $i++){
					$this->stringResult .= $this->resultSubCat[$i]['has_subcats']." (".$this->resultSubCat[$i]['biz_cat'].") \n";
				}
				for($i = 0; $i < count($this->resultShopCategory); $i++){
					$this->stringResult .= @$this->resultShopCategory[$i]['shop_category']." \n";
				}
				echo $this->stringResult;
			}		
		}
		
		$AutoComplete = AutoComplete::getInstance();  //Step1: Create a singleton object
		
		$q = $_GET['q'];
		$my_data = mysql_real_escape_string($q);
		@$table = $_REQUEST["t1"];
		@$column = $_REQUEST["t2"];
		@$type = $_REQUEST["type"];
		
		switch ($type) {
			case "country":
				$AutoComplete->autoGeoData($table, $column, $my_data, "shop_country"); //Step1: Create a connection
				break;
			case "state":
				$AutoComplete->autoGeoData($table, $column, $my_data, "shop_state"); //Step1: Create a connection
				break;
			case "continent":
				$AutoComplete->autoGeoData($table, $column, $my_data, "shop_continent"); //Step1: Create a connection
				break;
			case "city":
				$AutoComplete->autoGeoData($table, $column, $my_data, "shop_city"); //Step1: Create a connection
				break;
			case "category":
				$AutoComplete->autoCategory($my_data); //Step1: Create a connection
				break;
		}
		
		
		
	
?>