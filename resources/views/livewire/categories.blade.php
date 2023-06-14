<div>

<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs">
                <h3>Categories</h3>
                <li class="nav-item ms-auto">
                  <a class="btn btn-sm btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#categories_modal">Add categorie</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped">
                      <thead>
                        <tr>
                          <th>Categories</th>
                          <th>N of subcategories</th>
                          <th class="w-1"></th>
                        </tr>
                      </thead>
                      <tbody id="sortable_category">
                        @forelse ($categories as $category)
                        <tr data-index='{{ $category->id }}' data-ordering='{{ $category->ordering }}'>
                            <td>{{ $category->category_name }}</td>
                            <td class="text-muted">
                               {{ $category->subcategories->count() }}
                            </td>
                            <td>
                              <div class="btn-group">
                                  <a href="#" class="btn btn-sm btn-primary" wire:click.prevent="editCategory({{ $category->id }})">Edit</a> &nbsp;
                                  <a href="#" class="btn btn-sm btn-danger" wire:click.prevent='deleteCategory({{ $category->id }})'>Delete</a>
                              </div>
                            </td>
                          </tr>
                        @empty
                            <tr><td><span class="text-danger">No category found !</span></td></tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
            </div>
          </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs">
                <h3>SubCategories</h3>
                <li class="nav-item ms-auto">
                  <a class="btn btn-sm btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#subcategories_modal">Add SubCategorie</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped">
                      <thead>
                        <tr>
                          <th>SubCategories name</th>
                          <th>Parent categrories</th>
                          <th>N of posts</th>
                          <th class="w-1"></th>
                        </tr>
                      </thead>
                      <tbody id="sortable_subcategory">
                        @forelse ($subcategories as $subcategory)
                        <tr data-index="{{ $subcategory->id }}" data-ordering="{{ $subcategory->ordering }}">
                            <td>{{ $subcategory->subcategory_name }}</td>
                            <td>{{ $subcategory->parent_category != 0 ? $subcategory->parentcategory->category_name : '-'}}</td>
                            <td class="text-muted">
                              {{ $subcategory->posts->count() }}
                            </td>
                            <td>
                              <div class="btn-group">
                                  <a href="#" class="btn btn-sm btn-primary" wire:click.prevent='editSubcategory({{ $subcategory->id }})'>Edit</a> &nbsp;
                                  <a href="#" class="btn btn-sm btn-danger" wire:click.prevent='deleteSubcategory({{ $subcategory->id }})'>Delete</a>
                              </div>
                            </td>
                          </tr>

                        @empty
                            <tr><td><span class="text-danger">No subcategory found !</span></td></tr>
                        @endforelse

                      </tbody>
                    </table>
                  </div>
            </div>
          </div>
    </div>
</div>

<div wire:ignore.self class="modal modal-blur fade" id="categories_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ $update_category_mode ? 'Update categories' : 'Add categories' }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post"
            @if ($update_category_mode)
                wire:submit.prevent='updateCategory()'
            @else
                wire:submit.prevent='addCategory()'
            @endif
            >
            @if ($update_category_mode)
                <input type="hidden" wire:model='selected_category_id'>
            @endif
                <div class="mb-3">
                    <label class="form-label">Categories name</label>
                    <input type="text" wire:model='category_name' class="form-control" name="example-text-input" placeholder="Enter categorie name">
                     <span class="text-danger">@error('category_name'){{ $message }}@enderror</span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn me-auto">Close</button>
                    <button type="submit" class="btn btn-primary">{{ $update_category_mode ? 'Update' : 'Save' }}</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <div wire:ignore.self class="modal modal-blur fade" id="subcategories_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ $update_subcategory_mode ? 'Update Subcategories' : 'Add Subcategories' }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post"
            @if ($update_subcategory_mode)
                 wire:submit.prevent='updateSubcategory()'
            @else
                 wire:submit.prevent='addSubcategory()'
            @endif
            >
            @if ($update_subcategory_mode)
                <input type="hidden" name="" wire:model='selected_subcategory_id'>
            @endif
                <div class="mb-3">
                    <div class="form-label">Parent categories</div>
                    <select class="form-select" wire:model='parent_category'>
                            <option value="0">-- Uncategorized --</option>
                        @foreach (App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('parent_category'){{ $message }}@enderror</span>
                  </div>
                <div class="mb-3">
                    <label class="form-label">Subcategorie name</label>
                    <input type="text" wire:model='subcategory_name' class="form-control" name="example-text-input" placeholder="Enter subcategory name">
                     <span class="text-danger">@error('subcategory_name'){{ $message }}@enderror</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto">Close</button>
                    <button type="submit" class="btn btn-primary">{{ $update_subcategory_mode ? 'Update' : 'Save' }}</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
