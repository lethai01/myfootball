<?php
/**
* 
*/
class Util {
	public static function convertStringDate2String($date, $fromFormat, $toFormat) {
		$datetime = new DateTime();
		$datetime = $datetime->createFromFormat($fromFormat, $date);
		if ($datetime) {
			return $datetime->format($toFormat);
		}
		return null;
	}
	
	public static function validateDate($date, $format = 'Y-m-d H:i:s') {
    	$tempDate = DateTime::createFromFormat($format, $date);
    	return $tempDate && $tempDate->format($format) == $date;
	}
	
	public static function getCurrentDBTime()  {
		return date('Y-m-d H:i:s',now());
	}
	
	public static function checkFormatDate($lotto_date) {
		//định dạng ngày nhập vào dd/mm/yyyy
		if(preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/", $lotto_date))
		{
			if(checkdate(substr($lotto_date, 3, 2), substr($lotto_date, 0, 2), substr($lotto_date, 6, 4))){
				return true;
			}
			else{
				return false;
			}
		} else {
			return false;
		}
	}
	
	public static function checkHour($hour)
	{
		if ($hour < 0 || $hour > 23) {
			return false;
		}
		return true;
	}
	
	public static function checkMinute($minute)
	{
		if ($minute < 0 || $minute >59) {
			return false;
		}
		return true;
	}
}