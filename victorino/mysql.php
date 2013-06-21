<?

require_once 'config/general.php';

class Mysql {


	private $con;

	function __construct(){
		$db = array(
			'user'=>'root',
			'pass'=>'th14g0my',
			'host'=>'localhost',
			'port'=>'3306',
			'db' => 'mydb'

	);
		$this->con = new mysqli($db['host'], $db['user'], $db['pass'], $db['db'], $db['port']);
		if ($this->con->connect_errno) {
		    die("Failed to connect to MySQL: (" . $this->con->connect_errno . ") " . $this->con->connect_error);
		}
	}

	function __destruct(){
		$this->con->close();
	}

	public function query($sql){
		echo "\nExecuting... ".$sql."\n";
		if ($result = $this->con->query($sql)) {
		  $return = array(); 
		  while ($row = $result->fetch_assoc()) {
		       array_push($return,$row);
    		   }
		    $result->close();
		    return $return;
		}else{
			die("Error: ".$this->con->error);
		}
	}

	public function execute($sql){
                echo "\nExecuting... ".$sql."\n";
                if ($result = $this->con->query($sql)) {
                    return true;;
                }else{
                        die("Error: ".$this->con->error);
                }
        }
}

?>
