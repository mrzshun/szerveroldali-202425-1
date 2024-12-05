<?php

use App\Http\Controllers\ApiController;
use App\Http\Middleware\ValidateURIParams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register',     [ApiController::class,'register'])  ->name('api.register');
Route::post('login',        [ApiController::class,'login'])     ->name('api.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout',           [ApiController::class,'logout'])    ->name('api.logout');
    Route::post('user',             [ApiController::class,'user'])      ->name('api.user');

    Route::post('categories',       [ApiController::class,'store'])                             ->name('api.categories.store');    
    Route::put('categories/{id}',   [ApiController::class,'update'])    ->where('id','[0-9]+')  ->name('api.categories.update');    
    Route::delete('categories/{id}',[ApiController::class,'destroy'])   ->where('id','[0-9]+')  ->name('api.categories.destroy');

    Route::post('posts',            [ApiController::class,'storePost'])                         ->name('api.categories.storePost');    
    Route::put('posts/{id}',        [ApiController::class,'updatePost'])->where('id','[0-9]+')  ->name('api.categories.updatePost');

    // HF: végpont, amely lekéri azokat a usereket, akiknek van posztja az adott kategóriában
    Route::get('usersByCat',        [ApiController::class, 'usersByCat'])                       ->name('api.posts.usersByCat');

});


Route::get('categories/{id?}',  [ApiController::class, 'getCategories'])->where('id','[0-9]+')  ->name('api.categories.getCategories');

Route::get('posts/{id?}',       [ApiController::class, 'getPosts'])->where('id','[0-9]+')       ->name('api.posts.getPosts');
Route::get('postsPaginated',    [ApiController::class, 'postsPaginated'])                       ->name('api.posts.postsPaginated');

// HF: related posts végpont, amely lekéri egy post id-ja alapján azokat a postokat, amelyeknek van közös kategóriája az id által meghatározott posttal.
Route::get('relatedPosts/{id}', [ApiController::class, 'relatedPosts'])->where('id','[0-9]+')   ->name('api.posts.relatedPosts');



// Route::get('uri-params1/{number}/{string}/{optional?}',function ($number,$string,$optional = null){
//     return response()->json([
//         'number' => $number,
//         'string' => $string,
//         'optional' => $optional,
//     ]);
// })->where('number','[0-9]+')->where('string','[a-zA-Z]+');

// Route::get('uri-params2/{number}/{string}/{optional?}',function ($number,$string,$optional = null){
//     return response()->json([
//         'number' => $number,
//         'string' => $string,
//         'optional' => $optional,
//     ]);
// })->middleware(ValidateURIParams::class);


// Route::get('uri-params3/{number}/{string}/{optional?}',function ($number,$string,$optional = null){    
//     $errors = [];
//     if(!filter_var($number, FILTER_VALIDATE_INT)){
//         $errors['number'] = 'A $number-nek pozitív egész számnak kell lennie';
//     }
//     if(!is_string($string)){
//         $errors['string'] = 'A $number-nek szövegnek kell lennie';
//     }
//     if(empty($errors)) {
//         return response()->json([
//             'number' => $number,
//             'string' => $string,
//             'optional' => $optional,
//         ]);
//     }
//     return response()->json($errors,418);
// })->middleware(ValidateURIParams::class);

