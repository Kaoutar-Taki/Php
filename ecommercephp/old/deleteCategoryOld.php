<?php
    require_once 'include/database.php';
    $id = $_GET['id'];
    $sqlState = $pdo->prepare("DELETE FROM categorie WHERE id = ?");
    $sqlState->execute([$id]);
    header('Location: Categories.php');
