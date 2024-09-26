<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog-blade</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

    @if (collect($posts)->count() == 0)
        <h1>Nincsenek blogposztok</h1>        
    @else
        <h1>List of posts:</h1>
        @foreach ($posts as $post)
            <h2>{{$post['title']}}</h2>
            <p><strong><?=$post['author']?></strong></p>
            <p><i><?=$post['description']?></i></p>
            <p><a href="./blog.php?id=<?=$post['id']?>" >Részletek elolvasása</a></p>        
        @endforeach
    @endif

  </body>
</html>