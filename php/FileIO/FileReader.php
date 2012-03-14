<?php

include_once('AbstractFile.php'); 
include_once('IOException.php');
include_once('FileNotFoundException.php');
include_once('FileMode.php');
include_once('FileToArray.php');

class FileReader extends AbstractFile
{	
	/**
	 * FileReader constructor. Accepts a file name and file read mode
	 * and attempts to open the file. If the file does not exist, a 
	 * FileNotFoundException is thrown.
	 * 
	 * @param string $fileName - path to file to open
	 * @param string $fileReadMode - FileReadMode class constant. Defaults
	 * to FileReadMode::RO_BIN for read-only binary mode
	 * @throws FileNotFoundException if the system cannot find the file
	 */
	public function __construct($fileName, $fileReadMode = FileReadMode::RO_BIN)
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
	 * @param int $length maximum number of bytes to read
	 * @return string file contents $length bytes long or FALSE on failure
	 */
	public function read($length)
	{
		$data = fread($this->handle, $length);
		
		if($data == false) {
			throw new EOFException($this->fname);
		}
		else {
			return $data;
		}
	}
	
	/**
	 * Reads a line from the file until reaching a new line, EOF, or $length bytes
	 * of data, whichever comes first.
	 * @param int $length integer number of bytes to read. Defaults to 1024
	 * @return string single line of file contents
	 * @throws EOFException if no more data to read
	 */
	public function readLine($length = 1024)
	{
		$data = fgets($this->handle);
		
		if($data == false) {
			throw new EOFException($this->fname);
		}
		else {
			return $data;
		}
	}
	
	/**
	 * Reads the entire file into an array where each element is a line in the file.
	 * @param int $flags any of the FileToArray class constants, defaults to zero.
	 * @throws IOException on error
	 */
	public function readIntoArray($flags = 0)
	{
		$arr = file($this->fname, $flags);
		
		if($arr == false) {
			throw new IOException($this->fname);
		}
		else {
			return $arr;
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