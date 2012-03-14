<?php

class MySQLInsertQueryBuilder
{
	public $table;
	public $inserts;
	
	public function __construct()
	{
		$this->table = null;
		$this->inserts = array();
	}
	
	public function pushValue($field, $val)
	{
		$this->inserts[$field] = $val;
	}
	
	public function pushValues($assocArray)
	{
		foreach($assocArray as $key => $val) {
			$this->inserts[$key] = $val;
		}
	}
	
	public function query()
	{
		$query = 'INSERT INTO '.$this->table.' (';	//INSERT INTO table_name (
		
		$keys = array_keys($this->inserts);
		foreach($keys as $field) {
			$query .= $field.',';
		}
		$query[strlen($query)-1] = ')';	//INSERT INTO table_name (f1,f2, ...)
		
		$query .= ' VALUES (';			//INSERT INTO table_name (f1, f2, ...) VALUES (
		
		$values = array_values($this->inserts);
		foreach($values as $val) {
			$query .= $val.',';
		}
		$query[strlen($query)-1] = ')';		
		
		return $query;		//INSERT INTO table_name (f1, f2, ...) VALUES (v1, v2, ...)
	}
	
	public function __destruct() { }
}

?>