<?php
include_once 'dbManagement.php';
//submit del form nella pagina
if (isset($_POST['submit8'])) {

  $management = new dbManagement();
  //aggiorno i campi
  $management->updateItem($_POST['fname'], $_POST['fsurname'], $_POST['fbirth'], $_POST['fzip'], $_POST['email'], $_POST['custId']);
  header("location: ../index.php");

}
else {
  $management = new dbManagement();
  $result = $management->getItem($_GET['id']);
  echo "id: ".$_GET['id'];
  //echo "parametro: ".$_GET['parametro'];

}

 ?>


 <html>
 <head>
   <style>

    td {font-size: 25px;}

  </style>
 </head>

 <body>
   <h1>php/modifica.php</h1>
<div>
  <div class="upform">
   <form action="./modifica.php" method="post" name="form2">
       <table width="25%" border="0">
         <!--
         <tr>
             <td>Inserisci nuovo <?php// echo $_GET['parametro'];?></td>
             <td><input type="text" name="fname" required></td>
         </tr>
          -->
          <tr>
              <td>Nome</td>
              <td><input type="text" name="fname" value="<?php echo $result['nome'];?>" required></td>
          </tr>
          <tr>
              <td>Cognome</td>
              <td><input type="text" name="fsurname" value="<?php echo $result['cognome'];?>" required></td>
          </tr>
          <tr>
              <td>Data di nascita</td>
              <td><input type="text" name="fbirth" value="<?php echo $result['nascita'];?>" required></td>
          </tr>
          <tr>
              <td>CAP</td>
              <td><input type="text" name="fzip" value="<?php echo $result['cap'];?>" required></td>
          </tr>
          <tr>
              <td>Email</td>
              <td><input type="text" name="email" value="<?php echo $result['email'];?>" required></td>
          </tr>
         <tr>
             <input type="hidden" id="custId" name="custId" value="<?php echo $_GET['id'];?>">
             <!--
                <input type="hidden" id="param" name="param" value="<?php echo $_GET['parametro'];?>">
              -->
         </tr>
         <tr>
         <td ><input style="font-size:40px" type="submit" name="submit8" value="Modifica contatto"></td>
         </tr>
       </table>
   </form>
   <br>
   <a href="../index.php"><button>Indietro</button></a>
 </div>
 </body>
 </html>
