<?php 

class Database {
	public $db_host = "mario.codefactory.live";
	public $db_name = "mariocf_final_project";
	public $db_user = "mariocf_lamm";
	public $db_pw = "1+ABWC_cp#[*";
	public $connection = '';

	public function connect() {

	//the @ sign will remove any warnings from mysqli!
		$this->connection = @mysqli_connect($this->db_host,$this->db_user,$this->db_pw,$this->db_name);
	//this is only for debugging, should not be used in a productive system
	/*	if (!$this->connection) {
			echo "Error: Unable to connect to database.<br>";
			echo "Debugging errno: " . mysqli_connect_errno() ."<br>";
			echo "Debugging error: " . mysqli_connect_error();
		} else {
			echo 
			echo "Host information: " . mysqli_get_host_info($this->connection);
		}*/
	}

	public function read($table, $fields='*', $join='',$where='',$orderby='') {
		$this->connect();
		$fields = is_array($fields) ? implode(", ", $fields) : $fields;
		$join = is_array($join) ? implode(" ", $join) : $join;
		$sql = "SELECT ".$fields." FROM ".$table." ".$join." ".$where." ".$orderby." ;";
	 	//echo $sql; //only for testing 
		$result = $this->connection->query($sql);
		//prevent error messages
		if ($result) {
		$return = $result->fetch_all(MYSQLI_ASSOC);
		mysqli_close($this->connection);
		return $return;
		}
		mysqli_close($this->connection);
	}

	public function update($table,$set,$condition) {
		$this->connect();
		$sql = '';
		$where= '';
		foreach ($set as $key => $value) {
			if($sql != ''){
   				$sql .=", ";
  			}
			$sql .= $key . "='".$value."' ";
		}
		foreach ($condition as $key => $value) {
			if($where != ''){
   				$where .=" AND ";
  			}
 			$where .= $key . "='" . $value . "'";
 		}
		$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$where.";";
		$this->connection->query($sql);
		mysqli_close($this->connection);
	}

	public function insert($table, $fields, $values) {
		$this->connect();
		$fields = is_array($fields) ? implode(", ", $fields) : $fields;
		//$values = implode("','", $values);
		$sql = '';
		if (is_array($values)){
			foreach ($values as $value) {
						if ($sql !=''){
							$sql .=", ";
						}
						$sql .= "'".mysqli_real_escape_string($this->connection,$value)."'";
					}

		} else {
			$sql = $values;
		}
		
		$sql = "INSERT INTO ".$table." (".$fields.") VALUES (".$sql.");";
		$res = $this->connection->query($sql);
		mysqli_close($this->connection);
		return true;
	}

	public function delete($table,$condition) {
		$this->connect();
		$sql='';
		foreach ($condition as $key => $value) {
			if($sql != ''){
   				$sql .=" AND ";
  			}
 			$sql .= $key . "='" . $value . "'";
 		}
		$sql="DELETE FROM ".$table." WHERE ".$sql;
		$result = $this->connection->query($sql);
		mysqli_close($this->connection);
	}
}


$obj = new Database ();

 ?>