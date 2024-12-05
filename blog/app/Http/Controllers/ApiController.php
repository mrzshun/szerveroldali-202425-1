<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class ApiController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
        ],[
            'required' => ':attribute megadása kötelező',
            'string' => ':attribute csak szöveg lehet',
            'email' => ':attribute csak helyesen formázott email lehet',
            'unique' => ':attribute email cím már foglalt',
        ],[
            'name' => 'A név',
            'email' => 'Az email',
            'password' => 'A jelszó',
        ]);
        if($validator->fails()) {
            return response()->json([
                'error' => $validator->messages(),
            ], 400);
        }
        $validated = $validator->validated();

        $user = User::create($validated);

        $token = $user->createToken($user->email);

        return response()->json([
            'token' => $token->plainTextToken,
        ]);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string',
        ],[
            'required' => ':attribute megadása kötelező',
            'string' => ':attribute csak szöveg lehet',
            'email' => ':attribute csak helyesen formázott email lehet',
        ],[
            'email' => 'Az email',
            'password' => 'A jelszó',
        ]);
        if($validator->fails()) {
            return response()->json([
                'error' => $validator->messages(),
            ], 400);
        }
        $validated = $validator->validated();
        $user = User::where('email',$validated['email'])->first();
        if(!$user) {
            return response()->json([
                'error' => 'hibás email cím',
            ],404);
        }
        if(Auth::attempt($validated)) {
            $token = $user->createToken($user->email,$user->admin ? ['blog:admin'] : []);
            return response()->json([
                'token' => $token->plainTextToken,
            ]);
        }
        else {
            return response()->json([
                'error' => 'hibás jelszó!',
            ],401);
        }
    }

    public function logout(Request $request) {
        $user = Auth::user();
        $request->user()->currentAccessToken()->delete();
        return response()->json([],204);
    }

    public function user(Request $request) {
        return $request->user();
    }

    public function getCategories(Request $request, string $id = null) {
        if(isset($id)) {
            return Category::findOrFail($id);
        }
        return Category::all();
    }

    public function store(StoreCategoryRequest $request) {
        $validated = $request->validated();
        $category = Category::factory()->create($validated);
        return response()->json($category,201);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'min:5',
                ],
                'style' => [
                    'required',
                    Rule::in(Category::$styles)
                ],
            ],
            [
                'name.required' => "A név megadása kötelező!"
            ]
        );
        $category = Category::findOrFail($id);
        $category->update($validated);
        return response()->json($category,201);
    }

    public function destroy(Request $request, $id) {
        if($request->user()->tokenCan('blog:admin')){
            $category = Category::findOrFail($id);
            $category->delete();
            return response(status: 204);            
        }
        return response()->json([
            'error' => 'Nincs jogosultságod a törléshez!',
        ],403);
    }

    public function getPosts(Request $request, string $id = null) {
        if(isset($id)) {
            return new PostResource(Post::with('categories')->with('author')->findOrFail($id));
        }
        return PostResource::collection(Post::with('categories')->with('author')->get());
    }

    public function postsPaginated(Request $request) {
        return new PostCollection(Post::with('author')->paginate(3));
    }

    public function storePost(StorePostRequest $request) {
        $validated = $request->validated();
        $cover_image_path = '';

        $post = Post::factory()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'text' => $validated['text'],
            'cover_image_path' => $cover_image_path === '' ? null : $cover_image_path,
            'author_id' => $request->user()->id,
        ]);
        isset($validated['categories']) ? $post->categories()->sync($validated['categories']) : "";
        return response(new PostResource($post->load('author')->load('categories')),201);
    }


    public function updatePost(UpdatePostRequest $request,$id) {
        $validated = $request->validated();
        $cover_image_path = '';
        $post = Post::findOrFail($id);

        $post->title = $validated['title'];
        $post->description = $validated['description'];
        $post->text = $validated['text'];
        $post->cover_image_path = ($cover_image_path === '' ? null : $cover_image_path);
        $post->save();
        isset($validated['categories']) ? $post->categories()->sync($validated['categories']) : "";

        return response(new PostResource($post->load('author')->load('categories')),201);
     }


}
