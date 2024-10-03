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
    <h1>{{$post->title}}</h1>
    <p>ID: {{$id}}</p>
    <cite>{{$post->author->name}}</cite>
    <p><strong>Tags:</strong>
        @foreach ($post->categories as $postcat)
            <span style="color:{{$postcat->txt_color}};background-color:{{$postcat->bg_color}}">{{$postcat->name}}</span>&nbsp;
        @endforeach
    </p>
    <p><strong>{{$post->description}}</strong></p>
    <p>{{$post->text}}</p>
    <a href="/posts">Back</a>
  </body>
</html>
