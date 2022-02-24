<?php
	$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$url = explode( '/', $url );
	echo $_SERVER['REQUEST_URI']."  ".$url[2];
	$val = $url[3] != null ? $url[3] : $url[2];
	switch ($val) {
		case 'LaBarca':
			header('Location: http://localhost/Temperatura/view/');
		break;
		case 'reporte':
			$f = $url[4] != null ? $url[4] : null;
			header('Location: http://localhost/Temperatura/controller/reporte.php/'.$f);
		default:
			header('Location: http://localhost/Temperatura/view/');
		break;
	}
?>