<?php
	/**
	 * Conexion a mysql 
	 */
	class ModelMysql
	{
		private function connect(){
			$mysqli = new mysqli("XXXXXXXxxx", "xxxx", "xxxxx", "xxxxxx");
			if ($mysqli->connect_errno) {
			    return "Error Conexion";
			}
			return $mysqli;
		} 
		public function PostData($nombre, $temp, $Agencia){
			date_default_timezone_set('America/Mexico_City');
			$link = $this->connect();
			$hoy = date("d-m-Y");
			$hora = date("H:i:s");
			if($link == "Error Conexion"){
				return "Error de Conexion a la base de datos";
			}
			$insert = "INSERT INTO table(nombre, temperatura, fecha, hora,Agencia) 
				VALUES ( '".$nombre."', '$temp', '$hoy', '$hora','$Agencia')";
				$query = $link->query($insert);
				if($query){
					return "succefull";
				}else{
					return "Error";
				}
		}
		public function selectDate($date){
			$array = array();
			$link = $this->connect();
			$select = "";
			if($date === "todo")
				$select = "SELECT * from table ";
			else
				$select = "SELECT * from table where fecha like '%$date%' ";
			$query = $link->query($select);
			while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
				$array[] = array(
					'id' => $row['id'],
					'nombre' => $row['nombre'],
					'temperatura' => $row['temperatura'],
					'fecha' => $row['fecha'],
					'hora' => $row['hora'],
					'Agencia' => $row['Agencia']
				);
			}
			return $array;
		}
	}
?>