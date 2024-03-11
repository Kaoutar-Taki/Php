<?php
    require_once 'include/database.php';
    $id = $_GET['id'];
    $sqlState = $pdo->prepare("DELETE FROM produit WHERE id = ?");
    $sqlState->execute([$id]);
    header('Location: Products.php');
