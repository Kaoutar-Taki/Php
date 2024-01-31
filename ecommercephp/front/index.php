<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ktaki</title>
</head>

<body>
<?php include "../include/nav-front.php" ?>
    <div class="container py-2">
        <?php
        require_once "../include/database.php";
        $categories = $pdo->query("SELECT * FROM categorie")->fetchAll(PDO::FETCH_OBJ);
        ?>
        <h4>List categories</h4>
        <ul class="list-group list-group-flush">
            <?php
            foreach ($categories as $category) {
            ?>
                <li class="list-group-item">
                    <a href="category.php?id=<?= $category->id ?>" class="btn btn-light btn-sm">
                        <?= $category->libelle ?>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
</body>

</html>