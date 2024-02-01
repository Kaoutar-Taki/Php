<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ktaki | AddProduct</title>
</head>

<body>
    <?php include 'include/nav.php';
    require_once 'include/database.php'; ?>
    <div class="container py-2">
        <?php
        if (isset($_POST['AddProduct'])) {
            $libelle = $_POST['libelle'];
            $prix = $_POST['prix'];
            $discount = $_POST['discount'];
            $categorie = $_POST['categorie'];
            $description = $_POST['description'];  

            $fileName = "dafaultProduct.png";    
            if (!empty($_FILES['image']['name'])){
                $image = $_FILES['image']['name'];
                $fileName = uniqid().$image;
                move_uploaded_file($_FILES['image']['tmp_name'],'upload/products/'.$fileName) ;
            }

            $date_creation = date('Y-m-d H:i:s');
            if (!empty($libelle) && !empty($prix) && !empty($categorie)) {
                $sqlState = $pdo->prepare('INSERT INTO produit VALUE(null,?,?,?,?,?,?,?)');
                $sqlState->execute([$libelle, $prix, $discount, $categorie, $description, $fileName,$date_creation]);
                header('location:Products.php');
            } else {
        ?>
                <div class="alert alert-danger">libelle, prix and categorie are required</div>
        <?php
            }
        }
        ?>
        <h4>Add Product</h4>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="libelle" class="form-label">Libelle</label>
                <input type="text" class="form-control" id="libelle" name="libelle">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" cols="30" rows="10"></textarea>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix</label>
                <input type="number" name="prix" step="0.1" class="form-control" id="prix" min="0" />
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label">Discount</label>
                <input type="range" value="0" name="discount" class="form-control" id="discount" min="0" max="90" />
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image" />
            </div>
            <div class="mb-3">
                <label for="categorie" class="form-label">Categorie</label>
                <select name="categorie" class="form-select" id="">
                    <option value="0">Select Categorie</option>
                    <?php
                    require_once 'include/database.php';
                    $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($categories as $categorie) {
                    ?>
                        <option value="<?= $categorie['id'] ?>"><?= $categorie['libelle'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="AddProduct">Add Product</button>
        </form>
    </div>
</body>

</html>