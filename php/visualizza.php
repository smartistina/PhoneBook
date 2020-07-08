<?php

include_once 'dbManagement.php';


  $management = new dbManagement();
  //$result = $management->getItem($_GET['id']);
  //echo "id: ".$_GET['id'];


/*
echo $_GET['id'];
$management = new dbManagement();
$result = $management->getItem($_GET['id']);
echo $result['nome'];
*/

 ?>
 <html>
 <head>
 </head>
 <style>

  td {font-size: 25px;}

</style>
 <body>
   <h1>Dati del contatto</h1>
   <?php
   echo "<table width='45%' border=0>";
   //istanzio oggetto che si occupa di formulare le queries
   $manager = new DBManagement();
   //mi restituisce le informazioni anagrafiche relative al contatto selezionato
   $contatto = $manager->getItem($_GET['id']);
   //mi restituisce le informazioni dei recapiti relative al contatto selezionato
   $telefoni = $manager->getNumeri($_GET['id']);

   echo "<tr><td><span style='font-size: 30px;'><h4>Dati anagrafici: </span></h4><td></tr>";
   echo "
           <br><tr></tr>
              <tr><td>Nome: ".$contatto['nome']."</td></tr>
              <tr><td>Cognome: ".$contatto['cognome']."</td></tr>
              <tr><td>Data di nascita: ".$contatto['nascita']."</td></tr>
              <tr><td>CAP: ".$contatto['cap']."</td></tr>
              <tr><td>Email: ".$contatto['email']."</td></tr>
              <td><a href=\"modifica.php?id=$_GET[id]\">Modifica</a> | <a href=\"delete.php?id=$_GET[id]\" onClick=\"return confirm('Sicuro di voler cancellare il contatto?')\">Cancella</a></td>";



    echo "<h4><span style='font-size: 30px; margin-top:20px; padding-top:30px;'>Contatti telefonici</span></h4>";
   foreach ($telefoni as $key => $i) {
       echo "<tr></tr><tr><td><b>Recapiti<b></td></tr>";
       echo "<tr><td>Tipo di contatto: ".$i['tipo']."</td></tr>";
       echo "<tr><td>Numero di telefono: ".$i['numero']."</td></tr>";
       echo "<td><a href=\"modificatelefono.php?id=$i[id]&tel=$i[numero]&tipo=$i[tipo]\">Modifica</a> | <a href=\"deletetelefono.php?id=$i[id]\" onClick=\"return confirm('Sicuro di voler cancellare il recapito?')\">Cancella</a></td>";
    }

     echo "<tr><td><a style = 'font-size: 25px;' href=\"addtel.php?id=$_GET[id]\">Aggiungi numero di telefono</a></td></tr>";



?>




       </table>
   </form>
   <br>
   <a href="../index.php"><button>Indietro</button></a>
 </div>
 </body>
 </html>
