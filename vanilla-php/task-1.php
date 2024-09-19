<?php

  // Feladat: írjunk egy egyszerű PHP webalkalmazást, amely generál egy random nevet
  // és egy hozzá logikusan illeszkedő, a keresztnév első betűjéből és a vezetéknévből
  // álló email címet, majd írjuk ki ezt.

  $name = null;
  $email = null;
  function generateName() {
    $familyNames = ['Kovacs','Varga','Nemeth','Horvath'];
    $givenNames = ['Adam','Eva','Jakab','Jakabne','Gyozo','Erika'];
    return $familyNames[array_rand($familyNames)].' '.$givenNames[array_rand($givenNames)];
  }

  function generateEmail($name) {
    $emailEndings = ['gmail.com','example.com','yahoo.com'];
    $nameArray = explode(' ',$name);
    $simpleName = null;
    if(sizeof($nameArray) == 0) {
      $simpleName = 'jdoe';
    }
    elseif (sizeof($nameArray) == 1) {
      $simpleName = $nameArray[0];
    }
    else {
      $simpleName = substr($nameArray[1],0,1).$nameArray[0];
    }
    $simpleName = strtolower($simpleName);
    $email = $simpleName.'@'.$emailEndings[array_rand($emailEndings)];
    return $email;
  }

  $name = generateName();
  $email = generateEmail($name);

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
