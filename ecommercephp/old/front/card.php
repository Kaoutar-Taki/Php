<?php
session_start();
require_once "../include/database.php";
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
    <title>Ktaki | Cart</title>
</head>

<body>
    <?php include "../include/nav-front.php" ?>
    <?php
    $idUser = $_SESSION['utilisateur']['id'];
    $cart = $_SESSION['cart'][$idUser];
    $idProducts = array_keys($cart);
    $idProducts = implode(',', $idProducts);
    $products = $pdo->query("SELECT * FROM produit WHERE id IN ($idProducts)")->fetchAll(PDO::FETCH_OBJ);
    var_dump($products);
    if (empty($cart)) {
    ?>
        <div class="alert alert-warning" role="alert">
            Your cart is empty !
        </div>
        <?php
    } else {
        ?>
        
    <?php
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="../assets/js/products/counter.js">
    </script>
</body>

</html>