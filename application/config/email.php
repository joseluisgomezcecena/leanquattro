<?php
defined('BASEPATH') OR exit('No direct script access allowed');



$config = array(
    'protocol' => 'smtp',
    'smtp_host' => 'smtp.hostinger.com',
    'smtp_user' => 'jose.gomez@avantimanufacturing.com',
    'smtp_pass' => 'joseLuis15!@#',
    'smtp_port' => 465,
    'mailtype' => 'html',
    'charset' => 'utf-8', // Character set
    'newline' => "\r\n", // Newline character (required for some servers)
    'smtp_timeout' => 30, // SMTP Timeout in seconds
    'wordwrap' => TRUE, // TRUE or FALSE (boolean)    // other configurations...
    'smtp_crypto' => 'ssl'
    
    // other configurations...
);