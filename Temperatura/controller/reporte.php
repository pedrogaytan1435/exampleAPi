<?php
	require_once('../Model/Model.php');
	$MODEL = new ModelMysql();
	date_default_timezone_set('America/Mexico_City');
	$hoy = date("d-m-Y");
	$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$url = explode( '/', $url );
	$value = $url[4] != null ? $url[4] : $hoy;
	$values = "";
	if(count($url) > 5)
		$values = $url[5];
	$result = $MODEL->selectDate($value);
	if(count($result) > 0){
		if($values === "Json" || $values === "JSON" || $values === "json"){
			echo json_encode($result);
		}else{
			generateCSV($result);
		}
	}
	else
		echo "<h2>No existen registros con la fecha $value</h2>";
	//generar csv/
	function generateCSV($result){
		$filename = "registro.csv";
		$file = fopen('php://memory', 'w');
		$fields = array(
			'NOMBRE',
			'TEMPERATURA',
			'FECHA',
			'HORA',
			'AGENCIA',
		);
		//header
	    fputcsv($file, $fields);
	    //body
	    foreach ($result as $value) {
	    	fputcsv($file, array(
	    		$value['nombre'],
	    		$value['temperatura'],
	    		$value['fecha'],
	    		$value['hora'],
	    		$value['Agencia'],
	    	));
	    }
	    fseek($file, 0);
	    header('Content-Type: application/csv');
	    header('Content-Disposition: attachment; filename="'.$filename.'";');
	    fpassthru($file);
	    exit;
	}
?>