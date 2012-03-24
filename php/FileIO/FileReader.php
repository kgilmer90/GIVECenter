<?php

include_once('AbstractFile.php'); 
include_once('IOException.php');
include_once('FileNotFoundException.php');
include_once('FileToArray.php');

class FileReader extends AbstractFile
{	
	const RO_TEXT = 'rt';		//read-only, from beginning, must exist, text mode
	const RO_BIN = 'rb';		//read-only, from beginning, must exist, binary mode
	
	const ARRAY_USE_INCLUDE_PATH = FILE_USE_INCLUDE_PATH;
	const ARRAY_IGNORE_NEW_LINES = FILE_IGNORE_NEW_LINES;
	const ARRAY_SKIP_EMPTY_LINES = FILE_SKIP_EMPTY_LINES;
	
	/**
	 * FileReader constructor. Accepts a file name and file read mode
	 * and attempts to open the file. If the file does not exist, a 
	 * FileNotFoundException is thrown.
	 * 
	 * @param string $fileName - path to file to open
	 * @param string $fileReadMode - FileReader class constant. Defaults
	 * to FileReader::RO_BIN for read-only binary mode
	 * @throws FileNotFoundException if the system cannot find the file
	 */
	public function __construct($fileName, $fileReadMode = FileReader::RO_BIN)
	{
		$this->fname = $fileName;
		if(!file_exists($this->fname)) {
			throw new FileNotFoundException($this->fname);
		}
			
		$this->handle = fopen($this->fname, $fileReadMode);
		
		if($this->handle == false) {
			throw new IOException($this->fname);
		}
	}
	
	/**
	 * Reads $length bytes of data from the file into a string.
	 * @param int $length maximum number of bytes to read, defaults to 1024
	 * @return string file contents $length bytes long or FALSE on failure
	 */
	public function read($length = 1024)
	{
		return fread($this->handle, $length);
	}
	
	/**
	 * Reads a line from the file until reaching a new line, EOF, or $length bytes
	 * of data, whichever comes first.
	 * @param int $length integer number of bytes to read. Defaults to 1024
	 * @return string single line of file contents or FALSE if no more data to read
	 */
	public function readLine($length = 1024)
	{
		return fgets($this->handle);
	}
	
	/**
	 * Reads the entire file into an array where each element is a line in the file.
	 * @param int $flags FileReader ARRAY class constants, defaults to zero.
	 * @return file as numerically-indexed array, or FALSEs on error
	 */
	public function readIntoArray($flags = 0)
	{
		return file($this->fname, $flags);
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