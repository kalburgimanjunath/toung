<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMUtils {

	const END_YEAR = 1910;
	const SECOND = 1;
	const MINUTE = 60; //60 * SECOND;
	const HOUR = 3600; // 60 * MINUTE;
	const DAY = 86400; //24 * HOUR;
	const MONTH = 2592000; //30 * DAY;
		
	function CMUtils()
	{
	}
	
	public static function getDOBYearOptions() {
		$startyear = date("Y");
		$endyear = 1940;
		return CMUtils::getYearOptions($startyear, $endyear);
	}
	
	public static function getCollegeYearOptions() {
		$startyear = date("Y");
		$endyear = 1970;
		return CMUtils::getYearOptions($startyear, $endyear);
	}

	public static function getCurrentYearOptionsFrom($endyear) {
		$startyear = date("Y");
		if ($endyear < self::END_YEAR) 
			$endyear = self::END_YEAR;
						
		return CMUtils::getYearOptions($startyear, $endyear);
	}

	public static function getWorkYearOptions() {
		$startyear = date("Y");
		$endyear = 1970;
		return CMUtils::getYearOptions($startyear, $endyear);
	}
	
	public static function getCurrentYearOptions() {
		$startyear = date("Y");
		$endyear = self::END_YEAR;
		return CMUtils::getYearOptions($startyear, $endyear);
	}
	
	public static function getYearOptions($startyear, $endyear) {
	
		$years = range($startyear, $endyear);
		array_unshift($years, 'Choose');

        $string = '';

        foreach($years as $k => $v){
            $string .= '<option value="'.$k.'">'.$v.'</option>'."\n";     
        }

		return $string;
		
    }
	
	// e.g. echo relativeTime('2010-03-17 10:18:36');
	// see all string formats supported by strtotime()
	public static function relativeTime($time)
	{   
	    
	  	$delta = time() - strtotime($time);
	    log_message("debug", "CMUtils::relativeTime input time is " . $time);
	    log_message("debug", "CMUtils::relativeTime input time strtotime() is " . strtotime($time));
	    log_message("debug", "CMUtils::relativeTime current time() is " . time());
	    log_message("debug", "CMUtils::relativeTime dalta is " . $delta);

	    if ($delta < 1 * self::MINUTE)
	    {
	    	if ($delta == 0) 
	    		return "now";
	    		
	        return $delta == 1 ? "one second ago" : $delta . " seconds ago";
	    }
	    if ($delta < 2 * self::MINUTE)
	    {
	      return "a minute ago";
	    }
	    if ($delta < 45 * self::MINUTE)
	    {
	        return floor($delta / self::MINUTE) . " minutes ago";
	    }
	    if ($delta < 90 * self::MINUTE)
	    {
	      return "an hour ago";
	    }
	    if ($delta < 24 * self::HOUR)
	    {
	      return floor($delta / self::HOUR) . " hours ago";
	    }
	    if ($delta < 48 * self::HOUR)
	    {
	      return "yesterday";
	    }
	    if ($delta < 30 * self::DAY)
	    {
	        return floor($delta / self::DAY) . " days ago";
	    }
	    if ($delta < 12 * self::MONTH)
	    {
	      $months = floor($delta / self::DAY / 30);
	      return $months <= 1 ? "one month ago" : $months . " months ago";
	    }
	    else
	    {
	        $years = floor($delta / self::DAY / 365);
	        return $years <= 1 ? "one year ago" : $years . " years ago";
	    }
	}

}

?>