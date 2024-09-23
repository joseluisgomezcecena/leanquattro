<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('fetch_odoo_workorders')) 
{

    function fetch_odoo_workorders()
    {
        $url = 'https://avanti-manufacturing.odoo.com/jsonrpc'; // Replace with your Odoo instance URL
        $db = 'avanti-manufacturing'; // Replace with your Odoo database name
        $username = 'jose.gomez@avantimanufacturing.com'; // Replace with your Odoo username
        $password = '2024Avanti!'; // Replace with your Odoo password
        $api_key = '3b832e3f6abbd1ed31177f8411aef7f06b0eca5e'; // Replace with your Odoo API key

        // Prepare the payload for the JSON-RPC request
        $payload = json_encode([
            'jsonrpc' => '2.0',
            'method' => 'call',
            'params' => [
                'service' => 'common',
                'method' => 'login',
                'args' => [$db, $username, $password]
            ],
            'id' => uniqid()
        ]);

        // Initialize cURL
        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Execute the request
        $response = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
            return [];
        } else {
            // Parse the response
            $result = json_decode($response, true);
            if (isset($result['result'])) {
                $uid = $result['result'];

                // Now you can use the uid to make further requests to fetch data
                // Example: Fetching manufacturing orders
                $payload = json_encode([
                    'jsonrpc' => '2.0',
                    'method' => 'call',
                    'params' => [
                        'service' => 'object',
                        'method' => 'execute_kw',
                        'args' => [
                            $db,
                            $uid,
                            $password,
                            'mrp.production', // Model name for manufacturing orders
                            'search_read',
                            [
                                [['state', 'in', ['confirmed', 'progress']]] // Search domain to filter by state
                            ],
                            ['fields' => ['name', 'product_id', 'state']] // Add the fields you want to fetch
                        ]
                    ],
                    'id' => uniqid()
                ]);

                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                $response = curl_exec($ch);

                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                    return [];
                } else {
                    $result = json_decode($response, true);
                    if (isset($result['result'])) {
                        // Process the fetched data
                        $work_orders = [];
                        foreach ($result['result'] as $order) {
                            $work_orders[] = [
                                'id' => $order['id'],
                                'name' => $order['name'],
                                'product_id' => $order['product_id'][0],
                                'product_name' => $order['product_id'][1],
                                'state' => $order['state']
                            ];
                        }
                        return ['work_orders' => $work_orders];
                    } else {
                        echo 'Error: ' . json_encode($result['error']);
                        return [];
                    }
                }
            } else {
                echo 'Error: ' . json_encode($result['error']);
                return [];
            }
        }

        // Close cURL
        curl_close($ch);
    }


}