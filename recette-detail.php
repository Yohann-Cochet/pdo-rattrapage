<?php
require_once 'bdd-connection.php';
require_once 'composants/functions.php';
?>
<html>
<head>
    <head>
        <?php
        require_once 'composants/head.php';
        ?>
    </head>
</head>
<body>

    <?php
    include 'composants/navbar.php';
    ?>

    <div style="text-align: center">
    <?php
    $res = $pdo -> prepare('SELECT * FROM recettes WHERE id = :id');
    $res -> execute(['id'=> $_GET['id']]);
    $fetchRes = $res -> fetch();
    ?>

        <h1><?php echo($fetchRes['title']) ?></h1><br>
        <img  src="<?php echo('img-recettes'.$fetchRes['img']); ?>" alt="Recette de <?php echo($fetchRes['name']); ?>" >
        <h2>Date de création : <?php echo($fetchRes['date_added']) ?></h2>
        <h2>Description : <?php echo($fetchRes['description']) ?></h2>
        
        <?php $res->closeCursor(); ?>
    </div>

    <?php
        require_once 'composants/bottom.php';
    ?>
</body>
</html>
