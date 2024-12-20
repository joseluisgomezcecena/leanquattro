<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('send_andon_email')) {
    function send_andon_email($recipient_email, $message, $image_path)
    {
        // Get the CodeIgniter instance
        $CI =& get_instance();

        // Load the email configuration
        $CI->load->config('email', TRUE);
        $config = $CI->config->item('email');

        // Make sure $config is not null
        if ($config === NULL) {
            echo  'Email configuration is not loaded correctly.';
            return; // Stop execution if configuration is not loaded
        }

        // Load the email library with the configuration
        $CI->load->library('email', $config);
        
        // Set email data
        $CI->email->from('jose.gomez@avantimanufacturing.com', 'Andon System');

        // Debugging: Print the recipient email array
        echo "recipient array: ". print_r($recipient_email, true);

        // Extract emails and add them to the email library
        foreach ($recipient_email as $email)
        {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $CI->email->to($email);
            } else {
                // Debugging: Print the problematic email
                echo "Invalid email: " . $email;
                continue; // Skip this email
            }
        }
        
        $CI->email->subject('Nueva alerta de Andon');
        
        // Attach the image for inline display
        $CI->email->attach($image_path, 'inline', null, '', true);
        $htmlContent = 'Alerta Andon en ' . $message['plant_name'] . ', ' . $message['line_name'] . ', ' . $message['work_station_name'] . ' ';
        $htmlContent .= '<p>Alerta: ' . $message['alert_name'] . '</p>';
        $htmlContent .= '<p>Descripción: ' . $message['alert_description'] . '</p>';
        $htmlContent .= '<p>Tipo: ' . $message['child_alert_name'] . '</p>';
        
        $htmlContent .= '<p> Fecha de Reporte:' . $message['created_at'] . '</p>';
        
        $htmlContent .= '<br/>. Por favor revisa el sistema para más detalles.<br>';
        //$htmlContent .= '<img src="' . $image_path . '" alt="Image">'; // Direct path usage might not work as expected for email clients

        $CI->email->message($htmlContent);

        // Send the email
        if (!$CI->email->send()) {
            // Email not sent
            echo "not sent:" . $CI->email->print_debugger();
            // Debugging: Print the loaded configuration
            echo "config:" . print_r($config, true);
            
        } else {
            // Email sent successfully
            $CI->session->set_flashdata('success', 'Andon creado correctamente');
            echo 'Email sent successfully.';
        }
    }
}