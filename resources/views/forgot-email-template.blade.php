

<div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header bg-light">
            <h4 class="text-center">
                <img src="{{ App\Models\Setting::find(2)->blog_logo }}" width="110" height="32"
                 alt="{{ App\Models\Setting::find(2)->blog_name }}" class="navbar-brand-image">
            </h4>
          </div>
          <div class="card-body">
            <h5 class="card-title">Dear {{ $name }},</h5>
            <p class="card-text">We received a request to reset your password for newsZ,
                account associated with {{ $email }} .Please follow the link below to reset your password:</p>
            <a href="{{ $link }}" target="_blank" class="btn btn-success" style="background-color: #4CAF50;border: none;
            color: white;padding: 12px 24px;text-align: center;text-decoration: none;display: inline-block;
            font-size: 16px;border-radius: 4px;cursor: pointer;">Reset Password</a>
            <p class="card-text mt-3">If you did not request a password reset, please ignore this message.</p>
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
