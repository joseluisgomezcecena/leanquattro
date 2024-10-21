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
            log_message('error', 'Email configuration is not loaded correctly.');
            return; // Stop execution if configuration is not loaded
        }

        // Load the email library with the configuration
        $CI->load->library('email', $config);
        
        // Set email data
        $CI->email->from('jose.gomez@avantimanufacturing.com', 'Andon System');

        
        foreach ($recipient_email as $member) {
            $CI->email->to($member['email']);
        }
        
        
        //$CI->email->to($recipient_email); // Set the recipient email address
        
        $CI->email->subject('Nueva alerta de Andon');
        
        // Attach the image for inline display
        $CI->email->attach($image_path, 'inline', null, '', true);
        $htmlContent = 'Se ha creado una nueva alerta de Andon. Por favor revisa el sistema para más detalles.<br>';
        $htmlContent .= '<img src="' . $image_path . '" alt="Image">'; // Direct path usage might not work as expected for email clients

        $CI->email->message($htmlContent);

        // Send the email
        if (!$CI->email->send()) {
            // Email not sent
            log_message('error', 'Email not sent. ' . $CI->email->print_debugger());
            // Debugging: Print the loaded configuration
            print_r($config);
        } else {
            // Email sent successfully
            $CI->session->set_flashdata('success', 'Andon creado correctamente');
            echo 'Email sent successfully.';
        }
    }
}