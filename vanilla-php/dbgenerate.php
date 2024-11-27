<?php

    require_once 'vendor/autoload.php';
    $databaseDirectory = __DIR__ . "/database";

    $newsStore = new \SleekDB\Store("news", $databaseDirectory);
    $faker = Faker\Factory::create();

    $blogpost = [];
    $postNum = $faker->numberBetween(20, 100);

    for($i=0; $i<$postNum; $i++) {
        $blogpost = [
            'id' => $faker->unique()->numberBetween(1, 10000),
            'title' => $faker->sentence(5),
            'author' => $faker->name(),
            'description' => $faker->sentences(3,true),
            'text' => $faker->paragraphs(3,true),
        ];
        $results = $newsStore->insert($blogpost);
    }
    echo $postNum;

?>