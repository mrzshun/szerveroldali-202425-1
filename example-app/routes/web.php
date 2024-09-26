<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('blog', [  
       'posts' => [
            [
                'id' => 771,
                'title' => "Title",
                'description' => "Description",
                'author' => "Author",
                'text' => "Text",
            ],
            [
                'id' => 772,
                'title' => "Title",
                'description' => "Description",
                'author' => "Author",
                'text' => "Text",
            ],
       ]
    ]);
});
