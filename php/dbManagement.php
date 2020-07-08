<?php
include_once 'dbConfig.php';
class dbManagement extends dbConfig{
  public function __construct(){
    parent::__construct();
  }

    /* Inserisco nuovo record (info personali) nel database (tabella contatti)
    */
    public function insert($name, $surname, $birth, $zip, $email)
    {
      $name = strtoupper($name);
      $surname = strtoupper($surname);
      $s_name = [$name, $surname];
      try {
        foreach ($s_name as $value) {
          $this->checkString($value);
        }
        $this->checkBDay($birth);
        $this->checkEmail($email);
        $this->checkZipCode($zip);

        // prepare and bind
        $this->connect();
        // prepare and bind
        $stmt = $this->conn->prepare("INSERT INTO contatti (nome, cognome, nascita, cap, email) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $name, $surname, $birth, $zip, $email);
        // set parameters and execute
        $stmt->execute();
        $stmt->close();
        $ret = $this->conn->insert_id;
        return $ret;

    } catch (\Exception $e) {
        echo "<script>alert('Uno o più campi non sono abilitati ad essere gestiti. Riprovare.')</script>";
    }
    finally {
      $this->disconnect();
    }

    }

    //inserisco i dati relativi ai recapiti nella tabella telefoni
      public function insertNumero($tipo, $numero, $id)
      {
        $tipo = strtoupper($tipo);
        try {
            $this->checkString($tipo);
            $this->checkNumero($numero);
            $this->connect();
            // prepare and bind

            $stmt = $this->conn->prepare("INSERT INTO telefoni (tipo, numero, raccordo) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $tipo, $numero, $id);
            // set parameters and execute
            $stmt->execute();
            //echo "New records created successfully";
            $stmt->close();

            return true;


        } catch (\Exception $e) {
          echo "<script>alert('Uno o più campi non sono abilitati ad essere gestiti. Riprovare.')</script>";
        } finally {
          $this->disconnect();
        }

      }

/*
Checkers
*/
//validifico la stringa (input) in quanto tale, ritorna true se va a buon fine
  private function checkString($value)
  {
    if (!preg_match("/^[a-zA-Z ]*$/", $value))
    {
      echo "ERRORE nella Stringa : " . $value;
      throw new InvalidArgumentException();
    }
    return true;
  }
//validifico il formato della data (input) in quanto tale, ritorna true se va a buon fine
  private function checkBDay($date)
  {
   if (!preg_match('/(0[1-9]|1[0-9]|2[0-9]|3(0|1))\/(0[1-9]|1[0-2])\/\d{4}/', $date) || (empty($date)))
    {
      echo "ERRORE nella data : " .$date;
      throw new InvalidArgumentException();
    }
    return true;
  }
//validifico il cap (input) in quanto tale, ritorna true se va a buon fine
  private function checkZipCode($zipCode) {
    if (!preg_match('#[0-9]{5}#', $zipCode)){
      echo "ERRORE nel CAP : ".$zipCode;
    	throw new InvalidArgumentException();
    }
    else return true;
  }
//validifico l'email (input) in quanto tale, ritorna true se va a buon fine
  private function checkEmail($email)
  {
    $pattern = '/\b[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}\b/';
    if(!preg_match($pattern, $email) ){
      echo "ERROR nell' email : ".$email;
      throw new InvalidArgumentException();
    }
    else return true;
  }
//validifico il numero di tel (input) in quanto tale, ritorna true se va a buon fine
  private function checkNumero($tel)
  {
    $pattern = '/\+\d{2}+[0-9]{9,15}|[0-9]{9,15}/';
    if (!preg_match($pattern, $tel)){
      echo "<br>ERRORE nel numero di telefono : ".$tel;
      throw new InvalidArgumentException();
    }
    else return true;
  }

//ritorna i dati della rubrica
  public function getItems()
  {
    // Perform query
    $this->connect();
    $result = $this->conn -> query("SELECT * FROM contatti JOIN telefoni ON contatti.id = telefoni.raccordo ORDER BY contatti.id DESC");
    if($result==false){
      echo "operazione fallita";
      $this->disconnect();
      return false;
    }
  //  echo "<br>Returned rows are: " . $result -> num_rows;
  //  echo "<br>";
    $rows = array();
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }
    $this->disconnect();
    return $rows;
  }

//ritorna i recapiti in base all'id
  public function getNumeri($id)
  {
    $this->connect();
    $result = $this->conn -> query("SELECT * FROM telefoni WHERE raccordo = '$id' ");
    if($result==false){
      echo "operazione fallita";
      $this->disconnect();
      return false;
    }
    $rows = array();
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }
    $this->disconnect();
    return $rows;
  }

//ritorna i dati relativi ai contatti
  public function getContacts()
  {
    // Perform query
    $this->connect();
    $result = $this->conn -> query("SELECT * FROM contatti ORDER BY nome");
    if($result==false){
      echo "getItems fallita";
      $this->disconnect();
      return false;
    }
    $rows = array();
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }
    $this->disconnect();
    return $rows;
  }

//ritorna l'anagrafica del contatto in base all'id selezionato
  public function getItem($id)
  {
    $this->connect();
    $result = $this->conn -> query("SELECT * FROM contatti WHERE id = $id");
    if($result==false){
      echo "getItem fallita";
      $this->disconnect();
      return false;
    }
    $row = $result->fetch_assoc();

    $this->disconnect();
    return $row;
  }
//cancella il record dal database
  public function deleteItem($id)
  {
    $this->connect();
    $result = $this->conn -> query("DELETE FROM contatti WHERE id = $id");
    if($result==false){
      echo "getItem fallita";
      $this->disconnect();
      return false;
    }
    $this->disconnect();
    return true;
  }
//cancella il numero di telefono dal database
  public function deleteNumber($id)
  {
    $this->connect();
    $result = $this->conn -> query("DELETE FROM telefoni WHERE id = $id");
    if($result==false){
      echo "getItem fallita";
      $this->disconnect();
      return false;
    }
    $this->disconnect();
    return true;
  }
//cancella il numero di telefono dal database in base all'id della tabella contatti
  public function deleteRelatednumbers($id)
  {
    $this->connect();
    $result = $this->conn -> query("DELETE FROM telefoni WHERE raccordo = $id");
    if($result==false){
      echo "getItem fallita";
      $this->disconnect();
      return false;
    }
    $this->disconnect();
    return true;
  }
//aggiorno i campi dell'anagrafe del contatto
  public function updateItem($nome, $cognome, $birth, $zipCode, $email, $id)
  {
    $nome = strtoupper($nome);
    $cognome = strtoupper($cognome);

    $this->connect();
    try {
      if ($this->checkString($nome) && $this->checkString($cognome) && $this->checkBDay($birth) && $this->checkZipCode($zipCode) && $this->checkEmail($email)) {
        // prepare and bind
        $stmt = $this->conn->prepare("UPDATE contatti SET nome = ?,cognome = ?,nascita = ?,cap = ?,email = ? WHERE id = ?");
        //$stmt = $this->conn->prepare("UPDATE contatti SET $parametro=?, $parametro2=?, $parametro3=?, $parametro4=?, $parametro5=? WHERE id=?");
        $stmt->bind_param("sssssi", $nome, $cognome, $birth, $zipCode, $email, $id);
        // set parameters and execute
        $stmt->execute();
        //echo "New records created successfully";
        $stmt->close();
      }
    } catch (InvalidArgumentException $e) {
      echo "<script>alert('Uno o più campi non sono abilitati ad essere gestiti. Riprovare.')</script>";
    } finally {

      $this->disconnect();
    }
  }

//aggiorno i campi dei recapiti del contatto
  public function updateTelefono($numero, $tipo, $id)
  {
    $tipo = strtoupper($tipo);
    try{
      if ($this->checkNumero($numero) && $this->checkString($tipo)) {
        $this->connect();
        // prepare and bind
        $stmt = $this->conn->prepare("UPDATE telefoni SET numero=? , tipo=? WHERE id=?");
        $stmt->bind_param("ssi", $numero, $tipo, $id);
        // set parameters and execute
        $stmt->execute();
        //echo "New records created successfully";
        $stmt->close();
        $this->disconnect();
      }
    } catch (InvalidArgumentException $e) {
      echo "<script>alert('Uno o più campi non sono abilitati ad essere gestiti. Riprovare.')</script>";
      //echo ("<script LANGUAGE='JavaScript'>
      //  window.alert('Uno o più campi non sono abilitati ad essere gestiti.');
      //  window.location.href='../index.php';
      //  </script>");
    }
  }


  public function checkItem($nome, $tel)
  {
    $this->connect();
    $result = $this->conn -> query("SELECT * FROM contatti JOIN telefoni ON contatti.id = telefoni.raccordo WHERE contatti.nome = '$nome' AND telefoni.numero = '$tel' ");
    if($result==false){
      echo "checkItem fallita";
      $this->disconnect();
      return false;
    } else {
      if ($result->num_rows > 0) {
        echo "Record già presente";
        return false;
      }
      else
      {
        //echo "Record può essere inserito";
        return true;
      }
    }
  }


}
?>
