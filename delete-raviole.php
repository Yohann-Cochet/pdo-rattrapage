<?php
    require_once 'bdd-connection.php';
    require_once 'functions.php';
    $id = $_GET['id'];
    deleteRaviole($pdo, $id);
    header('Location: index.php');
?>