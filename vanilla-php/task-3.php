<?php

    // Feladat: generáljunk random mennyiségű, de minimum 20 maximum 100 db. blogposztot
    // Egy blogposzt álljon az alábbiakból: id, title, author, description, text
    // A blogposztokat írjuk ki webfelületre.

    require_once 'vendor/autoload.php';
    $faker = Faker\Factory::create();

    $blogposts = [];
    $postNum = $faker->numberBetween(20, 100);
    for($i=0; $i<$postNum; $i++) {
        $blogposts[$i] = [
            'id' => $faker->unique()->numberBetween(1, 10000),
            'title' => $faker->sentence(5),
            'author' => $faker->name(),
            'description' => $faker->sentences(3,true),
            'text' => $faker->paragraphs(3,true),
        ];
    }
  ?>
  
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Szerveroldali - task-3</title>
      <link rel="stylesheet" href="style.css">
    </head>
    <body>
      <h1>Generate blogposts</h1>
      <pre>
        <?php
            echo json_encode($blogposts, JSON_PRETTY_PRINT);
        ?>
      </pre>
    </body>
  </html>
  