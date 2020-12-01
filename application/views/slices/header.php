<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<title>CASSI</title>

	<?php
		foreach($headers as $key => $header){
	?>
			<link href="<?php echo base_url('assets/css/'.$header.'.css')?>" rel="stylesheet">
	<?php	
		}

		if($js === 1){
	?>
	<link href="<?php echo base_url('assets/css/search_table.css')?>" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<?php
		}
	?>
</head>
<body>