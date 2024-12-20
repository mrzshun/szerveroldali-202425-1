<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public static $styles = ['primary', 'secondary','success', 'danger', 'warning', 'info', 'dark'];

    protected $fillable = ['name','style'];
}
