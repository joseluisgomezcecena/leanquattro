<?php




   
//3b832e3f6abbd1ed31177f8411aef7f06b0eca5e
   

class Integrations extends CI_Controller
{

    public function __construct() {
        parent::__construct();
        //$this->load->model('Integration_model');
    }


    public function fetch_odoo_data()
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
    } else {
        // Parse the response
        $result = json_decode($response, true);
        if (isset($result['result'])) {
            $uid = $result['result'];

            // Now you can use the uid to make further requests to fetch data
            // Example: Fetching partners
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
                        'res.partner',
                        'search_read',
                        [[]], // Add your search domain here
                        ['fields' => ['name', 'email']] // Add the fields you want to fetch
                    ]
                ],
                'id' => uniqid()
            ]);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            } else {
                $result = json_decode($response, true);
                if (isset($result['result'])) {
                    // Handle the fetched data
                    print_r($result['result']);
                } else {
                    echo 'Error: ' . json_encode($result['error']);
                }
            }
        } else {
            echo 'Error: ' . json_encode($result['error']);
        }
    }

    // Close cURL
    curl_close($ch);
}



public function fetch_odoo_wo()
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
            } else {
                $result = json_decode($response, true);
                if (isset($result['result'])) {
                    // Handle the fetched data
                    print_r($result['result']);
                } else {
                    echo 'Error: ' . json_encode($result['error']);
                }
            }
        } else {
            echo 'Error: ' . json_encode($result['error']);
        }
    }

    // Close cURL
    curl_close($ch);
}


public function fetch_odoo_workorders()
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





public function fetch_odoo_workorders_qty()
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
                        ['fields' => ['name', 'product_id', 'state', 'product_qty']] // Add the fields you want to fetch
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
                            'state' => $order['state'],
                            'quantity' => $order['product_qty'] // Add the quantity field
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



// NEW WITH OPERATIONS


public function fetch_odoo_workorders_qty2()
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
                        ['fields' => ['name', 'product_id', 'state', 'product_qty']] // Add the fields you want to fetch
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
                        // Fetch operations for each work order
                        $operations = $this->fetch_operations_for_workorder($db, $uid, $password, $order['id']);

                        $work_orders[] = [
                            'id' => $order['id'],
                            'name' => $order['name'],
                            'product_id' => $order['product_id'][0],
                            'product_name' => $order['product_id'][1],
                            'state' => $order['state'],
                            'quantity' => $order['product_qty'], // Add the quantity field
                            'operations' => $operations // Add the operations field
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

private function fetch_operations_for_workorder($db, $uid, $password, $workorder_id)
{
    $url = 'https://avanti-manufacturing.odoo.com/jsonrpc'; // Replace with your Odoo instance URL

    // Prepare the payload for the JSON-RPC request to fetch operations
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
                'mrp.workorder', // Model name for work orders
                'search_read',
                [
                    [['production_id', '=', $workorder_id]] // Search domain to filter by work order ID
                ],
                ['fields' => ['name', 'workcenter_id', 'state', 'duration_expected']] // Add the fields you want to fetch
            ]
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
            // Process the fetched data
            $operations = [];
            foreach ($result['result'] as $operation) {
                $operations[] = [
                    'id' => $operation['id'],
                    'name' => $operation['name'],
                    'workcenter_id' => $operation['workcenter_id'][0],
                    'workcenter_name' => $operation['workcenter_id'][1],
                    'state' => $operation['state'],
                    'duration_expected' => $operation['duration_expected']
                ];
            }
            return $operations;
        } else {
            echo 'Error: ' . json_encode($result['error']);
            return [];
        }
    }

    // Close cURL
    curl_close($ch);
}





//NEW WITH OPERATIONS





    public function odoo()
    {
        $data = $this->fetch_odoo_workorders_qty();

        // Load the view
        $this->load->view('integrations/odoo', $data);

    }

    public function odoo2() {
        // Load the model if the method is in a model
        // $this->load->model('Your_model_name');

        // Fetch work orders and their operations
        $data = $this->fetch_odoo_workorders_qty4();

        // Pass data to the view
        $this->load->view('integrations/odoo2', $data);
    }


    public function fetch_odoo_workorders_qty3()
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
                            ['fields' => ['name', 'product_id', 'state', 'product_qty']] // Add the fields you want to fetch
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
                            // Fetch operations for each work order
                            $operations = $this->fetch_operations_for_workorder2($db, $uid, $password, $order['id']);
    
                            $work_orders[] = [
                                'id' => $order['id'],
                                'name' => $order['name'],
                                'product_id' => $order['product_id'][0],
                                'product_name' => $order['product_id'][1],
                                'state' => $order['state'],
                                'quantity' => $order['product_qty'], // Add the quantity field
                                'operations' => $operations // Add the operations field
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
    
    private function fetch_operations_for_workorder2($db, $uid, $password, $workorder_id)
    {
        $url = 'https://avanti-manufacturing.odoo.com/jsonrpc'; // Replace with your Odoo instance URL
        $api_key = '3b832e3f6abbd1ed31177f8411aef7f06b0eca5e'; // Replace with your Odoo API key
    
        // Prepare the payload for the JSON-RPC request to fetch operations
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
                    'mrp.workorder', // Model name for work orders
                    'search_read',
                    [
                        [['production_id', '=', $workorder_id]] // Search domain to filter by work order ID
                    ],
                    ['fields' => ['name', 'workcenter_id', 'state', 'duration_expected']] // Add the fields you want to fetch
                ]
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
                // Process the fetched data
                $operations = [];
                foreach ($result['result'] as $operation) {
                    $operations[] = [
                        'id' => $operation['id'],
                        'name' => $operation['name'],
                        'workcenter_id' => $operation['workcenter_id'][0],
                        'workcenter_name' => $operation['workcenter_id'][1],
                        'state' => $operation['state'],
                        'duration_expected' => $operation['duration_expected']
                    ];
                }
                return $operations;
            } else {
                echo 'Error: ' . json_encode($result['error']);
                return [];
            }
        }
    
        // Close cURL
        curl_close($ch);
    }



public function fetch_odoo_workorders_qty4()
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
                        ['fields' => ['name', 'product_id', 'state', 'product_qty']] // Add the fields you want to fetch
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
                        // Fetch operations for each work order
                        $operations = $this->fetch_operations_for_workorder4($db, $uid, $password, $order['id']);

                        $work_orders[] = [
                            'id' => $order['id'],
                            'name' => $order['name'],
                            'product_id' => $order['product_id'][0],
                            'product_name' => $order['product_id'][1],
                            'state' => $order['state'],
                            'quantity' => $order['product_qty'], // Add the quantity field
                            'operations' => $operations // Add the operations field
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

private function fetch_operations_for_workorder4($db, $uid, $password, $workorder_id)
{
    $url = 'https://avanti-manufacturing.odoo.com/jsonrpc'; // Replace with your Odoo instance URL
    $api_key = '3b832e3f6abbd1ed31177f8411aef7f06b0eca5e'; // Replace with your Odoo API key

    // Prepare the payload for the JSON-RPC request to fetch operations
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
                'mrp.workorder', // Model name for work orders
                'search_read',
                [
                    [['production_id', '=', $workorder_id]] // Search domain to filter by work order ID
                ],
                ['fields' => ['name', 'workcenter_id', 'state', 'duration_expected', 'description']] // Add the fields you want to fetch
            ]
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
            // Process the fetched data
            $operations = [];
            foreach ($result['result'] as $operation) {
                $operations[] = [
                    'id' => $operation['id'],
                    'name' => $operation['name'],
                    'workcenter_id' => $operation['workcenter_id'][0],
                    'workcenter_name' => $operation['workcenter_id'][1],
                    'state' => $operation['state'],
                    'duration_expected' => $operation['duration_expected'],
                    'description' => $operation['description'] // Add the description field
                ];
            }
            return $operations;
        } else {
            echo 'Error: ' . json_encode($result['error']);
            return [];
        }
    }

    // Close cURL
    curl_close($ch);
}


    
}

