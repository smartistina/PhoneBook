<?php
include_once 'dbManagement.php';


if (isset($_POST['submit'])) { //quando viene completato il form nella medesima pagina
  //istanzio oggetto che si occupa di formulare le queries
  $manager = new dbManagement();
  //inserisco i dati anagrafici nella tabella apposita
  $m = $manager->insert($_POST['fname'],$_POST['fsurname'], $_POST['fbirth'], $_POST['fzip'], $_POST['email']);
  //inserisco i dati telefonici nella tabella apposita
  $manager->insertNumero($_POST['ftipo'], $_POST['fnumero'], $m);
  //ritorno nella home
  header("location: ../index.php");
} 


?>

<html>
<head>
</head>

<body>
  <h1>Aggiungi un nuovo contatto</h1>
  <form action="./add.php" method="post" name="form1">
      <table width="25%" border="0">
        <tr>
            <td>Name</td>
            <td><input type="text" name="fname" placeholder="John"  required>
            </td>
        </tr>
        <tr>
            <td>Cognome</td>
            <td><input type="text" name="fsurname" placeholder="Doe"  required></td>
        </tr>
        <tr>
            <td>Data di nascita</td>
            <td><input type="text" name="fbirth" placeholder="22/01/1990"  required></td>
        </tr>
        <tr>
            <td>Cap</td>
            <td><input type="text" name="fzip" placeholder="40059"  required></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="email" placeholder="john.doe@gmail.com"  required></td>
        </tr>
        <tr>
            <td>Tipologia di recapito</td>
            <td><input type="text" name="ftipo" placeholder="Casa"  required></td>
        </tr>
        <tr>
            <td>numero</td>
            <td><input type="tel" name="fnumero" placeholder="+39051872134"  required></td>
        </tr>
        <td><input type="submit" name="submit" value="Aggiungi"></td>
      </table>
  </form>
</body>
</html>
