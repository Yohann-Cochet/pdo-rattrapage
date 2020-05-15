<?php

    function getRaviole($pdo,$id)
    {
        $res = $pdo -> prepare('SELECT * FROM recettes WHERE id = :id');
        $res -> execute(['id' => $id]);
        return $res -> fetch();
    }

    function deleteRaviole($pdo, $id)
    {
        $res = $pdo -> prepare('DELETE FROM recettes WHERE id = :id');
        $res -> execute(['id' => $id]);
    }

    function addRaviole($pdo, $imageUrl){
        $req = $pdo -> prepare(
            'INSERT INTO recettes(title, description, date_added , img)
            VALUES(:title, :description, :date_added, :img)');
        $req->execute([
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'date_added' => new DateTime(),
            'img' => $imageUrl
        ]);
    }

    function updateRaviole($pdo, $imageUrl, $id){
        if(!is_null($imageUrl)){
            $req = $pdo -> prepare('UPDATE recettes SET title = :title, description = :description, img = :img WHERE id = :id');
            $req->execute([
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'img' => $imageUrl,
                'id'=> $id
            ]);
        } else {
            $req = $pdo->prepare('UPDATE recettes SET name = :name, status = :status , terrain = :terrain , allegiance = :allegiance , key_fact = :key_fact , status = :status WHERE id = :id');
            $req->execute([
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'id'=> $id
            ]);
        }
    }

    function validateForm() {
        $errors = [];
        if($_FILES['img']['size'] == 0){
            $errors[] = 'Veuillez ajouter une image';
        }
        if($_FILES['img']['type'] === 'img/png'){
            if($_FILES['img']['size']<80000){
                $extension = explode('/', $_FILES['img']['type'])[1];
                $imageUrl = uniqid().'.'.$extension;
                move_uploaded_file($_FILES['img']['tmp_name'], 'img-recettes/'.$imageUrl);
            } else {
                $errors[] = 'Fichier trop volumineux';
            }
        } else {
            $errors[] = 'Fichier .png requis';
        }
        
        if (empty($_POST['title'])) {
            $errors[] = 'Titre de recette requis';
        }

        if ( empty($_POST['description'])) {
            $errors[] = 'Description requise';
        }

        return ['errors' => $errors, 'img'=>$imageUrl];
    }

    function validateEditForm() {
        $errors = [];
        $imageUrl = '';

        if($_FILES['img']['size'] != 0) {

            if ($_FILES['img']['type'] === 'img/png') {
                if ($_FILES['img']['size'] < 80000) {
                    $extension = explode('/', $_FILES['img']['type'])[1];
                    $imageUrl = uniqid() . '.' . $extension;
                    move_uploaded_file($_FILES['img']['tmp_name'], 'img-recettes/' . $imageUrl);
                } else {
                    $errors[] = 'Fichier trop volumineux';
                }
            } else {
                $errors[] = 'Fichier .png requis';
            }
        }

        if (empty($_POST['title'])) {
            $errors[] = 'Titre de recette requis';
        }

        if ( empty($_POST['description'])) {
            $errors[] = 'Description requise';
        }
        
        return ['errors'=>$errors, 'img'=>$imageUrl];
    }

?>