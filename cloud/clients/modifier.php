<?php 
include ("../db/db.php");

$id=$_GET['id'];

if(isset($_POST["add"]))
{

    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $age=$_POST['age'];
    $region=$_POST['region'];

    $sql="update client set nom='$nom', prenom='$prenom', age='$age', idRegion='$region' where id='$id'";
    if(mysqli_query($conn,$sql))
    {

      $_SESSION['messageClass']="success";
      $_SESSION['message']="Modifier avec succes";

        echo "<script type='text/javascript'>
        window.location.href = './list.php';
      </script>";

    }

}

$sql="select * from client where id='$id'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();



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
<form method="post" action="modifier.php?id=<?php echo $id; ?>">
<div class="form-group">
    <label for="nom">nom</label>
    <input type="text" name="nom" class="form-control" id="nom" aria-describedby="emailHelp" required value="<?php echo $row['nom'] ?>" placeholder="nom">
  </div>
  <div class="form-group">
    <label for="prenom">prenom</label>
    <input type="text" name="prenom" class="form-control" id="prenom" aria-describedby="emailHelp" required value="<?php echo $row['prenom'] ?>" placeholder="prenom">
  </div>
  <div class="form-group">
    <label for="age">age</label>
    <input type="number" name="age" class="form-control" id="age" aria-describedby="emailHelp" required value="<?php echo $row['age'] ?>" placeholder="age">
  </div>
  <div class="form-group">
    <label for="region">region</label>
    <select type="text" name="region" class="form-control" id="region" aria-describedby="emailHelp" required placeholder="">
    <?php 
    $sql="select * from client where id='$id'";
    $result=$conn->query($sql);

  $row = $result->fetch_assoc();

      $idRegion=$row["idRegion"];

      $sql1="select * from region where id='$idRegion'";
      $result=$conn->query($sql1);
 




    $sql="select * from region";
    $result=$conn->query($sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

      $selected="";
      if ($row["id"]==$idRegion)
      $selected="selected";


        echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["libelle"].'</option>';
    }
    }
    
    ?>
    </select>
  </div>
  <br>

  <button type="submit" name="add" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>