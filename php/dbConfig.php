<?php
class dbConfig {
    private $host = 'localhost';
    private $user = 'root';
    private $password = 'root';
    public $database = 'Progetto';
    protected $conn;
    public function __construct() {
    }
    public function connect()
    {
      $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
      // Check connection
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
      }
      else {
        //echo "Connected successfully";
      }
    }
    public function disconnect(){
      //RICORDARSI POSSIBILITA CHIUSURA DI CONNESSIONE CHIUSA
      if($this->conn -> close()){
        //echo "Disconnesso";
      } else {
        echo "Non sono riuscito a disconnettere";
      }
    }
}
?>
