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
    /*function generate_json() {
		    $result = mysql_query("SELECT id, code,prijs, omschrijving FROM products" ) or die(mysql_error()); 
			$data = array();
		
		while($obj = mysql_fetch_object($result)) {
		 $arr['items'][] = $obj;
		}
		 echo json_encode($arr);
		
		$myFile = "./js/producten.js";
		$fh = fopen($myFile, 'w') or die("can't open file");
		$stringData = '{"channel":'.json_encode($arr).'}';	
		fwrite($fh, $stringData);
		fclose($fh);
    }*/
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
?>