<?php
	$connection = mysql_connect('localhost', 'eques_equesz', 'barca!') or die("please contact support@exploremyblog.com!");
	mysql_select_db("eques_kassa", $connection);
	
		if(isset($_POST['queryString'])) {
			$queryString = $_POST['queryString'];		
			if(strlen($queryString) >0) {
				$query = "SELECT klantnaam, klantachternaam FROM klanten WHERE klantnaam LIKE '$queryString%' OR klantachternaam LIKE '$queryString%'";
				$result = mysql_query($query) or die("There is an error in database please contact support@ExploreMyBlog.Com");
					if(mysql_num_rows($result) != 0){
						while($row = mysql_fetch_array($result)){
						echo '<li onClick="fill(\''.$row['klantnaam']." ".$row['klantachternaam'].'\');">'.$row['klantnaam']." ".$row['klantachternaam'].'</li>';    
	     				}
	  				}else{
	  					echo "Sorry, de opgegeven klant bestaat niet.";
	  				}
			  }
	  }
?>