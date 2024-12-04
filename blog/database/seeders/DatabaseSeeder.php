<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin Béla',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'admin' => true,
        ]);
        $users = User::factory(10)->create();
        $posts = Post::factory(10)->create();
        $categories = Category::factory(10)->create();

        foreach($posts as $post) {
            if(rand(1,10)>5) {
                $post->author()->associate($users->random())->save();
            }
            $post->categories()->sync(
                $categories->random(rand(1,$categories->count()))
            );
        }

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
