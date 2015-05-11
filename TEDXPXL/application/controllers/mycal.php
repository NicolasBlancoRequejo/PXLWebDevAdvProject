<?php 
	class mycal extends CI_Controller {
			
		function showcal($year = null, $month = null) {
		
			if (!$year) {
				$year = date('Y');
			}
			
			if (!$month) {
				$month = date('m');
			}
			
			$this->load->model('mycal_model');
			
			if ($day = $this->input->post('day')) {
				$this->mycal_model->add_calendar_data(
					"$year-$month-$day",
					$this->input->post('data')
				);
			}
			
			$data['calendar'] = $this->mycal_model->generate($year, $month);		
			
			$this->load->view('mycal_view', $data);
			
		}
	}	