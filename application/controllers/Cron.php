<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        
        $this->load->helper('send_email_helper'); // Load the send_email_helper.

        // Only allow this controller to be accessed via CLI or specific IP
        if (!is_cli() && !in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '192.168.1.65'])) {
            show_error('Direct access not allowed');
            exit;
        }
    }
    
    public function run_task() {
        $this->load->helper('file');

        $date_now = date('Y-m-d H:i:s');

        //get andon_events
        $unsolved_andon_events = $this->Andon_model->get_unsolved_andons();

        if (count($unsolved_andon_events) > 0) {
           
            foreach ($unsolved_andon_events as $andon_event) {
                
                $recipients = array();
                
                $andon_date = $andon_event['created_at'];
                //get the difference in minutes
                $diff = abs(strtotime($date_now) - strtotime($andon_date));
                $minutes = round($diff / 60);




                 //get team by alert.
                $teams = $this->Teams_model->get_team_by_alert($andon_event['alert_id']);






                if (count($teams)> 0)
                {
                    
                    if ($minutes >= 5 && $minutes < 30)
                    {
                        foreach ($teams as $team)
                        {
                            if ($team['escalation_1'] == 1)
                            {
                                $andon_message_data = $this->Andon_model->get_andon_message_for_email($andon_event['andon_id']);
                                //get team members for each team.
                                $team_members = $this->Teams_model->get_team_members($team['team_id']);
                                //$recipients = array_merge($recipients, $team_members);
                                foreach ($team_members as $member) {
                                    $recipients[] = $member['email'];
                                }

                                send_andon_email($recipients, $andon_message_data, 'assets/images/default_images/leanquattro_logo.png');

                            }
                        }
                    }
                    elseif ($minutes >= 30 && $minutes < 60)
                    {
                        foreach ($teams as $team)
                        {
                            if ($team['escalation_2'] == 1)
                            {

                            }
                        }
                    }
                    elseif ($minutes >= 60 && $minutes < 120)
                    {
                        foreach ($teams as $team)
                        {
                            if ($team['escalation_3'] == 1)
                            {

                            }
                        }
                    }
                    elseif ($minutes >= 120)
                    {
                        foreach ($teams as $team)
                        {
                            if ($team['escalation_4'] == 1)
                            {

                            }
                        }
                    }

                }

                
                


            }
        
        }
        

        
        // Your task logic here
        $result = "Task executed at " . date('Y-m-d H:i:s') . "\n";
        
        // Optional: Log the execution
        write_file(APPPATH . 'logs/cron_' . date('Y-m-d') . '.log', $result, 'a+');
        
        if (is_cli()) {
            echo $result;
        } else {
            echo json_encode(['status' => 'success', 'message' => $result]);
        }
    }
}
