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




Ajouter nouveau client : &nbsp;<button type="button" class="btn btn-primary"><a class="badge badge-primary" href="add.php">  ajouter</a></button>

<br>

<div id="alert" class="alert alert-<?php echo $_SESSION['messageClass'] ?> alert-dismissible  <?php if($_SESSION['message']!="") echo "show"; else echo "visually-hidden" ; ?>" role="alert" >
 <?php echo $_SESSION['message'];  unset($_SESSION['message']); $_SESSION['message']=""; ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


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


$sql="Select * from client";
$result=mysqli_query($conn,$sql);
if($result->num_rows==0)
 {
    ?>

<tr>
  <td colspan="5">aucun client enregistré</td>
</tr>
<?php

 }

 else
 {
  while($row=mysqli_fetch_array($result))
  {

    $idRegion=$row['idRegion'];

    $sql1="Select * from region where id='$idRegion'";

$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($result1)

?>
<tr>
<td><?php echo $row['prenom'] ?></td>
<td><?php echo $row['nom'] ?></td>
<td><?php echo $row['age'] ?></td>
<td><?php echo $row1['libelle'] ?></td>
<td><button type="button" class="btn btn-dark"><a class="badge badge-primary" href="modifier.php?id=<?php echo $row['id'] ?>">Modifier</a></button></td>
<td><button type="button" class="btn btn-dark"><a class="badge badge-primary" href="supprimer.php?id=<?php echo $row['id'] ?>">Supprimer</a></button></td>
</tr>


<?php  
 } }
?>
    
  </tbody>
</table>
</div>
</body>
</html>