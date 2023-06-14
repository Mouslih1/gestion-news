<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Author liste</h3>
          </div>
          <div class="card-body border-bottom py-3">
            <div class="d-flex">
              <div class="ms-auto text-muted">
                Search:
                <div class="ms-2 d-inline-block">
                  <input type="text" class="form-control form-control-sm" id="search" name='search' placeholder="Search author ..." wire:model="search" aria-label="Search invoice">
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
              <thead>
                <tr>
                  <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                  <th>picture</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>Type</th>
                  <th>Situation</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  @forelse ($authorspaginate as $author)
                  <tr>
                    <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                    <td>
                      <span class="text-muted">
                          <img src="{{ $author->picture }}" alt="{{ $author->name }}" class="img-fluid img-circle w-5">
                      </span>
                  </td>
                    <td>{{ $author->name }}</td>
                    <td>
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
                          <path d="M3 7l9 6l9 -6"></path>
                       </svg>
                      {{ $author->email }}
                    </td>
                    <td>
                      {{ $author->username }}
                    </td>
                    <td>
                      @if($author->type == 1)
                      <span class="text-success">{{ $author->authorType->name }}</span>
                      @else
                          <span class="text-warning">{{ $author->authorType->name }}</span>
                      @endif
                    </td>
                    <td>
                      @if($author->blocked == 0)
                      <span class="badge bg-success me-1"></span><span class="text-success">Actived</span>
                      @else
                      <span class="badge bg-danger me-1"></span><span class="text-danger">Blocked</span>
                      @endif
                    </td>
                  </tr>
                  @empty
                  <div class="card d-flex justify-content-center align-items-center">
                    <div class="card-body">
                      <h5 class="text-danger text-center">No author exists with this name !</h5>
                    </div>
                  </div>
                  @endforelse

              </tbody>
            </table>
          </div>
        <div class="card-footer d-flex align-items-center">
            {{ $authorspaginate->links('livewire::simple-bootstrap') }}
        </div>


        </div>
      </div>

</div>
