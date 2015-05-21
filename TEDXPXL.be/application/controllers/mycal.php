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
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->load->helper('url');
			
			$data['calendar'] = $this->mycal_model->generate($year, $month);		
			
			//set validation rules
			$this->form_validation->set_rules('naam', 'Naam', 'required');
			$this->form_validation->set_rules('beginuur', 'Beginuur', 'required');
			$this->form_validation->set_rules('einduur', 'Einduur');
			$this->form_validation->set_rules('commentaar', 'Commentaar');
			$this->form_validation->set_rules('autocomplete', 'Locatie');
			
			if ($this->form_validation->run() == FALSE)
			{
				//fail validation
				$this->load->view('mycal_view', $data);
			}
			else
			{    
				//pass validation
				$day = $this->input->post('datum');
				$data = array(
				'naam' => $this->input->post('naam'),
				'datum' => "$year-$month-$day",
                'beginuur' => $this->input->post('beginuur'),
                'einduur' => $this->input->post('einduur'),
                'commentaar' => $this->input->post('commentaar'),
				'locatie' => $this->input->post('autocomplete')
				);
				
				//insert the form data into database
				$this->db->insert('events', $data);
				redirect($this->uri->uri_string());
			}
			
		}
		
		function editEvent() {
			/*$naam = $this->input->get('eventp');
			$naam = "PXL breekt uit";
			$this->load->model("mycal_model");
			$returned = $this->mycal_model->fill_edit_form($naam);
			//echo json_encode($returned);
			foreach ($returned->result() as $row) {
				$naam = $row->naam;
				$beginuur = $row->beginuur;
				$einduur = $row->einduur;
				$commentaar = $row->commentaar;
			}
			$data['editNaam'] = array('value' => set_value('editNaam', $naam));
			$data['editBeginuur'] = array('value' => set_value('editBeginuur', $beginuur));
			$data['editEinduur'] = array('value' => set_value('editEinduur', $einduur));
			$data['editCommentaar'] = array('value' => set_value('editCommentaar', $commentaar));
			
			$this->load->view('mycal_view', $data);
			*/
			
			$naam = urldecode(func_get_args()[0]);
			$this->load->model("mycal_model");
			$data = array();
			$data['naam'] = $this->mycal_model->fill_edit_form($naam)["naam"];
			$data['beginuur'] = $this->mycal_model->fill_edit_form($naam)["beginuur"];
			$data['einduur'] = $this->mycal_model->fill_edit_form($naam)["einduur"];
			$data['commentaar'] = $this->mycal_model->fill_edit_form($naam)["commentaar"];
			$this->load->view("fillform.php", $data);
		}
		
		function delEvent() {
			$naam = $this->input->post('delNaam');
			$where = array('naam' => $naam);
			$this->load->model("mycal_model");
			$this->mycal_model->delete_calendar_data($where);
		}
		
		function getComment() {			
			$naam = urldecode(func_get_args()[0]);
			$this->load->model("mycal_model");
			$tekst = $this->mycal_model->get_comment($naam)["commentaar"];
			$this->load->view("toon.php", array("tekst"=>$tekst));
		}
		
		function getStartTime() {			
			$naam = urldecode(func_get_args()[0]);
			$this->load->model("mycal_model");
			$tekst = $this->mycal_model->get_starttime($naam)["beginuur"];
			$this->load->view("toonbeginuur.php", array("tekst"=>$tekst));
		}
		
		function getEndTime() {			
			$naam = urldecode(func_get_args()[0]);
			$this->load->model("mycal_model");
			$tekst = $this->mycal_model->get_endtime($naam)["einduur"];
			$this->load->view("tooneinduur.php", array("tekst"=>$tekst));
		}
		
		function getLocation() {			
			$naam = urldecode(func_get_args()[0]);
			$this->load->model("mycal_model");
			$tekst = $this->mycal_model->get_location($naam)["locatie"];
			$this->load->view("toonlocatie.php", array("tekst"=>$tekst));
		}
		
	}				