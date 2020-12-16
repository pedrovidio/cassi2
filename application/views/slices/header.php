<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
<?php
}
?>
</head>
<body>