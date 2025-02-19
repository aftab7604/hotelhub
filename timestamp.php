<?php

	if($_POST['type'] == 'variance') {
		$goal_time = $_POST['goal_time'];
		$clock_value = $_POST['clock_value'];

		// Convert times to DateTime objects
		$goal_time_obj = DateTime::createFromFormat('H:i:s', $goal_time);
		$clock_value_obj = DateTime::createFromFormat('H:i:s', $clock_value);
	
		if ($goal_time_obj && $clock_value_obj) {
			// Calculate the variance
			$interval = $clock_value_obj->diff($goal_time_obj);
			$variance = $interval->format('%H:%I:%S');
			
			// If clock value is ahead, make it negative
			if ($clock_value_obj > $goal_time_obj) {
				$variance = "-".$variance;
			}
		} else {
			$variance = "Invalid time format";
		}

		echo $variance;
	} else {
		$finish_time = new DateTime(gmdate('Y-m-d H:i:s', strtotime($_POST['tz'].' hours')));
	
		$dateStart		= new DateTime($_POST['started_at']);
		$dateEnd		= $finish_time;																	
		$dateDiff		= $dateStart->diff($dateEnd);
		$started_time	= $dateDiff->format("%H:%I:%S");
		echo $started_time;
	}
	