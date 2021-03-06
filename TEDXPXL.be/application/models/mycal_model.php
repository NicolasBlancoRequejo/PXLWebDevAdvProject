<?php 
	class mycal_model extends CI_Model {
		
		var $conf;
		
		function mycal_model() {
			parent::__construct();
			
			$this->conf = array(
			'show_next_prev'=>TRUE,
			'next_prev_url'=>base_url().'mycal/showcal',
			'start_day' => 'monday'
			);
			
			$this->conf['template'] = '
			
			{table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}
			
			{heading_row_start}<tr class="heading">{/heading_row_start}
			
			{heading_previous_cell}<th class="neprcell"><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_title_cell}<th class="title" colspan="{colspan}">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th class="neprcell"><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
			
			{heading_row_end}</tr>{/heading_row_end}
			
			{week_row_start}<tr>{/week_row_start}
			{week_day_cell}<td class="weekdays">{week_day}</td>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}
			
			{cal_row_start}<tr class="days">{/cal_row_start}
			{cal_cell_start}<td class="day">{/cal_cell_start}
			{cal_cell_start_today}<td class="today day">{/cal_cell_start_today}
			{cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}
			
			{cal_cell_content}
			<div class="day_num">{day}</div>
			<div class="content">{content}</div>
			{/cal_cell_content}
			{cal_cell_content_today}
			<div class="day_num highlight">{day}</div>
			<div class="content">{content}</div>
			{/cal_cell_content_today}
			
			{cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}
			
			{cal_cell_blank}&nbsp;{/cal_cell_blank}
			
			{cal_cell_other}{day}{cal_cel_other}
			
			{cal_cell_end}</td>{/cal_cell_end}
			{cal_cell_end_today}</td>{/cal_cell_end_today}
			{cal_cell_end_other}</td>{/cal_cell_end_other}
			{cal_row_end}</tr>{/cal_row_end}
			
			{table_close}</table>{/table_close}
			';
		}
		
		function get_calendar_data($year, $month) {
			$query = $this->db->select('naam, datum')->from('events')
			->like('datum', "$year-$month", 'after')->get();
			
			$cal_data = array();
			
			foreach($query->result() as $row) {
				$cal_data[substr($row->datum,8,2)] = $row->naam;
			}
			
			return $cal_data;
			
		}
		
		function add_calendar_data($date, $data) {
			if ($this->db->select('date')->from('calendar')
			->where('date', $date)->count_all_results()) {
				
				$this->db->where('date', $date)
				->update('calendar', array(
				'date' => $date,
				'data' => $data
				));
				
				} else {
				
				$this->db->insert('calendar', array(
				'date' => $date,
				'data' => $data
				));
			}
		}
		
		function fill_edit_form($naam) {
			$this->db->select('naam, beginuur, einduur, commentaar');			
			$this->db->from('events');
			$this->db->where('naam', $naam);
			
			$query = $this->db->get();
			
			if ( $query->num_rows() > 0 )
			{
				$row = $query->row_array();
				return $row;
			}
		}
		
		function edit_calendar_data($naam = array()) {
			$this->db->where($naam);
			$this->db->update('events'/*, $data*/);
		}
		
		function delete_calendar_data($naam = array()) {				
			$this->db->where($naam);
			$this->db->delete('events'); 
			
			redirect('mycal/showcal');
		}
		
		function generate($year, $month) {
			
			$this->load->library('calendar',$this->conf);
			
			$cal_data = $this->get_calendar_data($year, $month);
			
			return $this->calendar->generate($year, $month, $cal_data);			
			
		}
		
		function get_comment($naam) {			
			$this->db->select('commentaar');			
			$this->db->from('events');			
			$this->db->where('naam', $naam );
			
			$query = $this->db->get();
			
			if ( $query->num_rows() > 0 )
			{
				$row = $query->row_array();
				return $row;
			}
		}   
		
		function get_starttime($naam) {			
			$this->db->select('beginuur');			
			$this->db->from('events');			
			$this->db->where('naam', $naam );
			
			$query = $this->db->get();
			
			if ( $query->num_rows() > 0 )
			{
				$row = $query->row_array();
				return $row;
			}
		}  
		
		function get_endtime($naam) {			
			$this->db->select('einduur');			
			$this->db->from('events');			
			$this->db->where('naam', $naam );
			
			$query = $this->db->get();
			
			if ( $query->num_rows() > 0 )
			{
				$row = $query->row_array();
				return $row;
			}
		}  
		
		function get_location($naam) {			
			$this->db->select('locatie');			
			$this->db->from('events');			
			$this->db->where('naam', $naam );
			
			$query = $this->db->get();
			
			if ( $query->num_rows() > 0 )
			{
				$row = $query->row_array();
				return $row;
			}
		}  
	}			