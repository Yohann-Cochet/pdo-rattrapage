<?php
require_once 'bdd-connection.php';
require_once 'composants/functions.php';
$idRaviole = $_GET['id'];
$raviole = getRaviole($pdo, $idRaviole);
$errors = [];
$imageUrl = null;
if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
    $ok = validateEditForm();
    $errors = $ok['errors'];
    $imageUrl = $ok['img'];

    if( count($errors) === 0) {
        updateRaviole($pdo, $imageUrl, $raviole['id']);
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

<div style="text-align: center">

    <h3 class="text-uppercase font-weight-bold text-success text-center">Éditer la recette</h3>

    <form method="post" action="edit-raviole.php?id=<?php echo($raviole['id']);?>" enctype="multipart/form-data">
        <label class="mt-5" for="title">Titre de la recette</label>
        <input value="<?php echo($raviole['title']) ?>" name="title" id="title" class="form-control" placeholder="exemple : ravioles au thon" required>
        
        <label class="mt-5" for="description">Description de la recette</label>
        <textarea value="<?php echo($raviole['description']) ?>" class="form-control" id="description" placeholder="description de la recette" required></textarea>

        <div class="input-group mt-5">
            <div class="custom-file">
                <img src="<?php echo('img-recettes/'.$raviole['img']);?>">
                <input value="<?php echo($raviole['img']) ?>" type="file" class="custom-file-input" id="img" name="img" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="img">changer l'image</label>
            </div>
        </div>

        <div class="mt-5 text-center">
            <button class="btn btn-success rounded-pill" type="submit">Enregistrer la recette</button>
        </div>  

    </form>

    <?php
        if(count($errors) != 0){
            echo(' <h5>Erreur(s) lors de la validation des éléments : </h5>');
            foreach ($errors as $error){
                echo('<div class="error">'.$error.'</div>');
            }
        }
    ?>

</div>

<?php
    require_once 'composants/bottom.php';
?>
</body>
</html>
