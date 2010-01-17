<?php
class Generate_json {
// verify user logged in or not
	function generate_json() {
		    $result = mysql_query("SELECT id, code,prijs, omschrijving FROM products" ) or die(mysql_error()); 
			$data = array();
		
		while($obj = mysql_fetch_object($result)) {
		 $arr['items'][] = $obj;
		}
		// echo json_encode($arr);
		
		$myFile = "./js/producten.js";
		$fh = fopen($myFile, 'w') or die("can't open file");
		$stringData = '{"channel":'.json_encode($arr).'}';	
		fwrite($fh, $stringData);
		fclose($fh);
	}
}
