<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    header("Location: ../connexion.php");
}
$id = $_POST['id'];
$Quantity = $_POST['Quantity'];
$idUser = $_SESSION['utilisateur']['id'];
if (!isset($_SESSION['cart'][$idUser])) {
    $_SESSION['cart'][$idUser] = [];
}
$_SESSION['cart'][$idUser][$id] = $Quantity;

header("Location: product.php?id=$id");
