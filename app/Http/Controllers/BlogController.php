<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function categoryPost(Request $request, $slug)
    {
        if(!$slug)
        {
            abort(404);
        }else{
            $subcategory = Subcategory::where('slug',$slug)->first();
            if(!$subcategory)
            {
                abort(404);
            }else{
                $posts = Post::where('category_id', $subcategory->id)->orderBy('created_at', 'desc')->paginate(3);
                $data = [
                    'pageTitle' => 'Category - '.$subcategory->subcategory_name,
                    'category' => $subcategory,
                    'posts' => $posts
                ];
                return view('front.pages.category_posts', $data);
            }
        }

    }

    public function searchPost(Request $request)
    {
        $query = request()->query('query');
        if($query && strlen($query) >= 2)
        {
            $searchValues = preg_split('/\s+/', $query, -1, PREG_SPLIT_NO_EMPTY);
            $posts = Post::query();

            $posts->where(function($q) use ($searchValues){
                foreach($searchValues as $value)
                {
                    $q->orWhere('post_title', 'like', "%{$value}%");
                    $q->orWhere('post_tags', 'like', "%{$value}%");
                    $q->orWhere('post_content', 'like', "%{$value}%");
                }
            });

            $posts = $posts->with('subcategory')
                            ->with('author')
                            ->orderBy('created_at', 'desc')
                            ->paginate(3);

                            $data = [
                'pageTitle' => 'Search for :: '.request()->query('query'),
                'posts' => $posts
            ];

            return view('front.pages.search_blog', $data);
        }else{
            abort(404);
        }
    }

    public function readPost($slug)
    {
        if(!$slug)
        {
            return abort(404);
        }else{
            $post = Post::where('post_slug', $slug)
                          ->with('subcategory')
                          ->with('author')
                          ->first();
            $post_tags = explode(',', $post->post_tags);
            $related_posts = Post::where('id', '!=', $post->id)
                                   ->where(function($query) use ($post_tags, $post){
                                        foreach($post_tags as $item)
                                        {
                                            $query->orWhere('post_tags', 'like', "%$item%")
                                                  ->orWhere('post_title', 'like', $post->post_title)
                                                  ->orWhere('post_content', 'like', $post->post_content);
                                        }
                                   })
                                   ->inRandomOrder()
                                   ->take(3)
                                   ->get();

            $data = [
                'pageTitle' => Str::ucfirst($post->post_title),
                'related_posts' => $related_posts,
                'post' => $post
            ];
            return view('front.pages.single_post', $data);
        }
    }

    public function tagPosts(Request $request, $tag)
    {
        $posts = Post::where('post_tags', 'like', '%'.$tag.'%')
                       ->with('subcategory')
                       ->with('author')
                       ->orderBy('created_at', 'desc')
                       ->paginate(6);

        if(!$posts){return abort(404);}

        $data = [
            'pageTitle' => '#'.$tag,
            'posts' => $posts
        ];

        return view('front.pages.tags_posts', $data);
    }
}
