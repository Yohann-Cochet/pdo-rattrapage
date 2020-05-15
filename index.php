<?php
require_once 'bdd-connection.php';
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
    require_once 'composants/navbar.php';
?>

<section class="fullScreen accueil">
    <div class="container w-100 h-100 d-flex flex-column justify-content-center align-items-start">
        <h1 class="text-black">Les ravioles<br>les plus chaudes<br>de votre région !</h1>
        <a href="#list-ravioles"><button type="button" class="btn btn-dark rounded-pill px-5 my-5">Voir la liste</button></a>
    </div>
</section>

<section class="fullScreen" id="list-ravioles">
    <div class="container w-100 h-100 d-flex flex-column justify-content-center align-items-start">
        <h2 class="h1">Nos recettes de ravioles</h2>

        <table class="table">

            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Date de création</th>
                <th scope="col">Édition</th>
            </tr>
            </thead>

            <tbody>
            <?php
                $reponse = $pdo -> query('SELECT * FROM recettes');
                while ($data = $reponse -> fetch()) {
            ?>
                    <tr>
                        <td><?php echo($data['id']); ?></td>
                        <td><?php echo($data['title']); ?></td>
                        <td><?php echo($data['description']); ?></td>
                        <td>
                            <img style="max-width: 140px;" src="<?php echo('img-recettes/'.$data['img']); ?>" alt="Image de la recette <?php echo($data['title']); ?>"/>
                        </td>
                        <td><?php echo($data['date_added']); ?></td>
                        <td>
                            <a title="Voir le détail" href="recette-detail.php?id=<?php echo($data['id']); ?>">
                                <p>voir</p>
                            </a>

                            <a title="Editer" href="edit-raviole.php?id=<?php echo($data['id']); ?>">
                                <p>éditer</p>
                            </a>

                            <a title="Supprimer" href="delete-raviole.php?id=<?php echo($data['id']);?>">
                                <p>supprimer</p>
                            </a>
                        </td>


                    </tr>
            <?php
                }
                $reponse->closeCursor();
            ?>

            </tbody>
        </table>
    </div>
    

</section>

<?php
    require_once 'composants/bottom.php';
?>
</body>
</html>
