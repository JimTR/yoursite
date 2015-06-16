<?php
	
function correct_time_date ($date)
	{
		// convert paypal time to server time
		$sd = new DateTime(); //get the server time
		$tz = $sd->getTimeZone(); // get the server time zone 
		$sz = $tz->getName(); // get the time zone name
		$pd = date_parse_from_format('H:i:s M d, Y', $date); // get the date from the string in the paypal variable
		$paypal_time = $pd['year'].'-'.$pd['month'].'-'.$pd['day'].' '.str_pad($pd['hour'],2,"0",STR_PAD_LEFT).':'.str_pad($pd['minute'],2,"0",STR_PAD_LEFT).':'.str_pad($pd['second'],2,"0",STR_PAD_LEFT);
		$pp = new DateTime($paypal_time, new DateTimeZone("America/Los_Angeles")); //set the time zone to PDT
		$pp->setTimeZone(new DateTimeZone($sz)); //convert it back to server time zone
		$new_date = $pp->format('d-m-Y H:i:s T');
		return $new_date;
		
	}
?>
