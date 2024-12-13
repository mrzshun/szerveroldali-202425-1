<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Post;
use App\Models\Category;

final readonly class RelatedPosts
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $post = Post::findOrFail($args['id']);
        $categories = $post->categories;
        $relatedPosts = collect([]);
        $debug = "";
        foreach($categories as $c) {
            foreach($c->posts as $p) {
                $relatedPosts[$p->id] = $p;
            }
        }
        return $relatedPosts;
    }
}
