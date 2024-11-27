<?php

  // Feladat: írjunk egy egyszerű PHP webalkalmazást, amely generál egy random nevet
  // és egy hozzá logikusan illeszkedő, a keresztnév első betűjéből és a vezetéknévből
  // álló email címet, majd írjuk ki ezt. A generáláshoz használjunk faker-t.

  require_once 'vendor/autoload.php';
  $name = null;
  $email = null;
  $faker = Faker\Factory::create();

  $name = $faker->name();
  $email = $faker->email();

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
    <h1>Generate name</h1>
    <p>
        The generated name is: <?php echo $name ?>, the email address is <?php echo $email ?>.
    </p>
  </body>
</html>
