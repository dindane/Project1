<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	
	<title>Factuur</title>
		<link href="../styles/default.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="../styles/jquery.autocomplete.css" />
		<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="../js/factuur.js"></script>
		<script type='text/javascript' src='../js/jquery.autocomplete.js'></script>

</head>

<body>
				<?php foreach($rightViews as $itemR):?>
					<?php $this->load->view($itemR); ?>
				<?php endforeach;?>
</body>

</html>