<?php

include_once(dirname(__FILE__).'/IOException.php');

class FileNotFoundException extends IOException
{
	/**
	 * FileNotFoundException constructor, occurs when a file that doesn't exist is opened for reading.
	 * @param string $message - exception message, usually just the name of the file.
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