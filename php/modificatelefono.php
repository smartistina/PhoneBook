<?php

include_once 'dbManagement.php';

//se è stato completato il form presente nella pagina
if (isset($_POST['submit12'])) {
$management = new dbManagement();
//modifico i dati telefonici nella tabella apposita
$management->updateTelefono($_POST['fnumero'], $_POST['ftipo'], $_POST['custId']);
  /*echo ("<script LANGUAGE='JavaScript'>
    window.alert('Il numero era già presente!');
    window.location.href='../index.php';
    </script>");
  */
  header("location: ../index.php");
  //echo $_POST['fname'];

}
else {
  $management = new dbManagement();
  //vengono restituiti i campi completati con i dati presenti nel database
  $result = $management->getItem($_GET['id']);
  /*
  echo "id: ".$_GET['id'];
  echo "tel: ".$_GET['tel'];
  echo "tipo: ".$_GET['tipo'];
  */
}

 ?>


 <html>
 <head>
   <style>
      td {font-size: 25px;}
   </style>
 </head>

 <body>

   <h2>Inserisci nuovo contatto telefonico: </h2>
<div>
  <div class="upform">
   <form action="./modificatelefono.php" method="post" name="form2">
       <table width="25%" border="0">

             <tr><td>Tipo di contatto: </td><td><input type="text" name="ftipo" value="<?php echo $_GET['tipo'];?>" required></td></tr>
             <tr><td>Telefono: </td><td><input type="text" name="fnumero" value="<?php echo $_GET['tel'];?>" required></td></tr>


             <input type="hidden" id="custId" name="custId" value="<?php echo $_GET['id'];?>">

         </tr>
         <tr>
         <td><input type="submit" name="submit12" value="Modifica contatto"></td>
         </tr>
       </table>
   </form>
 </div>
 </body>
 </html>
