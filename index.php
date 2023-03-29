<?php

require_once 'connec.php';
$pdo = new PDO(DSN, USER, PASS);
$query = "SELECT * FROM album";
$statement = $pdo->query($query);
$albums = $statement->fetchAll(PDO::FETCH_OBJ);

// var_dump($albums);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="navbar">
            <button type="button">Ajouter</button>
            <img src="https://www.stars-music.fr/medias/native-instruments/cropped-traktor-scratch-vinyl-rouge-mkii.jpg" alt="Image de vynil rouge">
    </header>
    <main>
        <?php foreach ($albums as $album) { ?>
            <article class="card">
                <img src=<?php echo $album->image ?> alt="image" class="image" width="200">
                <div class="textContent">
                    <h2> <?php echo $album->title ?> </h2>
                    <h3> <?php echo $album->artist ?> </h3>
                    <h3> <?php echo $album->genre ?></h3>
                </div>
            </article>
        <?php } ?>
    </main>
</body>

</html>