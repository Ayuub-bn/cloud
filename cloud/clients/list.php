<?php 
include ("../db/db.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="">
<div class="col-md-6 mx-auto mt-5">

<div class="input-group mb-3">
<form class="input-group mb-3" method="POST" action="list.php">
<input type="text" class="form-control" name="rech" placeholder="Rechercher un client" aria-label="Recipient's username" aria-describedby="basic-addon2">
  <div class="input-group-append">
  <button  class="input-group-text" type="submit" name="recherche">Rechercher</button>
  </div>
</form>
</div>

<br>

Ajouter nouveau client : &nbsp;<button type="button" class="btn btn-primary"><a class="badge badge-primary" href="add.php">  ajouter</a></button>

<br>

<div id="alert" class="alert alert-<?php echo $_SESSION['messageClass'] ?> alert-dismissible  <?php if($_SESSION['message']!="") echo "show"; else echo "visually-hidden" ; ?>" role="alert" >
 <?php echo $_SESSION['message'];  unset($_SESSION['message']); $_SESSION['message']=""; ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<br>
<?php  



?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Prenom</th>
      <th scope="col">Nom</th>
      <th scope="col">Age</th>
      <th scope="col">Region</th>
      <th scope="col">Modifier</th>
      <th scope="col">Supprimer</th>
    </tr>
  </thead>
  <tbody>
<?php 

if(isset($_POST['recherche']))
{
  $p=$_POST['rech'];

  $sql="SELECT * FROM region WHERE libelle='$p'";
  
  // Execute the query using sqlsrv_query instead of mysqli_query
  $result = sqlsrv_query($conn, $sql);
  
  if(sqlsrv_num_rows($result) > 0)
  {
    $row = sqlsrv_fetch_array($result);
    $region = $row['id'];
    $region = " OR idRegion='$region'";
  }
  else
  {
    $region = "";
  }

  $sql = "SELECT * FROM client WHERE nom='$p' OR prenom='$p' OR age='$p' $region";
  unset($_POST['recherche']);
}
else
{
  $sql = "SELECT * FROM client";
}


// Execute the query using sqlsrv_query
$result = sqlsrv_query($conn, $sql);
if ($result === false) {
 
  ?>
<tr>
  <td colspan="5">aucun client enregistré</td>
</tr>
<?php
}
else
{

  while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) 
  {
    $idRegion = $row["idRegion"];

    $sql1 = "SELECT * FROM region WHERE id='$idRegion'";

    // Execute the query using sqlsrv_query
    $result1 = sqlsrv_query($conn, $sql1);
    $row1 = sqlsrv_fetch_array($result1);
?>
<tr>
<td><?php echo $row["prenom"] ?></td>
<td><?php echo $row["nom"] ?></td>
<td><?php echo $row["age"] ?></td>
<td><?php echo $row1["libelle"] ?></td>
<td><button type="button" class="btn btn-dark"><a class="badge badge-primary" href="modifier.php?id=<?php echo $row["id"] ?>">Modifier</a></button></td>
<td><button type="button" class="btn btn-dark"><a class="badge badge-primary" href="supprimer.php?id=<?php echo $row["id"] ?>">Supprimer</a></button></td>
</tr>
<?php  
  }
}
?>
    
  </tbody>
</table>
</div>
</body>
</html>
