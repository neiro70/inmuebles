<?php
class MySQL{
	private $conexion;
	private $total_consultas;
	 function __construct($schema="") {

		if (! isset ( $this->conexion )) {
			
			//$schema="xtc";
			//$schema="gasweb";
			// Create connection
			$this->conexion = new mysqli("localhost", "dratlcom_user", "123456789", "dratlcom_gasweb");
			//$this->conexion = new mysqli("localhost", "root", "admin", "gasweb");
			//$this->conexion = new mysqli("localhost", "id7242210_root", "admin", "id7242210_gasweb");
			//mysql_query("SET NAMES 'utf8'");
			// Check connection
			if ($this->conexion->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
				

		}
	}
	

	
	public function getConexion() {
		return $this->conexion;
	}

	
	public function closeSession(){
		$this->conexion->close();
	}

	
	
	
	
}
?>