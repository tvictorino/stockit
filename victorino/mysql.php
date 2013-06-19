<?

require_once '../config.php';

class Mysql(){


	private $con;

	function __construct(){
		$this->con = new mysqli($db['host'], $db['user'], $db['password'], $db['db'], $db['port']);
		if ($this->con->connect_errno) {
		    die("Failed to connect to MySQL: (" . $this->con->connect_errno . ") " . $this->con->connect_error);
		}
	}

	function __destruct(){
		$this->con->close();
	}

	public function query($sql){
		if ($result = mysqli_query($sql)) {

			print_r($result);


		    $result->close();
		}else{
			die("Error: ".$this->con->error);
		}
	}
}

?>