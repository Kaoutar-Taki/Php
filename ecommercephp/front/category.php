<?php
require_once "../include/database.php";
$id = $_GET['id'];
$sqlState = $pdo->prepare("SELECT * FROM categorie WHERE id=? ");
$sqlState->execute([$id]);
$category = $sqlState->fetch(PDO::FETCH_ASSOC);

$sqlState = $pdo->prepare("SELECT * From produit WHERE id_categorie=?");
$sqlState->execute([$id]);
$products = $sqlState->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ktaki | category : <?= $category['libelle'] ?></title>
</head>

<body>
    <?php include "../include/nav-front.php" ?>
    <div class="container py-2">
        <h4><i class="<?= $category['icon'] ?>"></i> <?= $category['libelle'] ?></h4>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            foreach ($products as $product) {
                $prix = $product['prix'];
                $discount = $product['discount'];
                $prix_after_discount = $prix - ($prix * $discount / 100);
            ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="../assets/bougie1.jpg" class="card-img-top" width="100%" height="300" alt="...">
                        <div class="card-body">
                            <h4 class="card-title"><?= $product['libelle'] ?></h4>
                            <h6>Discount : <?= $product['discount']?>%</h6>
                            <small>Add the : <?= date_format(date_create($product['date_creation']),"d/m/Y")?></small>
                        </div>
                        <div class="card-footer">
                            <del><small class="text-body-secondary"><?=$prix ?>MAD</small></del>
                            <small class="text-body-secondary"><?= $prix_after_discount ?>MAD</small>
                        </div>
                    </div>
                </div>
            <?php
            }
            if (empty($products)){
                ?>
                    <div class="alert alert-warning" role="alert">
                        No Product in this category
                    </div>
                <?php
            }
            ?>
        </div>
    </div>
</body>

</html>