<?php
class Datetimefun
{
	/*
	 * 输入格式是YYYY-MM-DD
	 * 
	 */
	private static $timestamp;
	
	public function convert_datetime_short($str) { 
		if($str!=='')
		{
		    list($year, $month, $day) = explode('-', $str); 
		    self::$timestamp = mktime(0, 0, 0, $month, $day, $year); 
		}
		else
		{
			self::$timestamp=0;
		}
	     
	    return self::$timestamp;

        strtotime($str);
	} 	
	
	/*
	 * 输入格式是YYYY-MM-DD HH-MI-SS
	 * 
	 */
	public function convert_datetime_long($str) { 

		if($str!=='')
		{
		    list($date, $time) = explode(' ', $str); 
		    list($year, $month, $day) = explode('-', $date); 
		    list($hour, $minute, $second) = explode(':', $time); 
		    self::$timestamp = mktime($hour, $minute, $second, $month, $day, $year); 
		}
		else
		{
			self::$timestamp=0;
		}
	    return self::$timestamp; 
	} 
}
?>