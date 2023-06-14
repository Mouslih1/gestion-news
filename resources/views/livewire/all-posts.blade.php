<div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="" class="form-label">Search</label>
            <input type="text" class="form-control" placeholder="Keyword..." wire:model='search'>
        </div>
        <div class="col-md-3 mb-3">
            <label for="" class="form-label">Categories</label>
            <select name="" id="" class="form-select" wire:model='subcategory'>
                <option value="">-- No selected --</option>
                @foreach (App\Models\Subcategory::whereHas('posts')->get() as $subcategory)
                <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                @endforeach
            </select>
        </div>
        @if (auth()->user()->type == 1)
        <div class="col-md-3 mb-3">
            <label for="" class="form-label" >Author</label>
            <select name="" id="" class="form-select" wire:model='author'>
                <option value="">-- No selected --</option>
                @foreach (App\Models\User::whereHas('posts')->get() as $author)
                <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="col-md-2 mb-3">
            <label for="" class="form-label">order BY</label>
            <select name="" id="" class="form-select" wire:model='orderBy'>
                <option value="asc">ASC</option>
                <option value="desc">DESC</option>
            </select>
        </div>
    </div>
    <div class="row row-cards mt-1">
        @forelse ($posts as $post)
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <img src="/storage/images/post_images/thumbnails/resized_{{ $post->featured_image }}" alt="" class="card-img-top">
                <div class="card-body p-2">
                    <h3 class="m-0 mb-1">{{Str::limit( $post->post_title, 25) }}</h3>
                </div>
                <div class="d-flex">
                    <a href="{{ route('author.posts.edit-posts', ['post_id' => $post->id]) }}" class="card-btn">Edit</a>
                    <a href="" wire:click.prevent='deletePost({{ $post->id }})' class="card-btn">Delete</a>
                </div>
            </div>
        </div>
        @empty
            <span class="text-danger">No post(s) found !</span>
        @endforelse
    </div>
    <div class="d-block mt-2">
        {{ $posts->links('livewire::simple-bootstrap') }}
    </div>
</div>
