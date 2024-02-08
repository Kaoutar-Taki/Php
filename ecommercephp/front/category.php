<?php
session_start();
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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Ktaki | category : <?= $category['libelle'] ?></title>
</head>

<body>
    <?php include "../include/nav-front.php" ?>
    <div class="text-center p-10">
        <h1 class="font-bold text-4xl mb-4"><i class="<?= $category['icon'] ?>"></i> <?= $category['libelle'] ?></h1>
        <h1 class="text-3xl"><?= $category['description'] ?></h1>
    </div>
    <section id="Projects" class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-10 mb-5">
        <?php
        foreach ($products as $product) {
            $idProduct = $product['id'];
            $prix = $product['prix'];
            $discount = $product['discount'];
            $prix_after_discount = $prix - ($prix * $discount / 100);
        ?>
            <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                <img src="../upload/products/<?= $product['image'] ?>" alt="<?= $product['libelle'] ?>" class="h-80 w-80 object-cover rounded-t-xl card-img-top" />
                <div class="px-4 w-72">
                    <span class="text-gray-400 mr-3 uppercase text-xs"><?= date_format(date_create($product['date_creation']), "d/m/Y") ?></span>
                    <p class="text-lg font-bold text-black truncate block capitalize"><?= $product['libelle'] ?></p>
                    <div class="flex items-center">
                        <p class="text-lg font-semibold text-black cursor-auto my-3"><?= $prix_after_discount ?> MAD</p>
                        <del>
                            <p class="text-sm text-gray-600 cursor-auto ml-2"><?= $prix ?> MAD</p>
                        </del>
                        <div class="ml-auto">
                            <a href="product.php?id=<?= $idProduct ?>">
                                <i class="fa-solid fa-arrow-right"></i> </a>
                        </div>
                    </div>
                </div>
                <div>
                    <?php include "counter.php" ?>
                </div>
            </div>
        <?php
        }
        ?>
    </section>
    <?php
    if (empty($products)) {
    ?>
        <div class="alert alert-warning" role="alert">
            No Product in this category
        </div>
    <?php
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="../assets/js/products/counter.js">
    </script>
</body>

</html>