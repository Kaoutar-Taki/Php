<?php
session_start();
require_once "../include/database.php";
$id = $_GET['id'];
$sqlState = $pdo->prepare("SELECT * FROM produit WHERE id=? ");
$sqlState->execute([$id]);
$product = $sqlState->fetch(PDO::FETCH_ASSOC);

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
    <title>Ktaki | Product : <?= $product['libelle'] ?></title>
</head>

<body>
    <?php include "../include/nav-front.php";
    $prix = $product['prix'];
    $discount = $product['discount'];
    $prix_after_discount = $prix - ($prix * $discount / 100);
    ?>
    <div class="bg-gray-100 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row -mx-4">
                <div class="md:flex-1 px-4">
                    <div class="h-[460px] rounded-lg bg-gray-300  mb-4">
                        <img class="w-full h-full object-cover" src="../upload/products/<?= $product['image'] ?>" alt="<?= $product['libelle'] ?>">
                    </div>
                </div>
                <div class="md:flex-1 px-4">
                    <h2 class="text-2xl font-bold text-gray-800  mb-2"><?= $product['libelle'] ?></h2>
                    <?php
                    if ($discount == 0) {
                    ?>
                        <div class="flex mb-4">
                            <div class="mr-4">
                                <span class="font-bold text-gray-700">Price:</span>
                                <span class="text-gray-600"><?= $prix ?>MAD</span>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="flex mb-4">
                            <div class="mr-4 items-center">
                                <span class="font-bold text-gray-700">Price:</span>
                                <span class="text-gray-600"><?= $prix_after_discount ?>MAD</span>
                                <del><span class="text-gray-600"><?= $prix ?>MAD</span></del>
                            </div>
                            <div class="mr-4 items-center">
                                <span class="font-bold text-gray-700">Discount: </span>
                                <span class="inline-flex items-center rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">-<?= $discount ?> %</span>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div>
                        <span class="font-bold text-gray-700">Product Description:</span>
                        <p class="text-gray-600 text-sm mt-2">
                            <?= $product['description'] ?>
                        </p>
                    </div>
                    <?php 
                        $idProduct = $product['id'];
                        include "counter.php"
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="../assets/js/products/counter.js"> </script>
</body>

</html>