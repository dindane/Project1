<?php
class M_factuur extends Model
{

    function __construct()    {
        parent::Model();
    }
    
    function get_price() { 		
	   	$formun = $this->input->post('code');
    	$this->db->select('prijs');
    	$this->db->from('products');
    	$this->db->where('code', $formun);
    	$sql = $this->db->get();
		if ($sql->num_rows() > 0) {
			
			foreach($sql->result_array() as $row){
				$data = array(
				"prijs" => $row['prijs']
				);	
			}//end foreach	
			return $data;
		}
    }    
}
?>