<?php

include_once(dirname(__FILE__).'/AbstractFile.php'); 
include_once(dirname(__FILE__).'/IOException.php');
include_once(dirname(__FILE__).'/FileFoundException.php');
include_once(dirname(__FILE__).'/FileNotFoundException.php');

class FileWriter extends AbstractFile
{
	//TEXT MODE
	const WO_TRUNC_TEXT = 'wt';		//write-only, truncate to zero if exists, create if doesn't exist
	const WO_APPEND_TEXT = 'at';	//write-only, file pointer set to EOF, create if doesn't exist
	const WO_CREATE_TEXT = 'xt';	//write-only, create if doesn't exist, fail if does exist
	const WO_NOTRUNC_TEXT = 'ct';	//write-only, create if doesn't exist, don't truncate if does exist
	
	//BINARY MODE
	const WO_TRUNC_BIN = 'wb';		//write-only, truncate to zero if exists, create if doesn't exist
	const WO_APPEND_BIN = 'ab';		//write-only, file pointer set to EOF, create if doesn't exist
	const WO_CREATE_BIN = 'xb';		//write-only, create if doesn't exist, fail if does exist
	const WO_NOTRUNC_BIN = 'cb';	//write-only, create if doesn't exist, don't truncate if does exist
	
	
	/**
	 * FileReader constructor. Accepts a file name and file read mode
	 * and attempts to open the file. If the file does not exist, a 
	 * FileNotFoundException is thrown.
	 * 
	 * @param string $fileName - path to file to open
	 * @param string $fileWriteMode - FileWriter class constant. Defaults
	 * to FileWriter::WO_TRUNC_BIN for write-only binary mode, create if 
	 * doesn't exist, truncate to zero if does exist.
	 * @throws IOException on general error
	 * @throws FileNotFoundException when opened in a mode that requires the file already exist
	 * @throws FileFoundException when opened in a mode that requires the file not already exist
	 */
	public function __construct($fileName, $fileWriteMode = FileWriter::WO_TRUNC_BIN)
	{
		$this->fname = $fileName;
		
		$exists = file_exists($this->fname);
		
		//if file exists but is trying to be opened in a mode that requires it not exist
		if(($fileWriteMode == FileWriter::WO_CREATE_BIN || 
			$fileWriteMode == FileWriter::WO_CREATE_TEXT ) && $exists)
		{
			throw new FileFoundException($this->fname);
		}
		//else if the file doesn't exist and is trying to be opened in a mode that requires it exist
		else if(!$exists) {
			throw new FileNotFoundException($this->fname);
		}
		
		$this->handle = fopen($this->fname, $fileReadMode);
		
		if($this->handle == false) {
			throw new IOException($this->fname);
		}
	}
	
	/**
	 * Writes a string to the file, write stops at end of string or
	 * after $length bytes of data have been written.
	 * @param string $data string to write to the file
	 * @param int $length maximum number of bytes to write, defaults to 1024
	 * @return number of bytes written
	 * @throws IOException on error
	 */
	public function write($data, $length = 1024)
	{
		$writeCount = fwrite($this->handle, $data, $length);
		
		if($writeCount == false) {
			throw new IOException($this->fname);
		}
		else {
			return $writeCount;
		}
	}
	
	/**
	 * Writes a string to the file, write stops at end of string or
	 * after $length bytes of data have been written, a newline is
	 * appended to the end of the string.
	 * @param string $data string to write to the file
	 * @param int $length maximum number of bytes to write, defaults to 1024
	 * @return number of bytes written
	 * @throws IOException on error
	 */
	public function writeLine($data, $length = 1024)
	{
		$writeCount = fwrite($this->handle, $data.PHP_EOL, $length);
		
		if($writeCount == false) {
			throw new IOException($this->fname);
		}
		else {
			return $writeCount;
		}
	}
	
	/**
	 * FileReader class destructor, ensures the file is closed properly.
	 */
	public function __destruct()
	{
		if($this->handle != false) {
			$this->close();
		}
	}
}
?>