<?php
include_once 'dbManagement.php';
if (isset($_POST['submit9'])) {
  $management = new dbManagement();
  //aggiorno i campi relativi ai recapiti telefonici
  $management->insertNumero($_POST['ftipo'], $_POST['ftel'], $_POST['custId']);
  header("location: ../index.php");
}
else {
  //echo $_GET['id'];
  $management = new dbManagement();
  $result = $management->getItem($_GET['id']);
}

?>
<html>
<head>
  <style>
      td {font-size: 25px;}
      th  {font-size: 30px;}

  </style>
</head>

<body>
  <h1>Aggiungi un nuovo numero di telefono</h1>
<div>
 <div class="upform">
  <form action="./addtel.php" method="post" name="form3">
      <table width="25%" border="0">

        <tr>
            <td>tipo telefono</td>
            <td><input type="text" name="ftipo"placeholder="casa" required></td>
        </tr>
        <tr>
            <td>Numero Telefono</td>
            <td><input type="text" name="ftel" placeholder="+39055871235" required></td>
            <input type="hidden" id="custId" name="custId" value="<?php echo $result['id'];?>">
        </tr>
        <tr>
        <td><input type="submit" name="submit9" value="Aggiungi numero" style="font-size:75px;"></td>
        </tr>
      </table>
  </form>
  <a href="../index.php"><button>Indietro</button></a>
</div>
</body>
</html>
