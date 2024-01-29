<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ktaki | AddCategory</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container py-2">
    <?php
            if (isset($_POST['AddCategory'])){
                $libelle = $_POST['libelle'];
                $description = $_POST['description'];
                if (!empty($libelle) && !empty($description)){
                    require_once 'include/database.php';
                    $sqlState = $pdo->prepare('INSERT INTO categorie(libelle,description) VALUE(?,?)');
                    $sqlState->execute([$libelle, $description]);
                    ?>
                        <div class="alert alert-success" role="alert">category <?= $libelle ?> is added</div>
                    <?php
                }
                else{
                    ?>
                        <div class="alert alert-danger" role="alert">libelle and description is required</div>
                    <?php
                }
            }
        ?>
        <h4>Add Category</h4>
        <form action="" method="post">
            <div class="mb-3">
                <label for="libelle" class="form-label">Libelle</label>
                <input type="text" class="form-control" id="libelle" name="libelle">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="AddCategory">Add Category</button>
        </form>
    </div>
</body>
</html>