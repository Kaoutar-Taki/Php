<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ktaki | List Products</title>
</head>

<body>
    <?php include 'include/nav.php' ?>
    <div class="container py-2">
        <h4>List Products</h4>
        <a class="link-opacity-75-hover btn btn-primary" href="addProduct.php">Add Product</a>
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Libelle</th>
                    <th scope="col">Description</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Prix after discount</th>
                    <th scope="col">Category</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'include/database.php';
                $products = $pdo->query("SELECT produit.* , categorie.libelle as 'categorie_libelle' FROM produit INNER JOIN categorie ON produit.id_categorie = categorie.id")->fetchAll(PDO::FETCH_OBJ);
                foreach ($products as $product) {
                    $prix = $product->prix;
                    $discount = $product->discount;
                    $prix_after_discount = $prix - ($prix * $discount / 100);
                ?>
                    <tr>
                        <th><?= $product->id ?></th>
                        <th><img src="upload/products/<?= $product->image ?>" alt="" width="100" class="image-fluid" height="100"></th>
                        <td><?= $product->libelle ?></td>
                        <td><?= $product->description ?></td>
                        <td><?= $prix ?> MAD</td>
                        <?php if ($discount == 0) { ?>
                            <td>No discount</td>
                        <?php } ?>
                        <?php if ($discount != 0) { ?>
                            <td><?= $discount ?> %</td>
                        <?php } ?>
                        <td><?= $prix_after_discount ?> MAD</td>
                        <td>
                            <?= $product->categorie_libelle ?>
                        </td>
                        <td><?= $product->date_creation ?></td>
                        <td>
                            <a href="editProduct.php?id=<?= $product->id ?>" class="btn btn-warning">Edit</a>
                            <a href="deleteProduct.php?id=<?= $product->id ?>" onclick="return confirm('Are you sure to delete this product : <?= $product->libelle ?>?')" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>