<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class AllPosts extends Component
{
    use WithPagination;
    public $perPage = 8;
    public $subcategory = null;
    public $author = null;
    public $search = null;
    public $orderBy = 'desc';

    protected $listeners = [
        'deletePostAction'
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();

    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingAuthor()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.all-posts', [
            'posts' => auth()->user()->type == 1 ? Post::search(trim($this->search))
                                                         ->when($this->subcategory, function($query){
                                                            $query->where('category_id', $this->subcategory);
                                                         })
                                                         ->when($this->author, function($query){
                                                            $query->where('author_id', $this->author);
                                                         })
                                                         ->when($this->orderBy, function($query){
                                                            $query->orderBy('id', $this->orderBy);
                                                         })
                                                         ->paginate($this->perPage) :
                                                         Post::search(trim($this->search))
                                                         ->when($this->subcategory, function($query){
                                                            $query->where('category_id', $this->subcategory);
                                                         })
                                                         ->where('author_id', auth()->id())
                                                         ->when($this->orderBy, function($query){
                                                            $query->orderBy('id', $this->orderBy);
                                                         })
                                                         ->paginate($this->perPage)
        ]);
    }

    public function deletePost($id)
    {
        $this->dispatchBrowserEvent('deletePost', [
            'title' => '<br>Are you sure ?',
            'html' => 'You want to delete this post !',
            'id' => $id
        ]);
    }

    public function deletePostAction($id)
    {
        $post = Post::find($id);
        if ($post) {
            $path = 'images/post_images/';
            $featured_image = $post->featured_image;
            if ($featured_image != null && Storage::disk('public')->exists($path.$featured_image))
            {
                //dd([$path.$featured_image, $path.'thumbnails/resized_'.$featured_image, $path.'thumbnails/thumb_'.$featured_image]);
                Storage::disk('public')->delete([$path.$featured_image, $path.'thumbnails/resized_'.$featured_image, $path.'thumbnails/thumb_'.$featured_image]);
            }

            if ($post->delete())
            {
                $this->showToastr('Post has been successfully deleted','success');
            }else {
                $this->showToastr('Something went wrong !', 'error');
            }
        }
    }

    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'message' => $message,
            'type' => $type
        ]);
    }
}
