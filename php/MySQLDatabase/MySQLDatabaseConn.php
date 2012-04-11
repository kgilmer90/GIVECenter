<?php

include_once(dirname(__FILE__).'/MySQLException.php');
include_once(dirname(__FILE__).'/MySQLDatabaseConnException.php');
include_once(dirname(__FILE__).'/MySQLQueryFailedException.php');

class MySQLDatabaseConn
{	
	//consts
	const CLIENT_COMPRESS 		= MYSQL_CLIENT_COMPRESS;
	const CLIENT_IGNORE_SPACE 	= MYSQL_CLIENT_IGNORE_SPACE;
	const CLIENT_INTERACTIVE 	= MYSQL_CLIENT_INTERACTIVE;
	const CLIENT_SSL 			= MYSQL_CLIENT_SSL;
	
	const FETCH_ASSOC 	= MYSQL_ASSOC;	//fetch result in associative array
	const FETCH_BOTH	= MYSQL_BOTH;	//fetch result in array with numeric and assoc indices
	const FETCH_NUM 	= MYSQL_NUM;	//fetch result in numerically indexed array
	
	//VITALS
	private $dblink;		//link created with mysql_connect()
	private $dbname;		//name of database selected on server
	private $resource;		//query result -- boolean on INSERT, DELETE, UPDATE, DROP
							//			   -- mysql resource on SELECT, SHOW, DESCRIBE, EXPLAIN
	
	//ERROR REPORTING
	public $lastQuery;		//last query executed or attempted to execute
	public $errorCode;		//returned from mysql_errno() after each connection, query, fetch, and close
	public $errorStr;		//returned from mysql_error() after each connection, query, fetch, and close
	
	/**
	 * MySQLDatabaseConn constructor, attempts to establish a connection with a MySQL database.
	 * @param string $server - server to connect to
	 * @param string $databaseName - name of database
	 * @param string $username - database user name 
	 * @param string $password - database password for user name
	 * @param boolean $newlink - use a new link (true) or reuse old one (false), defaults to false
	 * @param int $clientFlags - any of the MySQLDatabaseConn CLIENT class constants, defaults to zero
	 * @throws MySQLDatabaseConnException if connection fails
	 */
	public function __construct($server, $databaseName, $username, $password, $newlink = false, $clientFlags = 0)
	{
		$this->dbname = $databaseName;
		//@ symbol suppresses system error messages
		$this->dblink = @mysql_connect($server, $username, $password, $newlink, $clientFlags);
		
		$this->setErrors();
		
		if(!$this->dblink) {
			throw new MySQLDatabaseConnException($this->errorStr, $this->errorCode);
		}
		
		$result = mysql_select_db($this->dbname, $this->dblink);
		$this->setErrors();
		if(!$result) {
			throw new MySQLDatabaseConnException($this->errorStr, $this->errorCode);
		}
	}
	
	/**
	 * Get the number of affected rows by the last INSERT, UPDATE, REPLACE or DELETE query.
	 * @return number of rows affected by the query, or -1 if query failed.
	 */
	public function affectedRows()
	{
		return mysql_affected_rows($this->resource);
	}
	/**
	 * Closes the connection with the server, on success also sets the last
	 * query's resource to false.
	 * @return boolean true on success or false on failure.
	 */
	public function close()
	{
		$status = mysql_close($this->dblink);
		$this->setErrors();
		
		if($status == true) {
			$this->dblink = false;
			$this->resource = false;
		}
		return $status;
	}
	/**
	 * Fetches a row from the query's resulting dataset.
	 * @param int $resultType - type of array to fetch, any of the MySQLDatabaseConn 
	 * FETCH flags, defaults to FETCH_BOTH
	 * @return array of specified type containing the next row of the dataset, or false
	 * if no data remains.
	 */
	public function fetchRowAsArray($resultType = MySQLDatabaseConn::FETCH_BOTH)
	{
		$result = mysql_fetch_array($this->resource, $resultType);
		$this->setErrors();
		return $result;
	}
	/**
	 * Fetches a row from the query's dataset as an associative array.
	 * @return associative array of the next row in the dataset, or false
	 * if no data remains.
	 */
	public function fetchRowAsAssoc()
	{
		return $this->fetchRowAsArray(MySQLDatabaseConn::FETCH_ASSOC);
	}
	/**
	 * Fetches a row from the query's dataset as a numerically-indexed array.
	 * @return enumerated array of the next row in the dataset, or false
	 * if no data remains.
	 */
	public function fetchRowAsNumeric()
	{
		return $this->fetchRowAsArray(MySQLDatabaseConn::FETCH_NUM);
	}
	/**
	 * Fetches a row from the query's dataset as an object, similar to
	 * the associative array except that the array keys are fields in the
	 * object and the values are contained within the fields.
	 * @param string $className - optional name of the class to instantiate and return
	 * @param array $arrayParams - optional array of parameters to pass to
	 * the object constructor
	 * @return object containing the next row in the dataset, or false if
	 * no data remains
	 */
	public function fetchRowAsObject($className = null, $arrayParams = null)
	{
		if($className == null) 
		{
			if($arrayParams == null) {
				return mysql_fetch_object($this->resource);
			}
			else {
				return mysql_fetch_object($this->resource, $classname);
			}
		}
		else {
			return mysql_fetch_object($this->resource, $className, $arrayParams);	
		}
	}
	/**
	 * Fetches all rows from the query's resulting dataset.
	 * @param int $resultType - type of array to fetch, any of the MySQLDatabaseConn 
	 * FETCH flags, defaults to FETCH_BOTH
	 * @return 2D array (outer array is numerically-indexed, inner arrays are indexed
	 * according to the FETCH type parameter) containing all rows of the dataset, or false
	 * if no data remains.
	 */
	public function fetchAllAsArray($resultType = MySQLDatabaseConn::FETCH_BOTH)
	{
		$i = 0;
		$results = array();
		while($row = mysql_fetch_array($this->resource, $resultType))
		{
			$results[$i] = $row;
			$i++;
		}
		$this->setErrors();
		return $results;
	}
	/**
	 * Fetches all rows from the query's dataset as a 2D array.
	 * @return 2D array (outer array is indexed numerically, inner array
	 * is associative) of all rows in the query's dataset, or false if no
	 * data exists.
	 */
	public function fetchAllAsAssoc()
	{
		return $this->fetchAllAsArray(MySQLDatabaseConn::FETCH_ASSOC);
	}
	/**
	 * Fetches all rows from the query's dataset as a numerically-indexed 2D array.
	 * @return 2D array (both inner and outer arrays are indexed numerically) 
	 * of all rows in the query's dataset, or false if no data exists.
	 */
	public function fetchAllAsNumeric()
	{
		return $this->fetchAllAsArray(MySQLDatabaseConn::FETCH_NUM);
	}
	/**
	 * Fetches all data available for the SQL query and returns it as a
	 * numerically-indexed array of objects.
	 * @param string $className - optional name of the class to instantiate and return
	 * @param array $arrayParams - optional array of parameters to pass to
	 * the object constructor
	 * @return numerically-indexed array of objects containing all rows in the dataset, 
	 * or false if no data exists.
	 */
	public function fetchAllAsObject($className = null, $arrayParams = null)
	{
		$i = 0;
		$results = array();
		if($arrayParams == null) 
		{
			if($className == null) {
				while($obj = mysql_fetch_object($this->resource))
				{
					$results[$i] = $obj;
					$i++;
				}
			}
			else {
				while($obj = mysql_fetch_object($this->resource, $classname))
				{
					$results[$i] = $obj;
					$i++;
				}
			}
		}
		else {
			while($obj = mysql_fetch_object($this->resource, $className, $arrayParams))
			{
				$results[$i] = $obj;
				$i++;
			}
		}
		return $results;
	}
	/**
	 * Frees all memory associated with the resource from the last query, only
	 * necessary for extremely large result sets.
	 * @return true on success or false on failure
	 */
	public function free()
	{
		$status = mysql_free_result($this->resource);
		$this->setErrors();
		
		if($status == true) {
			$this->resource = false;
		}
		return $status;
	}
	/**
	 * Retrieves the number of rows from a result set, this command is only 
	 * valid for statements like SELECT or SHOW that return an actual result set.
	 * @return number of rows from the result set
	 */
	public function numRows()
	{
		return mysql_num_rows($this->resource);
	}
	/**
	 * Attempts to execute a query on the database, sets $this->resource upon success, must
	 * be called before any calls to fetch() can be made.
	 * for use in fetching rows from the resulting dataset.
	 * @param string $query - query to execute
	 * @throws MySQLQueryFailedException if query fails due to being malformed or other error
	 */
	public function query($query)
	{
		$this->lastQuery = $query;
		$this->resource = mysql_query($query, $this->dblink);
		
		$this->setErrors();
		
		if(!$this->resource) {
			throw new MySQLQueryFailedException($this->errorStr.' for Query: '.$this->lastQuery, $this->errorCode);
		}
		
		$this->rows = mysql_affected_rows($this->resource);
	}
	/**
	 * Called when object reaches end of scope, ensures database connection is closed.
	 */
	public function __destruct()
	{
		if($this->dblink != false) {
			$this->close();
		}
	}
	/**
	 * Sets the error code and error string with the most recent
	 * error code from mysql_errno() and error string from mysql_error().
	 */
	private function setErrors()
	{
		$this->errorCode = mysql_errno();
		$this->errorStr = mysql_error();
	}
}

?>