<?php
    header('Content-Type: application/json');
	require_once('../Model/Model.php');
	$MODEL = new ModelMysql();
	$USER = utf8_decode($_POST['user']);
	$TEMP = $_POST['temp'];
	$AGEN = $_POST['suc'];
	$result = $MODEL->PostData($USER, $TEMP, $AGEN);
	$Messenge = "Guardado";
	if($result != "succefull"){
		$result = "Error";
		$Messenge = "Error de Conexión";
	}
	$Json = array(
		'status' => $result,
		'Messenge' => $Messenge 
	);
	echo json_encode($Json);
?>