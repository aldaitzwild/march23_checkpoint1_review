<?php

$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $album = array_map('trim', $_POST);
    
   if(!isset($album['title']) || empty($album['title']))
        $errors[] = "Le nom d'album est obligatoire";

    if(!isset($album['artist']) || empty($album['artist']))
        $errors[] = "Le nom de l'artiste est obligatoire";

    if(!isset($album['genre']) || empty($album['genre']))
        $errors[] = "Le genre est obligatoire";

    if(isset($album['genre']) && $album['genre'] == 'disco')
        $errors[] = "Le genre disco n'est pas un genre";
    
    if(!filter_var($album['image'], FILTER_VALIDATE_URL))
        $errors[] = "L'URL de l'image n'est pas valide";

        if(empty($errors)) {

            require_once 'connec.php';
            $connection = new \PDO(DSN, USER, PASS);


            $query = "INSERT INTO album (title, artist, genre, image)
            VALUES (:title, :artist, :genre, :image)";

    
            $statement = $connection->prepare($query);

            $statement->bindValue(':title', $album['title'], PDO::PARAM_STR);
            $statement->bindValue(':artist', $album['artist'], PDO::PARAM_STR);
            $statement->bindValue(':genre', $album['genre'], PDO::PARAM_STR);
            $statement->bindValue(':image', $album['image'], PDO::PARAM_STR);

            $statement->execute();
    /*
            header("location: index.php");*/
            die();

}
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style_form.css">
    <title>Formulaire Ajout Album</title>

</head>
<body>

    <main>
        <div class="errorPanel">
        <?php
        if(!empty($errors)) { ?>
           <p>Nous rencontrons les problèmes suivants pour traiter votre demande : </p>
            <ul>
                <?php foreach($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
             <?php } ?>
        </div>
        <form  action="" method="POST">
            <div>
                <label for="title">Titre :</label>
                <input type="text" id="title" name="title">
            </div>

            <div>
                <label for="artist">Artist : </label>
                <input type="text" id="artist" name="artist">
            </div>

            <div>
                <label for="genre">Genre :</label>
                <select name="genre" id="genre">
                    <option value=rock>Rock</option>
                    <option value=rap>Rap</option>
                    <option value=disco>Disco</option>
                    <option value=country>Country</option>
                </select>
              </div>
              <div>
                <label for="image"> Lien de l'image : </label>
                <input type="url" name="image" id="image">
                </div>
            <div class="buttonLine">
                <button type="submit">Send</button>
            </div>
        </form>
    </main>
    
</body>
</html>