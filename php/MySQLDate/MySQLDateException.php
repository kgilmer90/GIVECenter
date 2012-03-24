<?php
class MySQLDateException extends Exception
{
	/**
	 * MySQLDateException constructor, occurs when a MySQLDate object is constructed
	 * with date and time parameters that cause mktime() to return false.
	 * @param string $message - the name of the file that caused the exception
	 * @param int $code - custom error code, defaults to zero
	 * @param Exception $previous - previous exception, defaults to null
	 */
	public function __construct($message, $code = 0, Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
	
	/**
	 * @see Exception::__toString()
	 */
	public function __toString()
	{
		return __CLASS__ . ": [{$this->code}]: [{$this->message}]";
	}	
}
?>