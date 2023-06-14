<div>
    <form method="post" wire:submit.prevent='UpdateDetails()'>
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="example-text-input" placeholder="Enter your name" wire:model='name'>
                    <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="example-text-input" placeholder="Enter your username" wire:model='username'>
                    <span class="text-danger">@error('username') {{ $message }} @enderror</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" name="example-text-input" wire:model='email' placeholder="Enter your address email" disabled>
                    <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Biography <span class="form-label-description">56/100</span></label>
                <textarea class="form-control" name="example-textarea-input" rows="6" placeholder="Content.." wire:model='biography'></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Saves changes</button>
    </form>
</div>
