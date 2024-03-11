<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ktaki | Edit Category</title>
</head>

<body>
    <?php include 'include/nav.php' ?>
    <div class="container py-2">
        <?php
            require_once 'include/database.php';
            $sqlState = $pdo->prepare('SELECT * FROM categorie WHERE id =?');
            $id = $_GET['id'];
            $sqlState->execute([$id]);
            $category = $sqlState->fetch(PDO::FETCH_ASSOC);
            if (isset($_POST['EditCategory'])) {
                $libelle = $_POST['libelle'];
                $description = $_POST['description'];
                $icon = $_POST['icon'];
                if (!empty($libelle) &&!empty($description)) {
                    $sqlState = $pdo->prepare('UPDATE categorie SET libelle =?, description =?,icon =? WHERE id =?');
                    $sqlState->execute([$libelle, $description,$icon, $id]);
                    header('location:Categories.php');
                } else {
                    ?>
                    <div class="alert alert-danger" role="alert">libelle and description is required</div>
                    <?php
                }
            }
        ?>
        <h4>Edit Category</h4>
        <form action="" method="post">
            <div class="mb-3">
                <input type="hidden" class="form-control" id="id" name="id" value="<?= $category['id'] ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="libelle" class="form-label">Libelle</label>
                <input type="text" class="form-control" id="libelle" name="libelle" value="<?= $category['libelle'] ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="description" cols="30" rows="10"> <?= $category['description'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="libelle" class="form-label">Icon</label>
                <input type="text" class="form-control" id="icon" name="icon" value="<?= $category['icon'] ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="EditCategory">Edit Category</button>
        </form>
    </div>
</body>

</html>