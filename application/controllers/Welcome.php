<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function check()
	{
	$booking 	    = file_get_contents('json/bookings.json');
	$booking_data   = json_decode($booking,true);

	$date			=	$_POST['date'];
	$time 			=   strtotime($date);
	$newformat 		=   date('Y-m-d',$time);

	 
		foreach ($booking_data as $key => $value) {
			if (strpos($value['start_time'], $newformat) !== false) {
				echo "Booking ID = ".$value['booking_id']."</br>"; 
				$data['booking_id']   =  $value['booking_id'];
				
				//echo "Cleaner ID = ".$value['cleaner_id']."</br>";
				$data['cleaner_id']   =  $value['cleaner_id'];
				
				echo "Start Time = ".$value['start_time']."</br>";
				$data['start_time']   =  $value['start_time'];
				
				echo "Duration = ".$value['duration']." Hours</br>";
				$data['duration']  	  =  $value['duration'];

				$this->load->view('checkbox',$data);

			}
			
		}
		echo "<h2>Chose a Cleaner : </h2></br>";
	}

	public function check_cleaner()
	{
		
		$availabilities = file_get_contents('json/availabilities.json');
		$available_data = json_decode($availabilities,true);
	
		if (!empty($_POST['cleaner_id'])) {
			$cleaner = $this->input->post('cleaner_id');

			foreach ($available_data as $key => $value_data) {
				if ($value_data['cleaner_id'] == $cleaner) {
					
					$timefrom =  strtotime($value_data['hour_from']);
					$timeto   =  strtotime($value_data['hour_to']);
					$tNow	  =  $timefrom;
					$days = array(
							    1 => 'Monday',
							    2 => 'Tuesday',
							    3 => 'Wednesday',
							    4 => 'Thursday',
							    5 => 'Friday',
							    6 => 'Saturday',
							    7 => 'Sunday'
							);
					$data['days']			= $days;
					$data['timeto']         = $timeto;
					$data['timefrom']       = $timefrom;
					$data['cleaner_id']  	= $value_data['cleaner_id'];
					$data['week_day']		= $value_data['week_day'];
					$data['hour_from']		= $value_data['hour_from'];
					$data['hour_to']		= $value_data['hour_to'];
					

					$this->load->view('dates',$data);		
					
				}
			}
		echo "<h3>Chose one of the available dates : </h3></br>";

		}
		
	}
}
