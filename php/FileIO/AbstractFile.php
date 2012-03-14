<?php

abstract class AbstractFile
{
	protected $handle;
	protected $fname;
	
	/**
	 * Closes the file.
	 * @return bool TRUE on success
	 * @throws IOException on error
	 * @link http://us3.php.net/manual/en/function.fclose.php
	 */
	public function close()
	{
		$status = fclose($handle);
		
		if(!$status) {
			throw new IOException($this->fname);
		}
		
		if($status) {
			$this->handle = false;
		}
		return $status;
	}
	
	/**
	 * Tests for end-of-file on a file pointer.
	 * @link http://us3.php.net/manual/en/function.feof.php
	 */
	public function eof()
	{
		return feof($this->handle);
	}
	/**
	 * Gets the file group. The group ID is returned in numerical format, 
	 * use posix_getgrgid() to resolve it to a group name.
	 * @link http://us3.php.net/manual/en/function.filegroup.php
	 */
	public function group()
	{
		return filegroup($this->fname);
	}
	/**
	 * Gets the file inode.
	 * @link http://us3.php.net/manual/en/function.fileinode.php
	 */
	public function inode()
	{
		return fileinode($this->fname);
	}
	/**
	 * Gets the inode change time of a file.
	 * @link http://us3.php.net/manual/en/function.filectime.php
	 */
	public function inodeChangeTime()
	{
		return filectime($this->fname);
	}
	/**
	 * Gets the last access time of the given file.
	 * @link http://us3.php.net/manual/en/function.fileatime.php
	 */
	public function lastAccessTime()
	{
		return fileatime($this->fname);
	}
	/**
	 * This function returns the time when the data blocks of a file were 
	 * being written to, that is, the time when the content of the file was changed.
	 * @link http://us3.php.net/manual/en/function.filemtime.php
	 */
	public function modificationTime()
	{
		return filemtime($this->fname);
	}
	/**
	 * Gets the file owner.
	 * @link http://us3.php.net/manual/en/function.fileowner.php
	 */
	public function owner()
	{
		return fileowner($this->fname);
	}
	/**
	 * Gets permissions for the given file.
	 * @link http://us3.php.net/manual/en/function.fileperms.php
	 */
	public function permissions()
	{
		return fileperms($this->fname);
	}
	/**
	 * Sets the file position indicator for the file referenced by handle. 
	 * The new position, measured in bytes from the beginning of the file, 
	 * is obtained by adding offset to the position specified by whence
	 * @link http://us3.php.net/manual/en/function.fseek.php
	 */
	public function seek($offset, $whence = SEEK_SET)
	{
		return fseek($this->handle, $offset, $whence);
	}
	/**
	 * Gets the size for the given file.
	 * @link http://us3.php.net/manual/en/function.filesize.php
	 */
	public function size()
	{
		return filesize($this->handle);
	}
	/**
	 * Gathers the statistics of the file opened by the file pointer handle. 
	 * This function is similar to the stat() function except that it operates 
	 * on an open file pointer instead of a filename.
	 * @link http://us3.php.net/manual/en/function.fstat.php
	 */
	public function stat()
	{
		return fstat($this->handle);
	}
	/**
	 * Returns the position of the file pointer referenced by handle.
	 * @link http://us3.php.net/manual/en/function.ftell.php
	 */
	public function tell()
	{
		return ftell($this->handle);
	}
	/**
	 * Returns the type of the given file.
	 * @link http://us3.php.net/manual/en/function.filetype.php
	 */
	public function type()
	{
		return filetype($this->fname);
	}
}

?>