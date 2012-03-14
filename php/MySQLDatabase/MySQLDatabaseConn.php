<?php

include_once('MySQLException.php');
include_once('MySQLDatabaseConnException.php');
include_once('MySQLQueryFailedException.php');
include_once('MySQLClientConn.php');
include_once('MySQLFetchArray.php');

class MySQLDatabaseConn
{	
	//VITALS
	private $dblink;		//link created with mysql_connect()
	private $resource;		//query result -- boolean on INSERT, DELETE, UPDATE, DROP
							//			   -- mysql resource on SELECT, SHOW, DESCRIBE, EXPLAIN
	
	//ERROR REPORTING
	private $lastQuery;		//last query executed or attempted to execute
	private $errorCode;		//returned from mysql_errno() after each connection, query, fetch, and close
	private $errorStr;		//returned from mysql_error() after each connection, query, fetch, and close
	
	/**
	 * MySQLDatabaseConn constructor, attempts to establish a connection with a MySQL database.
	 * @param string $server - server to connect to
	 * @param string $username - database user name
	 * @param string $password - database password for user name
	 * @param boolean $newlink - use a new link (true) or reuse old one (false), defaults to false
	 * @param int $clientFlags - any of the MySQLClientConn class constants, defaults to zero
	 * @throws MySQLDatabaseConnException if connection fails
	 */
	public function __construct($server, $username, $password, $newlink = false, $clientFlags = 0)
	{
		$this->dblink = mysql_connect($server, $username, $password, $newlink, $clientFlags);
		$this->setErrors();
		
		if($this->dblink == false) {
			throw new MySQLDatabaseConnException($this->errorStr."\n".server.' '.$username, $this->errorCode);
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
	 * Returns an associative array of the most current errors, array keys are "code" for the
	 * numeric error code and "str" for the string message for the error.
	 * @return associative array of error descriptions
	 */
	public function errors()
	{
		return array(
			"code" => $this->errorCode,
			"str" => $this->errorStr
		);
	}
	/**
	 * Fetches a row from the query's resulting dataset.
	 * @param int $resultType - type of array to fetch, any of the MySQLFetchArray 
	 * flags, defaults to BOTH
	 * @return array of specified type containing the next row of the dataset, or false
	 * if no data remains.
	 */
	public function fetchArray($resultType = MySQLFetchArray::BOTH)
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
	public function fetchAssoc()
	{
		return $this->fetchArray(MySQLFetchArray::ASSOC);
	}
	/**
	 * Fetches a row from the query's dataset as a numerically-indexed array.
	 * @return enumerated array of the next row in the dataset, or false
	 * if no data remains.
	 */
	public function fetchNumeric()
	{
		return $this->fetchArray(MySQLFetchArray::NUM);
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
	public function fetchObject($className = null, $arrayParams = null)
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
	 * Returns the last query executed or attempted to be executed.
	 * @return string query
	 */
	public function lastQuery()
	{
		return $this->lastQuery;
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
		
		if($this->resource == false) {
			throw new MySQLQueryFailedException($this->lastQuery."\n".$this->errorStr, $this->errorCode);
		}
		
		$this->rows = mysql_affected_rows($this->resource);
	}
	/**
	 * Called when object reaches end of scope, ensures database connection is closed.
	 */
	public function __destruct()
	{
		if($this->dblink == false) {
			$this->close();
		}
	}
	/**
	 * Sets the error code and string with the most recent
	 * mysql error codes.
	 */
	private function setErrors()
	{
		$this->errorCode = mysql_errno();
		$this->errorStr = mysql_error();
	}
}

?>