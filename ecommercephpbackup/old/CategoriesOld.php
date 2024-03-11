<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ktaki | List Categories</title>
</head>

<body>
    <?php include 'include/nav.php' ?>
    <div class="container py-2">
        <h4>List Categories</h4>
        <a class="link-opacity-75-hover btn btn-primary" href="addCategory.php">Add Category</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Libelle</th>
                    <th scope="col">Description</th>
                    <th scope="col">Icon</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    require_once 'include/database.php';
                     $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
                    foreach($categories as $categorie){
                        ?>
                            <tr>
                                <th ><?= $categorie['id'] ?></th>
                                <td><?= $categorie['libelle'] ?></td>
                                <td><?= $categorie['description'] ?></td>
                                <td><i class="<?= $categorie['icon'] ?>"></i></td>
                                <td><?= $categorie['date_creation'] ?></td>
                                <td>
                                    <a href="editCategory.php?id=<?= $categorie['id'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="deleteCategory.php?id=<?= $categorie['id']?>" onclick="return confirm('Are you sure to delete this category : <?= $categorie['libelle'] ?>?')" class="btn btn-danger">Delete</a>
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