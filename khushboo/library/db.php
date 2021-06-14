<?php

class db {

    protected $connection;
	protected $query;
    protected $show_errors = TRUE;
    protected $query_closed = TRUE;
	public $query_count = 0;

	public function __construct() {

		
		$this->connection = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
		if ($this->connection->connect_error) {
			$this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
		}

		
		
		//$this->connection->set_charset($charset);
	}

	
	/* 
	$attr['type'] = update or insert
	$attr['table'] = table name
	$attr['query'] ='INSERT INTO accounts (username,password,email,name) VALUES (?,?)'; -- optional
				
	$db_field =array('name'=>'khushboo','email'=>'khushboo@gmail.com'); */
				
	public function query($attr=array(),$db_field=array(),$where_db_fields=array()) {
		
        if (!$this->query_closed) {
            $this->query->close();
        }
		
		$table = $attr['table'];
		$type 	= $attr['type'];
		
	if($table || $attr['query']){
		if($table){
			if($type == 'insert'){
				$db_field_replace = array_map(function($val) { return '?'; }, $db_field);

				$query  = "INSERT INTO `".$table."` (`";
				$query .= implode('`, `', array_keys($db_field));
				$query .= "`) VALUES (";
				$query .= implode(',', $db_field_replace);
				$query .= ")";
			}
			else if($type == 'update'){
				
				foreach($db_field AS $key =>$val){
						$db_field_str[] = $key.'=?';
				}
				
				foreach($where_db_fields AS $key1 =>$val1){
						$db_field_where_str[] = $key1.'=?';
				}
				
				$db_field = array_merge($db_field,$where_db_fields);

				$query = "UPDATE `".$table."` SET ";
				$query .=  implode(',', $db_field_str);
				$query .= " WHERE  ";
				$query .=  implode(',', $db_field_where_str);
				//$query = " UPDATE users SET name=? WHERE id=?";
			}
			else{
				
				$query = $attr['query'];
			}
		}
		else{
			$query = $attr['query'];
		}
			//echo $query;exit; 
					
			if ($this->query = $this->connection->prepare($query)) {
				if (func_num_args() > 1) {
					$x = func_get_args();
					//$args = array_slice($x, 1);
					$args = $db_field;
					$types = '';
					$args_ref = array();
					foreach ($args as $k => &$arg) {
						if (is_array($args[$k])) {
							foreach ($args[$k] as $j => &$a) {
								$types .= $this->_gettype($args[$k][$j]);
								$args_ref[] = &$a;
							}
						} else {
							$types .= $this->_gettype($args[$k]);
							$args_ref[] = &$arg;
						}
					}
					array_unshift($args_ref, $types);
					//echo $this->query;exit;
					call_user_func_array(array($this->query, 'bind_param'), $args_ref);
				}
				$this->query->execute();
				if ($this->query->errno) {
					$this->error('Unable to process MySQL query (check your params) - ' . $this->query->error);
				}
				$this->query_closed = FALSE;
				$this->query_count++;
			} else {
				$this->error('Unable to prepare MySQL statement (check your syntax) - ' . $this->connection->error);
			}
			return $this;
		}
    }


	public function fetchAll($callback = null) {
	    $params = array();
        $row = array();
	    $meta = $this->query->result_metadata();
	    while ($field = $meta->fetch_field()) {
	        $params[] = &$row[$field->name];
	    }
	    call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            if ($callback != null && is_callable($callback)) {
                $value = call_user_func($callback, $r);
                if ($value == 'break') break;
            } else {
                $result[] = $r;
            }
        }
        $this->query->close();
        $this->query_closed = TRUE;
		return $result;
	}

	public function fetchArray() {
	    $params = array();
        $row = array();
		
	    $meta = $this->query->result_metadata();
	    while ($field = $meta->fetch_field()) {
	        $params[] = &$row[$field->name];
	    }
	    call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
		while ($this->query->fetch()) {
			foreach ($row as $key => $val) {
				$result[$key] = $val;
			}
		}
        $this->query->close();
        $this->query_closed = TRUE;
		return $result;
	}

	public function close() {
		return $this->connection->close();
	}

    public function numRows() {
		$this->query->store_result();
		return $this->query->num_rows;
	}

	public function affectedRows() {
		return $this->query->affected_rows;
	}

    public function lastInsertID() {
    	return $this->connection->insert_id;
    }

    public function error($error) {
        if ($this->show_errors) {
            exit($error);
        }
    }

	private function _gettype($var) {
	    if (is_string($var)) return 's';
	    if (is_float($var)) return 'd';
	    if (is_int($var)) return 'i';
	    return 'b';
	}

}