<?php
//gestisco la connessione al database
include_once './php/dbManagement.php';
?>
<html>
<head>
</head>

<body>
  <!--<h1>index.php</h1> -->
  <h1>Rubrica</h1>

  <table width='70%' border=0>

  <tr bgcolor='#CCCCCC'>
     <!-- <td>id</td>-->
      <td>Nome</td>
      <td>Cognome</td>
      <td>Data di nascita</td>
      <td>CAP</td>
      <td>Email</td>
      <td>Operazioni</td>
  </tr>
<?php

  //istanzio l'oggetto che si occuperà di formulare le queries
  $manager = new DBManagement();
  //mi faccio restituire i dati relativi ai contatti
  $items = $manager->getContacts();
  foreach ($items as $key => $i) {
      echo "<tr>";
      //echo "<td>".$i['id']."</td>";
      echo "<td>".$i['nome']."</td>";
      echo "<td>".$i['cognome']."</td>";
      echo "<td>".$i['nascita']."</td>";
      echo "<td>".$i['cap']."</td>";
      echo "<td>".$i['email']."</td>";
      //echo "<td>".$i['tipo']."</td>";
      //echo "<td>".$i['numero']."</td>";
      echo "<td><a href=\"php/visualizza.php?id=$i[id]\">Visualizza contatto</a></td>";

      //echo "<td><a href=\"php/modifica.php?numero=$i[id]\">Modifica</a> | <a href=\"php/addtel.php?id=$i[id]\">Aggiungi numero al contatto</a> |<a href=\"php/delete.php?id=$i[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Cancella</a></td>";

}
  ?>
  </table>
  <br>

  <button type="button" onclick="location.href='./php/add.php'" style="border-color:black">Aggiungi nuovo contatto</button>
</body>
</html>
