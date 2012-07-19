<?PHP
	/**
	/* @description:  This class contains all variables and functions for database activities.  this class follows /* 
	/* singleton
	/* @author: indranil
	/* 
	*/
	
	//include("config.class.php");
	if(!class_exists('Config')){
	include_once("config.class.php");
	}

	class Db extends Config{
		
		private static $instance;
		protected $link;
		protected $row;
		protected $resultSet;
		protected $result;
		protected $query;
		protected $count;
				
		public static function getInstance()
		{
			if (!isset(self::$instance))
			{
				self::$instance = new Db();
			}
			
			return self::$instance;
		}
			
		public function mysqlConnect()
			{
				try{ 
					$this->link = @mysql_connect($this->dbHost, $this->dbUserName, $this->dbPassWord);
						if(!$this->link){
							throw new Exception('Unable to establish database connection: '.@mysql_error());
						}
						
					}catch(Exception $e){
						$this->logIt($e->getMessage());
						//$e->getMessage();
					}
				$this->selectDB();	
				return $this->link;
			}
			
		public function selectDB()
			{
			try{
				if (!@mysql_select_db($this->dbName, $this->link)){
						throw new Exception('Unable to select database: ' . @mysql_error($this->link));
					}
				}catch(exception $e){
						$this->logIt($e->getMessage());
						//echo $e->getMessage();
					}
			}
			
		public function selectResult($table, $colm, $where, $cond, $limit = null){
		
			$this->query = "select ".implode(',', $colm)." from ".$table." where ".$where." ".$cond." ".$limit;
			$this->result = $this->checkMemcached($this->query);
			if($this->result == null){
				$memcache = new Memcache;  
				$memcache->connect($this->dbHost, $this->memPort) or die ("Could not connect");  
				$this->result = @mysql_query($this->query);
				$key = md5($this->memStr.$this->query);
				$memcache->set($key,$this->result,0,$this->expireMem);// Set key and value in memcache
				try{	
					if (!$this->result) {
						throw new Exception(@mysql_error());
					}
					
					if (!is_resource($this->result) 
						|| get_resource_type($this->result) != 'mysql result') {
						throw new Exception("Query does not return an mysql result resource.");
					}
					$this->count = 0;
					while($this->resultSet = @mysql_fetch_assoc($this->result)){
						for($i = 0; $i < count($colm); $i++){
							$this->row[$this->count][$colm[$i]] = $this->resultSet[$colm[$i]];
						}
						$this->count++;
					}
					return $this->row;
			}catch(exception $e){
				$this->logIt($e->getMessage());
				//echo $e->getMessage();
			}
			}else{
				return $this->result;
			}
		}
		
		public function uniqueResult($table = null, $where = null){
		
			$this->query = "select * from ".$table." where ".$where;
			$this->result = $this->checkMemcached($this->query);
			if($this->result == null){
				$memcache = new Memcache;  
				$memcache->connect($this->dbHost, $this->memPort) or die ("Could not connect");  
				$this->result = @mysql_query($this->query);
				$key = md5($this->memStr.$this->query);
				$memcache->set($key,$this->result,0,$this->expireMem);// Set key and value in memcache
				$this->result = @mysql_query($this->query);
				try{	
						if (!$this->result) {
							throw new Exception(@mysql_error());
						}
						
						if (!is_resource($this->result) 
							|| get_resource_type($this->result) != 'mysql result') {
							throw new Exception("Query does not return an mysql result resource.");
						}
						
						return mysql_num_rows($this->result);
					}catch(exception $e){
						$this->logIt($e->getMessage());
						//echo $e->getMessage();
					}
				}else{
					return mysql_num_rows($this->result);
				}
		}
		
		public function updateResult($table, $set, $where){
		
			$this->query = "update ".$table." set ".implode($set, ', ')." where ".$where;
			$this->result = @mysql_query($this->query);
			$this->updateMemcached($this->query);
			try{	
					if (!$this->result) {
						throw new Exception(@mysql_error());
					}
					$this->count = mysql_affected_rows();
					if ($this->count == 0 ){
						throw new Exception("Query does not update any result.");
					}
					return $this->count;
				}catch(exception $e){
				$this->logIt($e->getMessage());
				//echo $e->getMessage();
			}
		}
		
		public function deleteResult($table, $where, $order, $limit){
		
			$this->query = "delete from ".$table." where ".$where." ".$order." ".$limit;
			$this->result = @mysql_query($this->query);
			$this->updateMemcached($this->query);
			try{	
					if (!$this->result) {
						throw new Exception(@mysql_error());
					}
					$this->count = mysql_affected_rows();
					if ($this->count == 0 ){
						throw new Exception("Query does not delete any row.");
					}
					return $this->count;
				}catch(exception $e){
				$this->logIt($e->getMessage());
				//echo $e->getMessage();
			}
		}
		
		public function joinResult($tableField = null, $colms = null, $joinCondition = null, $order = null, $limit = null){
		
			$this->query = "select ".implode(', ', $tableField)." from ".$joinCondition." ".$order." ".$limit;
			$this->result = $this->checkMemcached($this->query);
			if($this->result == null){
			$memcache = new Memcache;  
			$memcache->connect($this->dbHost, $this->memPort) or die ("Could not connect");  
			$this->result = @mysql_query($this->query);
			$key = md5($this->memStr.$this->query);
			$memcache->set($key,$this->result,0,$this->expireMem);// Set key and value in memcache

			$this->result = @mysql_query($this->query);
			try{	
				if (!$this->result) {
					throw new Exception(@mysql_error());
				}
				
				if (!is_resource($this->result) 
					|| get_resource_type($this->result) != 'mysql result') {
					throw new Exception("Join Problem: Query does not return an mysql result resource.");
				}
				$this->count = 0;
				while($this->resultSet = @mysql_fetch_assoc($this->result)){
					for($i = 0; $i < count($colms); $i++){
						$this->row[$this->count][$colms[$i]] = $this->resultSet[$colms[$i]];
					}
					$this->count++;
				}
				return $this->row;
			}catch(exception $e){
				$this->logIt($e->getMessage());
				//echo $e->getMessage();
			}
			}else{
				return $this->result;
			}
		}
		
		public function insertData($table = null, $colms = null, $vals = null){
		
			$this->query = "insert into ".$table." ( ".implode(', ', $colms)." ) values "." (".implode(', ', $vals).")";
			$this->result = @mysql_query($this->query);
			try{	
				if (mysql_insert_id() == 0) {
					throw new Exception("Insertion Problem: Query does not return an mysql result resource: ".@mysql_error());
				}
				return mysql_insert_id();
			}catch(exception $e){
				$this->logIt($e->getMessage());
				//echo $e->getMessage();
			}
		}
		
		/**Check if query already cached*/
		public function checkMemcached($sql){
		
			try{
				$memcache = new Memcache;
				if(!is_object($memcache)){
					throw new exception("Memcache object not created");
					exit;
				}
				 $link = @$memcache->connect($this->dbHost, $this->memPort) or die ($this->logIt("Could not connect memcache server "));
				if(!$link){throw new exception("Memcache object not created");}				
				//create an index key for memcache
				$key = md5($this->memStr.$sql);
				//lookup value in memcache
				$result = $memcache->get($key);
				//check if we got something back
				if($result == null){
				return null;
				}else{
				return $result;
				}
			}catch(exception $e){
				$this->logIt($e->getMessage());
				//echo $e->getMessage();
			}
		}
		
		public function updateMemcached($sql){
		
			try{
				$memcache = new Memcache;
				if(!is_object($memcache)){
					throw new exception("Memcache object not created");
					exit;
				}
				$link = @$memcache->connect($this->dbHost, $this->memPort) or die ($this->logIt("Could not connect memcache server "));  
				if(!$link){throw new exception("Memcache object not created");}		
				//create an index key for memcache
				$key = md5($this->memStr.$sql);
				//lookup value in memcache
				$result = $memcache->delete($key);
			}catch(exception $e){
				$this->logIt($e->getMessage());
				//echo $e->getMessage();
			}
		}
	}	
			
	//$db = Db::getInstance();  //Step1: Create a singleton object
	//$db->mysqlConnect(); //Step1: Create a connection
	//$tmp = $db->selectResult("country", array("name", "code"), "code like '%A%'", "order by code", ""); //Step1: Create a query object
	//var_dump($tmp);
 	//$db->updateResult("country", array("name = 'ARAB'", "code = 'AWD'"), "code = 'hello'"); //Step1: Create a update query object
	//$db->deleteResult("country", "code = 'a'", "order by code", ""); //Step1: Create a delete query object
	//$temp = $db->joinResult(array("country.name", "countrylanguage.language"), array("name", "language"),"country left join countrylanguage on country.code = countrylanguage.countrycode");  //Step1: Create a join query object
	//var_dump($temp);
	//$db->insertData("test", array("name", "address"), array("'indranil'", "'Pune'"));
	//$temp = $db->uniqueResult("test", "name = 'indranil'"); 
	//var_dump($temp);



?>