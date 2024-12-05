<?php 
include ("../db/db.php");

if(isset($_POST["add"]))
{
    // Retrieve the form input data
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $region = $_POST['region'];

    // SQL query to insert data into the client table
    $sql = "INSERT INTO client (nom, prenom, age, idRegion) VALUES (?, ?, ?, ?)";
    
    // Prepare the query and execute it with parameters
    $params = array($nom, $prenom, $age, $region);
    $stmt = sqlsrv_query($conn, $sql, $params);
    
    if ($stmt === false) {
        // Handle query failure
        $_SESSION['messageClass'] = "danger";
        $_SESSION['message'] = "Error while adding client!";
        echo "<script type='text/javascript'>
        window.location.href = './add.php';
      </script>";
    } else {
        // Success
        $_SESSION['messageClass'] = "success";
        $_SESSION['message'] = "Ajout avec succès";

        echo "<script type='text/javascript'>
        window.location.href = './list.php';
      </script>";
    }
}
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
<body>
<div class="col-md-6 mx-auto mt-5">
    <form method="post" action="add.php">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" class="form-control" id="nom" required placeholder="Nom">
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" class="form-control" id="prenom" required placeholder="Prénom">
        </div>
        <div class="form-group">
            <label for="age">Âge</label>
            <input type="number" name="age" class="form-control" id="age" required placeholder="Âge">
        </div>
        <div class="form-group">
            <label for="region">Région</label>
            <select name="region" class="form-control" id="region" required>
                <?php 
                // Fetch the regions from the database
                $sql = "SELECT * FROM region";
                $result = sqlsrv_query($conn, $sql);
                if ($result === false) {
                    die(print_r(sqlsrv_errors(), true)); // Error handling
                }
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo '<option value="'.$row["id"].'">'.$row["libelle"].'</option>';
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
