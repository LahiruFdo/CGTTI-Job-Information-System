<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "cgtti";

	
	// Check connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    }

    class DatabaseCon{
		private $query;
		private $con;
	    
		public function __construct($con){
			$this->con = $con;
		}

		public function getConnection($string){
			$this->query = $string;
			return mysqli_query($this->con,$this->query);
		}

		public function getRowCount($result){
			return mysqli_num_rows($result);
		}

		public function getoutput($result){
			return mysqli_fetch_assoc($result);
		}
	}

	//to get the job type
	function get_jt($j){
		$type = "Private Job";
		switch($j){
			case "BJ": $type = "Bus Jobs"; break;
			case "VM": $type = "Vehicle Maintain"; break;
			case "M": $type = "Institute Maintainance"; break;
			case "TRG": $type = "Training (Full Time)"; break;
			case "PRG": $type = "Training (Part Time)"; break;
			case "PR": $type = "Production"; break;
			case "STC": $type = "Special Training Course"; break;
			case "VTI": $type = "Borella Institute"; break;
			case "DP": $type = "Director Bunglow"; break;
		}
		return $type;
	}
?>