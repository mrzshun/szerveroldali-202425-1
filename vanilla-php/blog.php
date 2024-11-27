<?php

    // Feladat: olvassuk be a blogposztokat a sleekDB-ből
    // listázzuk ki a blogposztokat a címükkel, szerzőjükkel és összefoglalójukkal
    // és linkeljünk a blogposzt végoldalára. Ha a GET mezőben kapunk egy ID-t,
    // akkor keressük meg, hogy van-e olyan blogposzt az adatbázisban és ha igen, akkor azt jelenítsük meg.
    // ha nincs, jelezzük, hogy az adott ID-val nem szerepel poszt az "adatbázisban"

    // fel kell építeni az adatbáziskapcsolatot
    // megnézni, hogy adott-e get mezőben az ID - isses($_GET['id'])
    // végigiterálunk a betöltött JSON-on és keressük az ID-t
    // ha nem találjuk ($post == null, erre inicializálunk), akkor unknown, ha megtaláljuk, akkor létrehozzuk a $post-ot
    // a html-ben pedig megnézzük, hogy volt-e ID, ha igen, akkor $post alapján kiírjuk annak adatait, vagy azt, hogy nem volt ilyen blogposzt
    // ha nem volt ID, akkor listázzuk az összeset.

    require_once 'vendor/autoload.php';
    $databaseDirectory = __DIR__ . "/database";
    $blogStore = new \SleekDB\Store("news", $databaseDirectory);
    
    $blogposts = [];
    $postById = null;
    $blogposts = $blogStore->findAll();

    if(isset($_GET['id'])) {
        $postById = $blogStore->findById($_GET['id']);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Szerveroldali - task-1</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php if($postById): ?>
        <h1>The requested blogpost:</h1>
        <h2><?=$postById['title']?></h2>
        <p><strong><?=$postById['author']?></strong></p>
        <p><i><?=$postById['description']?></i></p>
        <p><?=$postById['text']?></p>
        <p><a href="./blog.php">Vissza</a></p>
    <?php else: ?>
        
        <?php if(isset($_GET['id'])): ?>
            <p>Nem létezik blogpost <?=$_GET['id'] ?> ID-val! </p>
        <?php endif; ?>

        <h1>List of posts:</h1>
        <?php foreach($blogposts as $post): ?>
            <h2><?=$post['title']?></h2>
            <p><strong><?=$post['author']?></strong></p>
            <p><i><?=$post['description']?></i></p>
            <p><a href="./blog.php?id=<?=$post['_id']?>" >Részletek elolvasása</a></p>
        <?php endforeach; ?>
    <?php endif; ?>
  </body>
</html>