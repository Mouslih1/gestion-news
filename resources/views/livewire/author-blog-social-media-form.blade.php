<div>

    <form wire:submit.prevent='updateSocialMedia()' method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Facebook</label>
                    <input type="text" class="form-control" placeholder="Facebook page url" wire:model='facebook_url'>
                    <span class="text-danger">@error('facebook_url'){{ $message }}@enderror</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Instagram</label>
                    <input type="text" class="form-control" placeholder="Instagram page url" wire:model='instagram_url'>
                    <span class="text-danger">@error('instagram_url'){{ $message }}@enderror</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Youtube</label>
                    <input type="text" class="form-control" placeholder="Youtube page url" wire:model='youtube_url'>
                    <span class="text-danger">@error('youtube_url'){{ $message }}@enderror</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">LinkIn</label>
                    <input type="text" class="form-control" placeholder="LinkIn page url" wire:model='linkedin_url'>
                    <span class="text-danger">@error('linkedin_url'){{ $message }}@enderror</span>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Change social media</button>
    </form>
</div>
