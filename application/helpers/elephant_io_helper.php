<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

if (!function_exists('send_alert')) {
    function send_alert($alert_id, $time)
    {
        $company_id = 77;

        $version = new Version2X('http://localhost:3001');
        //$version = new Version2X('http://192.168.1.65:3001');
        $client = new Client($version);
        $client->initialize();
        $client->emit(
            'newOrder',
            [
                'message' => 'Quattro Alert',
                'work_station_id' => $alert_id,
                'company_id' => $company_id,
                'time' => date('H:i:s')
            ]
        );
        $client->close();
    }
}