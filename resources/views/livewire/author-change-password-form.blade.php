<div>


    <form method="post" wire:submit.prevent='changePassword()'>
        <div class="row">
          <div class="col-md-4">
              <div class="mb-3">
                    <label class="form-label">Current password</label>
                    <input type="password" class="form-control" name="example-password-input" placeholder="Current password" wire:model='current_password'>
                    <span class="text-danger">@error('current_password'){{ $message }}@enderror</span>
              </div>
          </div>
          <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">New password</label>
                    <input type="password" class="form-control" name="example-password-input" placeholder="New password" wire:model='new_password'>
                    <span class="text-danger">@error('new_password'){{ $message }}@enderror</span>
                </div>
          </div>
          <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Confirm new password</label>
                    <input type="password" class="form-control" name="example-password-input" placeholder="Confirm new password" wire:model='confirm_new_password'>
                    <span class="text-danger">@error('confirm_new_password'){{ $message }}@enderror</span>
                </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Change password</button>
     </form>


</div>
