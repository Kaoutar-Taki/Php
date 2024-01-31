<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ktaki</title>
</head>

<body>
<?php include "../include/nav-front.php" ?>
    <div class="container py-2">
        <?php
        require_once "../include/database.php";
        $categories = $pdo->query("SELECT * FROM categorie")->fetchAll(PDO::FETCH_OBJ);
        ?>
        <h4><i class="fa-solid fa-list"></i> List categories</h4>
        <ul class="list-group list-group-flush">
            <?php
            foreach ($categories as $category) {
            ?>
                <li class="list-group-item">
                    <a href="category.php?id=<?= $category->id ?>" class="btn btn-light btn-sm">
                    <i class="<?= $category->icon ?>"></i> <?= $category->libelle ?>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
</body>

</html>