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
                    <th scope="col">Libelle</th>
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
                $products = $pdo->query('SELECT * FROM produit')->fetchAll(PDO::FETCH_OBJ);
                foreach ($products as $product) {
                    $prix = number_format($product->prix,2);
                    $discount = $product->discount;
                    $prix_after_discount = number_format($prix - ($prix * $discount / 100),2);
                ?>
                    <tr>
                        <th><?= $product->id ?></th>
                        <td><?= $product->libelle ?></td>
                        <td><?= $prix ?> MAD</td>
                        <?php if ($discount == 0) { ?>
                            <td>No discount</td>
                        <?php } ?>
                        <?php if ($discount != 0) { ?>
                            <td><?= $discount ?> %</td>
                        <?php } ?>
                        <td><?= $prix_after_discount ?> MAD</td>
                        <td>
                            <?php
                                $product = $pdo->query('SELECT * FROM categorie WHERE id = '. $product->id_categorie)->fetch(PDO::FETCH_OBJ);
                                echo $product->libelle;
                            ?>
                        </td>
                        <td><?= $product->date_creation ?></td>
                        <td>
                            <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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