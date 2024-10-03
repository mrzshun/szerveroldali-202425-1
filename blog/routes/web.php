<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/posts', function () {
    return view('blogposts', [
        'posts' => Post::all(),
    ]);
});


Route::get('/post/{id}', function ($id) {
    return view('blogpost', [
        'post' => Post::find($id),
        'id' => $id
    ]);
});
