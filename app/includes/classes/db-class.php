<?php
	require_once(dirname(__FILE__)."/config.php");
	class dbc{

		public function __construct(){
			$mysqli=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

			if($mysqli->connect_errno) {
				echo "Connect failed".$mysqli->connect_errno;
				exit();
			}

			$this->connection=$mysqli;
		}

		public function clean($array){
			$array=array_map('trim',$array);
			return array_map(array($this->connection, 'mysqli_real_escape_string'), $array);
		}

		public function hash_password($password,$nonce){
			$secureHash=hash_hmac('sha512',$password,$nonce);

			return $secureHash;
		}

		public function get_results($query){ //RETURNS QUERY OBJECT OF A QUERY
			return $this->select($query);
			//FOR SPECIFIC RESULTS
		}

		public function get_num_rows($query_object){ //RETURNS NUMBER OF ROWS OF A QUERY
			return mysqli_num_rows($query_object);
		}

		public function select($query){ //QUERY DATABASE AND RETURN QUERY OBJECT
			$db=$this->connection;
			$result=$db->query($query);
			$results="";

			while($row=mysqli_fetch_assoc($result)){ //fetch objects returns object result
				$results[]=$row;
			}

			return $results;
		}

		public function show_columns($query){ //QUERY DATABASE AND RETURN QUERY OBJECT
			$db=$this->connection;
			$result=$db->query($query);
			$results="";

			while($row=mysqli_fetch_assoc($result)){ //fetch objects returns object result
				$results[]=$row['Field'];
			}

			return $results;
		}

		public function insert($table,$data,$format){ //INSERTS DATA
			//data=assoc array of column name=>value
			//format = pst format (sssd)

			$db=$this->connection;

			//build format string (breaks format array to string for pst use)
			$format=implode('',$format); //breaks the format array


			list($fields,$placeholders,$values) = $this->prep_query($data); //puts prep array to list of variables eg. data[0]=fields data[1]=placeholders

			array_unshift($values,$format); //prepends the $format in front of values (bind_param)
			//prepares query for binding
			$stmt=$db->prepare("INSERT INTO `$table` ($fields) VALUES ($placeholders)");

			// dynamically bind values
			call_user_func_array(array($stmt,'bind_param'),$this->ref_values($values));
			// ^loop through array

			$stmt->execute();

			// check for successful insertion
			if($stmt->affected_rows) return true;
			return false;
		}

		//-------------------------- UPDATE ---------------------------------//
			public function update($table,$data,$format,$where,$where_format){ //UPDATES DATA
			//data=assoc array of column name=>value
			//format = pst format (sssd)

			//check for table and data not set
			if(empty($table) || empty($data)) return false;

			$db=$this->connection;

			//build format string (breaks format array to string for pst use)
			$format=implode('',$format); //breaks the format array

			$where_format=implode('',$where_format);
			$where_format=str_replace('%','',$where_format);
			$format.=$where_format;


			list($fields,$placeholders,$values) = $this->prep_query($data,'update'); //puts prep array to list of variables eg. data[0]=fields data[1]=placeholders

			//format where clauses
			$where_clause='';
			$where_values='';
			$count=0;

			foreach ($where as $field => $value) {
				if($count>0) $where_clause.= ' AND ';

				$where_clause.=$field.'=?';
				$where_values[]=$value;
				$count++;
			}

			array_unshift($values,$format); //prepends the $format in front of values (bind_param)
			$values=array_merge($values,$where_values);
			//prepares query for binding
			$stmt=$db->prepare("UPDATE `$table` SET $placeholders WHERE $where_clause");

			// dynamically bind values
			call_user_func_array(array($stmt,'bind_param'),$this->ref_values($values));
			// ^loop through array

			$stmt->execute();

			//check for successful insertion
			if($stmt->affected_rows) return true;
			return false;
		}

		//-------------------------- DELETE ---------------------------------//
		public function delete($table,$id){
			$db= $this->connection;
			$stmt=$db->prepare("DELETE FROM $table WHERE ID= ?");

			$stmt->bind_param('d',$id);
			$stmt->execute();
		}


		public function prep_query($data,$type='insert'){
			// instantuate fields and placeholders for looping
			$fields='';
			$placeholders='';
			$values=array();
			//loop through data amd build fields placehodlers and values
			foreach ($data as $field => $value) {
				$fields.="$field,"; //creates comma separated strings for column names
				$values[]=$value; //stores value in a array

				if($type=='update') $placeholders.=$field.'=?,'; //for update name=?
				else $placeholders.="?,"; //for insert = values(?,?,?)
			}

				$fields = substr($fields,0,-1); //removes the last , of fields
				$placeholders=substr($placeholders,0,-1); //removes the last , of placholders

				return array($fields,$placeholders,$values);
		}

		private function ref_values($array){
			$refs=array();

			foreach ($array as $key => $value) {
				$refs[$key]= &$array[$key];
			}

			return $refs;
		}

		public function table_exist($table){
		$result = mysqli_query($db->connection,"SHOW TABLES LIKE '$table'");
		$tableExists = mysql_num_rows($result) > 0;

		return $tableExists;
	}

	}

	$db=new dbc;
?>


