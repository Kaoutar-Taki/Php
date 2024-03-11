<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ktaki</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container py-2">
        <?php
            if (isset($_POST['add'])){
                $login = $_POST['login'];
                $password = $_POST['password'];
                if (!empty($login) && !empty($password)){
                    require_once 'include/database.php';
                    $date_creation = date('Y-m-d H:i:s');
                    $sqlState = $pdo->prepare('INSERT INTO utilisateur VALUE(null,?,?,?)');
                    $sqlState->execute([$login, $password, $date_creation]);
                    //Redirect
                    header('location: connexion.php');
                }
                else{
                    ?>
                        <div class="alert alert-danger" role="alert">login and password is required</div>
                    <?php
                }
            }
        ?>
        <h4>Add User</h4>
        <form action="" method="post">
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" class="form-control" id="login" name="login">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary" name="add">Add User</button>
        </form>
    </div>
</body>
</html>