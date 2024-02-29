<nav>
    <a href="index.php">Taki Store</a>
    <ul>
        <li>
            <a href="index.php">List Categories</a>
        </li>
    </ul>
    <?php
        $idUser = $_SESSION['utilisateur']['id'];
    ?>
    <a href="card.php"><i class="fa-solid fa-cart-shopping"></i>Card(<?php echo count($_SESSION['cart'][$idUser]); ?>)</a>
</nav>