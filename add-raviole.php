<?php
    require_once 'bdd-connection.php';
    require_once 'composants/functions.php';
    $errors = [];
    $imageUrl = null;
    if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
        $returnValidation = validateForm();
        $errors = $returnValidation['errors'];

        if( count($errors) === 0) {
            addRaviole($pdo, $returnValidation['img']);
            header('Location: index.php');
        }
    }
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

<div class="container">

    <h3 class="text-uppercase font-weight-bold text-success text-center">Ajouter une recette</h3>

    <form method="post" action="add-raviole.php" enctype="multipart/form-data">
        <label class="mt-5" for="title">Titre de la recette</label>
        <input name="title" id="title" class="form-control" placeholder="exemple : ravioles au thon" required>
        
        <label class="mt-5" for="description">Description de la recette</label>
        <textarea class="form-control" id="description" placeholder="description de la recette" required></textarea>

        <div class="input-group mt-5">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="img" name="img" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="img">choisir une image</label>
            </div>
        </div>

        <div class="mt-5 text-center">
            <button class="btn btn-success rounded-pill" type="submit">Ajouter la recette</button>
        </div>        

        <?php
            if(count($errors) != 0){
                echo(' <h5>Erreur(s) lors de la validation des éléments : </h5>');
                foreach ($errors as $error){
                    echo('<div class="error">'.$error.'</div>');
                }
            }
        ?>
    </form>
</div>

<?php
    require_once 'composants/bottom.php';
?>
</body>
</html>
