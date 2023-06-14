<div>


    <form method="post" wire:submit.prevent='updateGeneralSettings()'>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Blog name</label>
                    <input type="text" class="form-control" placeholder="Enter blog name" wire:model='blog_name'>
                    <span class="text-danger">@error('blog_name'){{ $message }}@enderror</span>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Blog email</label>
                    <input type="email" class="form-control" placeholder="Enter blog email" wire:model='blog_email'>
                    <span class="text-danger">@error('blog_email'){{ $message }}@enderror</span>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Blog description</label>
                    <textarea name="" id="" cols="3" rows="3" wire:model='blog_description' class="form-control" placeholder="Content.."></textarea>
                    <span class="text-danger">@error('blog_description'){{ $message }}@enderror</span>
                </div>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </form>


</div>
