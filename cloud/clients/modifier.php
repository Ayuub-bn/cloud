<?php 
include ("../db/db.php");

$id = $_GET['id'];

if(isset($_POST["add"])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $region = $_POST['region'];

    $sql = "UPDATE client SET nom = ?, prenom = ?, age = ?, idRegion = ? WHERE id = ?";
    $params = array($nom, $prenom, $age, $region, $id);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if($stmt === false) {
        $_SESSION['messageClass'] = "danger";
        $_SESSION['message'] = "Erreur lors de la mise à jour du client!";
        echo "<script type='text/javascript'>
        window.location.href = './modifier.php?id=$id';
      </script>";
    } else {
        $_SESSION['messageClass'] = "success";
        $_SESSION['message'] = "Modification effectuée avec succès!";
        echo "<script type='text/javascript'>
        window.location.href = './list.php';
      </script>";
    }
}

$sql = "SELECT * FROM client WHERE id = ?";
$stmt = sqlsrv_query($conn, $sql, array($id));
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="">

<div class="col-md-6 mx-auto mt-5">
    <form method="post" action="modifier.php?id=<?php echo $id; ?>">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" class="form-control" id="nom" required value="<?php echo htmlspecialchars($row['nom']); ?>" placeholder="Nom">
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" class="form-control" id="prenom" required value="<?php echo htmlspecialchars($row['prenom']); ?>" placeholder="Prénom">
        </div>
        <div class="form-group">
            <label for="age">Âge</label>
            <input type="number" name="age" class="form-control" id="age" required value="<?php echo htmlspecialchars($row['age']); ?>" placeholder="Âge">
        </div>
        <div class="form-group">
            <label for="region">Région</label>
            <select name="region" class="form-control" id="region" required>
                <?php 
                $idRegion = $row['idRegion'];
                $sql = "SELECT * FROM region";
                $stmt = sqlsrv_query($conn, $sql);

                if($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }

                while ($regionRow = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $selected = ($regionRow['id'] == $idRegion) ? 'selected' : '';
                    echo '<option value="'.$regionRow["id"].'" '.$selected.'>'.htmlspecialchars($regionRow["libelle"]).'</option>';
                }
                ?>
            </select>
        </div>
        <br>
        <button type="submit" name="add" class="btn btn-primary">Modifier</button>
    </form>
</div>

</body>
</html>
