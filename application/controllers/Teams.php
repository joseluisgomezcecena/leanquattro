<?php
class Teams extends MY_Controller
{

    public function index(){
        $data['active'] = 'teams';
        $data['title'] = ucfirst("Equipos de Soporte Andon"); // Capitalize the first letter
        $data['teams'] = $this->Teams_model->get_teams();
        

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('teams/index', $data);
        $this->load->view('_templates/footer');
    }



    public function create()
    {

        $data['active'] = 'teams';
        $data['title'] = ucfirst("Equipos de Soporte Andon"); // Capitalize the first letter
        $data['users'] = $this->User_model->get_users();

        //form validation.
        $this->form_validation->set_rules('team_name', 'Nombre del equipo', 'required');
        $this->form_validation->set_rules('team_description', 'Descripción del equipo', 'required');
        $this->form_validation->set_rules('leader', 'Líder del equipo', 'required');
        $this->form_validation->set_rules('member_id[]', 'Miembros del equipo', 'required');
        $this->form_validation->set_rules('team_plant', 'Planta del equipo', 'required');
        $this->form_validation->set_rules('team_line[]', 'Línea del equipo', 'required');

        //if form validation fails.
        if ($this->form_validation->run() == FALSE) 
        {
            // Display registration form with validation errors
            $data['plants'] = $this->Plants_model->get_plants();
            $data['lines'] = $this->ProductionLines_model->get_productionlines();
            $data['alerts'] = $this->Alert_model->get_alerts();


            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('teams/create', $data);
            $this->load->view('_templates/footer');
        } 
        else
        {
            $team_name = $this->input->post('team_name');
            $team_description = $this->input->post('team_description');
            $team_leader = $this->input->post('leader');
            $team_members = $this->input->post('member_id[]');
            $team_plant = $this->input->post('team_plant');
            $team_line = $this->input->post('team_line[]');
            $alerts = $this->input->post('alert_id[]');

            //checkboxes.
            $escalation_1 = $this->input->post('escalation_1') !== null ? 1 : 0;
            $escalation_2 = $this->input->post('escalation_2') !== null ? 1 : 0;
            $escalation_3 = $this->input->post('escalation_3') !== null ? 1 : 0;
            $escalation_4 = $this->input->post('escalation_4') !== null ? 1 : 0;



            //create team.
            $team_data = array(
                'team_name' => $team_name,
                'team_description' => $team_description,
                'escalation_1' => $escalation_1,
                'escalation_2' => $escalation_2,
                'escalation_3' => $escalation_3,
                'escalation_4' => $escalation_4,
            );
            $team_id = $this->Teams_model->create_team($team_data);
            


            //create team leader.
            $leader_data = array(
                'tu_team_id' => $team_id,
                'tu_user_id' => $team_leader,
                'team_leader' => 1
            );

            $team_leader = $this->Teams_model->create_team_leader($leader_data);
             

        

            //create team members.
            $team_members_data = array();
            foreach ($team_members as $member) {

                if ($member == $team_leader) {
                    continue;
                }

                else{
                    $team_members_data[] = array(
                        'tu_team_id' => $team_id,
                        'tu_user_id' => $member,
                        'team_leader' => 0
                    );
                }

            }

            $this->Teams_model->create_team_members($team_members_data);

        

            //create team location (line).
            foreach ($team_line as $line) {
                $team_line_data = array(
                    'tl_team_id' => $team_id,
                    'tl_line_id' => $line
                );

                $team_location = $this->Teams_model->create_team_location($team_line_data);
            }


            //create team alerts.
            $team_alerts_data = array();
            foreach ($alerts as $alert) {
                $team_alerts_data[] = array(
                    'ta_team_id' => $team_id,
                    'ta_alert_id' => $alert
                );
            }

            $this->Teams_model->create_team_alerts($team_alerts_data);
           
        
        
            $this->session->set_flashdata('success', 'Equipo creado correctamente.');
            redirect(base_url() . 'teams');
        }


    }


}