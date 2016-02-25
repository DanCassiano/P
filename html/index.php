<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title><?= $titulo ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?= $baseURL?>/assets/bootstrap/dist/css/bootstrap.min.css">
	<script type="text/javascript" src="<?= $baseURL?>/assets/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="<?= $baseURL?>/assets/bootstrap/dist/js/bootstrap.min.js"></script>
	<base href="<?= $baseURL?>"></base>
</head>
<body>
	<?php
		require "nav.php";
		require  "../view/" . $action . ".php";
	?>
</body>
</html>