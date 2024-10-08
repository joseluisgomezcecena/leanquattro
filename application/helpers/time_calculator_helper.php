<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Calculates the time difference between now and a given date-time.
 *
 * @param string $dateTime The date-time in the format 'Y-m-d H:i:s'.
 * @return float The time difference in hours with up to 2 decimal places.
 */
if (!function_exists('calculateTime')) 
{
    function calculateTime($dateTime) {
        // Convert the given date-time string to a DateTime object
        $givenDateTime = new DateTime($dateTime);

        // Get the current time as a DateTime object
        $currentDateTime = new DateTime();

        // Calculate the difference between the current time and the given date-time
        $interval = $currentDateTime->diff($givenDateTime);

        // Convert the difference to hours
        $hours = $interval->days * 24 + $interval->h + ($interval->i / 60) + ($interval->s / 3600);

        // Format the result to 2 decimal places
        return number_format($hours, 2);
    }
}
/*
    Example usage
    $dateTime = '2023-10-01 12:00:00';
    echo calculateTimeDifferenceInHours($dateTime);
*/