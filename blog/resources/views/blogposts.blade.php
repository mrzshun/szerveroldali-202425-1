<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>B logposts</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    @empty($posts->toArray())
       <h1>Nincsenek blogpostok</h1>    
    @else
        <h1>Minden blogpost</h1>
        @foreach ($posts as $post)
            <h2>{{$post->title}}</h2>
            <cite>{{$post->author->name}}</cite>
            <p><strong>Tags:</strong>
                @foreach ($post->categories as $postcat)
                    <span style="color:{{$postcat->txt_color}};background-color:{{$postcat->bg_color}}">{{$postcat->name}}</span>&nbsp;
                @endforeach
            </p>
            <p><strong>{{$post->description}}</strong></p>
            <a href="/post/{{$post->id}}">Details >></a>
        @endforeach
    @endempty
</body>
</html>
