<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ktaki | Edit Product</title>
</head>

<body>
    <?php include 'include/nav.php' ?>
    <div class="container py-2">
        <?php
        $id = $_GET['id'];
        require_once 'include/database.php';
        $sqlState = $pdo->prepare('SELECT * FROM produit WHERE id =?');
        $sqlState->execute([$id]);
        $product = $sqlState->fetch(PDO::FETCH_OBJ);
        if (isset($_POST['EditProduct'])) {
            $libelle = $_POST['libelle'];
            $prix = $_POST['prix'];
            $discount = $_POST['discount'];
            $categorie = $_POST['categorie'];
            $description = $_POST['description'];
            $fileName = "";
            if (!empty($_FILES['image']['name'])) {
                $image = $_FILES['image']['name'];
                $fileName = uniqid() . $image;
                move_uploaded_file($_FILES['image']['tmp_name'], 'upload/products/' . $fileName);
            }
            if (!empty($libelle) && !empty($prix) && !empty($categorie)) {
                if (!empty($fileName)) {
                    $query = 'UPDATE produit SET libelle =?, prix =?, discount =?, id_categorie =?, description =?, image =? WHERE id =?';
                    $sqlState = $pdo->prepare($query);
                    $sqlState->execute([$libelle, $prix, $discount, $categorie, $description, $fileName, $id]);
                    header('location:Products.php');
                } else {
                    $query = 'UPDATE produit SET libelle =?, prix =?, discount =?, id_categorie =?, description =? WHERE id =?';
                    $sqlState = $pdo->prepare($query);
                    $sqlState->execute([$libelle, $prix, $discount, $categorie, $description, $id]);
                    header('location:Products.php');
                }
            } else {
        ?>
                <div class="alert alert-danger">libelle, prix, and categorie are required</div>
        <?php
            }
        }
        ?>
        <h4>Edit Product</h4>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="hidden" class="form-control" id="id" name="id" value="<?= $product->id ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="libelle" class="form-label">Libelle</label>
                <input type="text" class="form-control" id="libelle" name="libelle" value="<?= $product->libelle ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" cols="30" rows="10"><?= $product->description ?></textarea>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix</label>
                <input type="number" name="prix" step="0.1" class="form-control" id="prix" min="0" value="<?= $product->prix ?>" />
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label">Discount</label>
                <input type="range" name="discount" class="form-control" id="discount" min="0" max="90" value="<?= $product->discount ?>" />
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image" />
            </div>
            <img width="250" src="upload/products/<?= $product->image ?>" class="img-fluid" alt="">
            <div class="mb-3">
                <label for="categorie" class="form-label">Categorie</label>
                <select name="categorie" class="form-select" id="">
                    <?php
                    $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_OBJ);
                    foreach ($categories as $category) {
                        $selected = $product->id_categorie == $category->id ? 'selected' : '';
                        echo "<option $selected value='{$category->id}'>{$category->libelle}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="EditProduct">Edit Product</button>
        </form>
    </div>
</body>

</html>