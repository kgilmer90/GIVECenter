<?php

include_once('MySQLDateException.php');

class MySQLDate
{
	//see PHP date() function reference
	
	const YEAR 	= 'Y';		//4-digit year
	const MONTH = 'm';		//2-digit month (with leading zeroes)
	const DAY 	= 'd';		//2-digit day (with leading zeroes)
	
	const HOUR 		= 'H';		//2-digit 24-hour hours (with leading zeroes)
	const MINUTE 	= 'i';		//2-digit minute (with leading zeroes)
	const SECOND 	= 's';		//2-digit second (with leading zeroes)
	
	const DATE_FORMAT 		= 'Y-m-d';			//standard MySQL DATE format
	const TIME_FORMAT 		= 'H:i:s';			//standard MySQL TIME format
	const DATETIME_FORMAT 	= 'Y-m-d H:i:s';	//standard MySQL DATETIME format
	
	private $timestamp;		//UNIX timestamp
	
	/**
	 * MySQLDate default constructor, sets date to right now.
	 */
	public function __construct()
	{
		$this->timestamp = time();
	}
	
	/**
	 * MySQLDate constructor, initializes object with a UNIX timestamp
	 * created from time() or mktime()
	 * @param int $initTimestamp - UNIX timestamp to initialize with
	 */
	public function __construct($unixTimestamp)
	{
		$this->timestamp = $unixTimestamp;
	}
	
	/**
	 * MySQLDate constructor, initializes object with a UNIX timestamp
	 * representing the date and time passed in as arguments
	 * @param int $fourDigitYear - four digits for the year
	 * @param int $monthOfYear - values 1 through 12
	 * @param int $dayOfMonth - values 1 through 31
	 * @param int $hoursSinceMidnight - values 0 through 23
	 * @param int $minutesSinceHour - values 0 through 59
	 * @param int $secondsSinceMinute - values 0 through 59
	 * @throws MySQLDateException if parameters cause mktime() to return false or -1
	 * @link http://php.net/manual/en/function.mktime.php
	 */
	public function __construct($fourDigitYear, $monthOfYear, $dayOfMonth, 
			$hoursSinceMidnight, $minutesSinceHour, $secondsSinceMinute)
	{
		$this->timestamp = mktime($hoursSinceMidnight, $minutesSinceHour, 
						$secondsSinceMinute, $fourDigitYear, $monthOfYear, $dayOfMonth);
		
		if($this->timestamp == false or $this->timestamp == -1)
		{
			$errorStr = "Year: $fourDigitYear, Month: $monthOfYear, Day: $dayOfMonth,
						Hour: $hoursSinceMidnight, Minute: $minutesSinceHour, 
						Second: $secondsSinceMinute";
			
			throw new MySQLDateException($errorStr);
		}
	}
	/**
	 * Sets the timestamp to the current date and time.
	 */
	public function setNow()
	{
		$this->timestamp = time();
	}
	/**
	 * Sets the timestamp to the UNIX timestamp passed as a parameter.
	 * @param int $unixTimestamp - UNIX timestamp
	 */
	public function setTimestamp($unixTimestamp)
	{
		$this->timestamp = $unixTimestamp;
	}
	/**
	 * Offsets the current date and time by the amount specified, strings should be
	 * formatted according to regex: [+-]?[0-9]+ for example '+1' or '-3'
	 * @param string $yearOffset - amount to offset the year
	 * @param string $monthOffset - amount to offset the month
	 * @param string $dayOffset - amount to offset the day
	 * @param string $hourOffset - amount to offset the hour
	 * @param string $minuteOffset - amount to offset the minute
	 * @param string $secondOffset - amount to offset the second
	 * @throws MySQLDateException if PHP library function strtotime() returns false or -1
	 */
	public function offset($yearOffset = '+0', $monthOffset = '+0', $dayOffset = '+0', 
			$hourOffset = '+0', $minuteOffset = '+0', $secondOffset = '+0')
	{
		$offset = $this->timestamp;
		
		$offset = strtotime("$yearOffset years", $offset);
		$offset = strtotime("$monthOffset months", $offset);
		$offset = strtotime("$dayOffset days", $offset);
		$offset = strtotime("$hourOffset hours", $offset);
		$offset = strtotime("$minuteOffset minutes", $offset);
		$offset = strtotime("$secondOffset seconds", $offset);
		
		if($offset == false || $offset == -1)
		{
			$errorString = "Timestamp: {$this->datetime()} -- $yearOffset years, $monthOffset months, $dayOffset days, 
					$hourOffset hours, $minuteOffset minutes, $secondOffset seconds";
					
			throw new MySQLDateException($errorString);
		}
		$this->timestamp = $offset;
	}
	/**
	 *	Returns the UNIX timestamp for the given time.
	 */
	public function timestamp()
	{
		return $this->timestamp;
	}
	/**
	 * Returns a date string containing the date and time using standard
	 * MySQL DATETIME formatting.
	 */
	public function dateTime()
	{
		return date($this->DATETIME_FORMAT, $this->timestamp);
	}
	/**
	 *	Returns a date string containing the date using standard MySQL DATE formatting.
	 */
	public function date()
	{
		return date($this->DATE_FORMAT, $this->timestamp);
	}
	/**
	 *	Returns a time string containing the time using standard MySQL TIME formatting.
	 */
	public function time()
	{
		return date($this->TIME_FORMAT, $this->timestamp);
	}
	/**
	 * Returns a datetime string formatted according to the format string.
	 * @param string $formatString - see date() function reference for
	 * how to create a format string, link provided below.
	 * @return formatted datetime string, same as date() function
	 * @link http://php.net/manual/en/function.date.php
	 */
	public function format($formatString)
	{
		return date($formatString, $this->timestamp);
	}
}

?>