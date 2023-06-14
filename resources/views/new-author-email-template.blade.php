
<div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header bg-light">
            <h4 class="text-center"><img src="{{ App\Models\Setting::find(2)->blog_logo }}" height="60" alt=""></h4>
          </div>
          <div class="card-body">
            <h5 class="card-title">Hi {{ $name }},</h5>
            <p class="card-text">Your account has been created on newsZ. <br>
            You ca, use the following credentials : <br>
            <div class="card-body">
                Username : {{ $username }} <br>
                Email : {{ $email }} <br>
                Password : {{ $password }}</p>
            </div>
            <a href="{{ $url }}" target="_blank" class="btn btn-success" style="background-color: #4CAF50;border: none;
            color: white;padding: 12px 24px;text-align: center;text-decoration: none;display: inline-block;
            font-size: 16px;border-radius: 4px;cursor: pointer;">Go to profile page</a>
            <p class="card-text mt-3">Note : It is important to change this default password after logged in to system on the first time</p>
          </div>
          <div class="card-footer bg-light">
            <p class="card-text text-muted text-center">Thank you, newsZ</p>
          </div>
          <div class="card-footer bg-light">
            <p class="card-text text-muted text-center">copyright newZ 2023.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
