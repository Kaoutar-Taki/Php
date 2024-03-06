<?php
    session_start();
    $connect = false;
    if (isset($_SESSION['utilisateur'])) {
        $connect = true;
    }
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin.php">Taki Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link hover:active" aria-current="page" href="index.php">Add User</a>
                </li>
                <?php
                    if($connect){
                ?>
                    <li class="nav-item">
                        <a class="nav-link hover:active" aria-current="page" href="Categories.php">List Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover:active" aria-current="page" href="addCategory.php">Add Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover:active" aria-current="page" href="Products.php">List Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover:active" aria-current="page" href="addProduct.php">Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover:active" aria-current="page" href="deconnexion.php">Deconnexion</a>
                    </li>
                <?php
                    }
                    else{
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="connexion.php">Connexion</a>
                            </li>
                        <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>