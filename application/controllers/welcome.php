<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();
		$this->load->library('generate_json');
		$this->generate_json->generate_json();
	}
	
	
	function index()
    {
  		
		$data['rightViews'] = array('v_factuur');

		//$data['generalinfo'] = $this->M_airports->getAirportinfo();
	//	$data['rates'] = $this->M_airports->getavg();
	//	$data['total']	= $this->count();
		//$data['totalrates'] = $this->load->view('v_count');
	//	$data['airportbanner'] = $this->M_airports->getAirportbanner();
        $this->load->view('template_all', $data);
        	
    }
	
	 function get_price(){
		$this->load->model('M_factuur');
		$prijs = $this->M_factuur->get_price();
		echo $prijs['prijs'];
    }
    function factureer() {
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		
		if(isset($_POST['send'])){
		// eerste manier 
	//	print_r($_POST['code']);
    	// tweede manier
    	   $code = $_POST['code'];
		    $n = count($_POST['code']);
		   echo $n;
		  for ($i = 0; $i < $n; $i++) {
		      echo $code[$i]."<br/>";
		   }

		} 
	}
}
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
?>