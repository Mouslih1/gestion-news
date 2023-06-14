<div>
    <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">
            Authors
          </h2>
          <div class="text-muted mt-1">1-18 of 413 people</div>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
          <div class="d-flex">
            <input type="search" class="form-control d-inline-block w-9 me-3" wire:model="search" placeholder="Search author…">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new_author_modal">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
              New author
            </a>
          </div>
        </div>
      </div>
      <div class="page-body">
        <div class="container-xl">
          <div class="row row-cards">
            @forelse ($authors as $author)
            <div class="col-md-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-4 text-center">
                    <span class="avatar avatar-xl mb-3 rounded" style="background-image: url({{ $author->picture }})"></span>
                    <h3 class="m-0 mb-1"><a href="{{ route('author.authors') }}">{{ $author->name }}</a></h3>
                    <div class="text-muted">{{ $author->username }}</div>
                    <div class="mt-3">
                      <span class="badge bg-purple-lt">{{ $author->authorType->name }}</span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <a href="#" wire:click.prevent='editAuthor({{ $author }})' class="card-btn ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="margin-right:8px;"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path><path d="M16 5l3 3"></path></svg>
                        Edit</a>
                    <a href="#" wire:click.prevent='deleteAuthor({{ $author }})' id="deleteAuthor"  class="card-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="margin-right:8px;"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7l16 0"></path><path d="M10 11l0 6"></path><path d="M14 11l0 6"></path><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg>
                        Delete</a>
                    </div>
                </div>
            </div>
            @empty
            <span class="text-danger">No authors found !</span>
            @endforelse
        </div>
        <div class="row mt-4">
            {{ $authors->links('livewire::simple-bootstrap') }}
        </div>
      </div>


{{-- models --}}

  <div wire:ignore.self class="modal modal-blur fade" id="new_author_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add author</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent='addAuthor()' method="post">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" wire:model='name' class="form-control" name="example-text-input" placeholder="Enter author name">
                     <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" wire:model='email' class="form-control" name="example-text-input" placeholder="Enter author email">
                    <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" wire:model='username' class="form-control" name="example-text-input" placeholder="Enter author username">
                    <span class="text-danger">@error('username'){{ $message }}@enderror</span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Author type</label>
                    <div>
                      <select class="form-select" wire:model='author_type'>
                        <option value="">-- No selected --</option>
                        @foreach (App\Models\Type::all() as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <span class="text-danger">@error('author_type'){{ $message }}@enderror</span>
                </div>

                <div class="mb-3">
                    <div class="form-label">Is direct publisher ?</div>
                    <div>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model='direct_publisher' name="direct_publisher" value="0" checked="">
                        <span class="form-check-label">No</span>
                      </label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model='direct_publisher' name="direct_publisher" value="1">
                        <span class="form-check-label">Yes</span>
                      </label>
                    </div>
                </div>
                <span class="text-danger">@error('direct_publisher'){{ $message }}@enderror</span>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <div wire:ignore.self class="modal modal-blur fade" id="edit_author_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit author</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent='updateAuthor()' method="post">
                    <input class="form-control" type="hidden" wire:model='selected_author_id'>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" wire:model='name' class="form-control" name="example-text-input" placeholder="Enter author name">
                     <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" wire:model='email' class="form-control" name="example-text-input" placeholder="Enter author email">
                    <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" wire:model='username' class="form-control" name="example-text-input" placeholder="Enter author username">
                    <span class="text-danger">@error('username'){{ $message }}@enderror</span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Author type</label>
                    <div>
                      <select class="form-select" wire:model='author_type'>
                        @foreach (App\Models\Type::all() as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <span class="text-danger">@error('author_type'){{ $message }}@enderror</span>
                </div>

                <div class="mb-3">
                    <div class="form-label">Is direct publisher ?</div>
                    <div>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model='direct_publisher' name="direct_publisher" value="0" checked="">
                        <span class="form-check-label">No</span>
                      </label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model='direct_publisher' name="direct_publisher" value="1">
                        <span class="form-check-label">Yes</span>
                      </label>
                    </div>
                    <span class="text-danger">@error('direct_publisher'){{ $message }}@enderror</span>
                </div>
                <div class="mb-3">
                    <div class="form-label">Blocked</div>
                    <label class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" checked="" wire:model="blocked">
                      <span class="form-check-label"></span>
                    </label>
                  </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
