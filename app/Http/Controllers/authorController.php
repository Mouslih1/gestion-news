<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Setting;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class authorController extends Controller
{
    public function index(Request $request)
    {
        $authors = User::where('type',2)->get();
        $admins = User::where('type',1)->get();
        $users = User::get();
        $authorsBlocked = User::where('blocked','like',1)->get();
        $posts = Post::all();
        $category = Category::all();
        $subcategory = Subcategory::all();
        //$authorspaginate = User::paginate(5);
        $MonthPost = Carbon::now()->format('m-Y');
        $YearPost = Carbon::now()->format('Y');
       // $postToday = Post::whereDate('created_at', $todayPost)->get();
        $postToday = Post::whereDate('created_at', today())->get();
        $postMonth = Post::whereMonth('created_at', $MonthPost)->get();
        $postYear = Post::whereYear('created_at', $YearPost)->get();
        //dd($postYear);
        //dd($postToday);
        return view('back.pages.home', compact('postYear','postMonth','postToday','users','admins','authors', 'authorsBlocked', 'posts', 'category', 'subcategory'));
    }



    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('author.login');
    }

    public function resetForm(Request $request, $token = null)
    {
        $data = array(
            'pageTitle' => 'Reset password',
        );
        return view('back.pages.auth.reset', $data)->with(['token' => $token, 'email' => $request->email]);
    }

    public function changePictureProfil(Request $request)
    {
        $user = User::find(auth('web')->id());
        $path = 'back/dist/img/authors/';
        $file = $request->file('file');
        $old_picture = $user->getAttributes()['picture'];
        $file_path = $path.$old_picture;
        $new_picture_name = 'AIMG'.$user->id.time().rand(1,100000).'.jpg';

        if($old_picture != null && File::exists(public_path($file_path)))
        {
            File::delete(public_path($file_path));
        }

        $upload = $file->move(public_path($path), $new_picture_name);

        if($upload)
        {
            $user->update([
                'picture' => $new_picture_name
            ]);
            return response()->json(['status' => 1, 'msg' => 'Your profile picture has been updated successfully']);
        }else{
            return response()->json(['status' => 0, 'Something went wrong']);
        }

    }

    public function changeBlogLogoForm(Request $request)
    {
        $settings = Setting::find(2);
        $path = 'back/dist/img/logo-favicon/';
        $file = $request->file('blog_logo');
        $old_logo = $settings->getAttribute('blog_logo');
        $file_path = $path.$old_logo;
        $new_logo_name = time().'_'.rand(1,100000).'_newsz_logo.png';

        if($request->hasFile('blog_logo'))
        {
           if($old_logo != null && File::exists(public_path($file_path)))
           {
                File::delete(public_path($file_path));
           }

            $upload = $file->move(public_path($path), $new_logo_name);
            if($upload)
            {
                $settings->update([
                    'blog_logo' => $new_logo_name
                ]);
                return response()->json(['status' => 1, 'msg' => 'NewsZ logo has been successfully updated']);
            }else{
                return response()->json(['status' => 0, 'Somthing went wrong']);
            }
        }
    }

    public function changeBlogFaviconForm(Request $request)
    {
        $settings = Setting::find(2);
        $path = 'back/dist/img/logo-favicon/';
        $file = $request->file('blog_favicon');
        $old_favicon = $settings->getAttribute('blog_favicon');
        $file_path = $path.$old_favicon;
        $new_favicon_name = time().'_'.rand(1,2000).'_newsz_favicon.ico';

        if($old_favicon != null && File::exists(public_path($file_path)))
        {
            File::delete(public_path($file_path));
        }

        $upload = $file->move(public_path($path), $new_favicon_name);
        if($upload)
        {
            $settings->update([
                'blog_favicon' => $new_favicon_name
            ]);
            return response()->json(['status' => 1 , 'msg' => 'NewsZ favicon has been succesfully updated']);
        }else{
            return response()->json(['status' => 0 , 'Something went wrong']);
        }
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'post_title' => 'required|unique:posts,post_title',
            'post_content' => 'required',
            'post_category' => 'required|exists:subcategories,id',
            'featured_image' => 'required|mimes:jpeg,jpg,png|max:1025',
        ]);

        if($request->hasFile('featured_image'))
        {
            $path = 'images/post_images/';
            $file = $request->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $new_file_name = time().'_'.$file_name;

            $upload = Storage::disk('public')->put($path.$new_file_name, (string) file_get_contents($file));

            $post_thumbnails_path = $path.'thumbnails';
            if(!Storage::disk('public')->exists($post_thumbnails_path)){
                Storage::disk('public')->makeDirectory($post_thumbnails_path, 0755, true, true);
            }
            Image::make(storage_path('app/public/'.$path.$new_file_name))
                    ->fit(200, 200)
                    ->save(storage_path('app/public/'.$path.'thumbnails/'.'thumb_'.$new_file_name));
            Image::make(storage_path('app/public/'.$path.$new_file_name))
                    ->fit(500, 350)
                    ->save(storage_path('app/public/'.$path.'thumbnails/'.'resized_'.$new_file_name));

            if($upload)
            {
                $post = new Post();
                $post->author_id = auth()->id();
                $post->post_title = $request->post_title;
                //$post->post_slug = Str::slug($request->post_title);
                $post->post_content = $request->post_content;
                $post->category_id = $request->post_category;
                $post->post_tags = $request->post_tags;
                $post->featured_image = $new_file_name;
                $saved = $post->save();

                if($saved)
                {
                    return response()->json(['code' => 1, 'msg' => 'New post has been successfully added']);
                }else{
                    return response()->json(['code' => 3, 'msg' => 'Something went wrong in saving data !']);

                }



            }else{
                return response()->json(['code' => 3, 'msg' => 'Something went wrong for uploading featured image']);
            }
        }

    }

    public function editPost(Request $request)
    {
        if(!$request->post_id)
        {
            abort(404);
        }
        $post = Post::find($request->post_id);
        $data = [
            'post' => $post,
            'pageTitle' => 'Edit post',
        ];
        return view('back.pages.edit-posts', $data);
    }

    public function updatePost(Request $request)
    {
        if($request->hasFile('featured_image'))
        {
            $request->validate([
                'post_title' => 'required|unique:posts,post_title,'.$request->post_id,
                'post_content' => 'required',
                'post_category' => 'required',
                'featured_image' => 'mimes:jpeg,jpg,png|max:1024',
            ]);

            $path = 'images/post_images/';
            $file = $request->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $new_file_name = time().'_'.$file_name;

            $upload = Storage::disk('public')->put($path.$new_file_name, (string) file_get_contents($file));

            $post_thumbnails_path = $path.'thumbnails';
            if(!Storage::disk('public')->exists($post_thumbnails_path))
            {
                Storage::disk('public')->makeDirectory($post_thumbnails_path, 0755, true, true);
            }

            Image::make(storage_path('app/public/'.$path.$new_file_name))
                   ->fit(200, 200)
                   ->save(storage_path('app/public/'.$path.'thumbnails/'.'thumb_'.$new_file_name));

            Image::make(storage_path('app/public/'.$path.$new_file_name))
                   ->fit(500, 350)
                   ->save(storage_path('app/public/'.$path.'thumbnails/'.'resized_'.$new_file_name));

            if($upload)
            {
                $old_post_image = Post::find($request->post_id)->featured_image;
                if ($old_post_image != null && Storage::disk('public')->exists($path.$old_post_image))
                {
                    //dd([$path.$old_post_image, $path.'thumbnails/resized_'.$old_post_image, $path.'thumbnails/thumb_'.$old_post_image]);
                    Storage::disk('public')->delete([$path.$old_post_image, $path.'thumbnails/resized_'.$old_post_image, $path.'thumbnails/thumb_'.$old_post_image]);
                }

                $post = Post::find($request->post_id);
                $post->category_id = $request->post_category;
                $post->post_title = $request->post_title;
                $post->post_slug = null;
                $post->post_content = $request->post_content;
                $post->post_tags = $request->post_tags;
                $post->featured_image = $new_file_name;
                $saved = $post->save();

                if($saved)
                {
                    return response()->json(['code' => 1, 'msg' => 'Post has been successfully updated']);
                }else{
                    return response()->json(['code' => 3, 'msg' => 'Something went wrong in updated post !']);
                }

            }else{
                return response()->json(['code' => 3, 'msg' => 'Error in Updated new featured image !']);
            }

        }else{
            $request->validate([
                'post_title' => 'required|unique:posts,post_title,'.$request->post_id,
                'post_content' => 'required',
                'post_category' => 'required|exists:subcategories,id'
            ]);

            $post = Post::find($request->post_id);
            $post->category_id = $request->post_category;
            $post->post_slug = null;
            $post->post_title = $request->post_title;
            $post->post_content = $request->post_content;
            $saved = $post->save();

            if($saved)
            {
                return response()->json(['code' => 1, 'msg' => 'Post has been successfully updated']);
            }else{
                return response()->json(['code' => 3, 'msg' => 'Something went wrong in updated post !']);
            }
        }
    }
}
