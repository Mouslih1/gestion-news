<div>

    <div class="page-header">
        <div class="row align-items-center">
          <div class="col-auto">
            <span class="avatar avatar-md" style="background-image: url({{ $author->picture }})"></span>
          </div>
          <div class="col">
            <h2 class="page-title">{{ $author->name }}</h2>
            <div class="page-subtitle">
              <div class="row">
                <div class="col-auto">
                  <!-- Download SVG icon from http://tabler-icons.io/i/building-skyscraper -->
                <!--  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M5 21v-14l8 -4v18" /><path d="M19 21v-10l-6 -4" /><path d="M9 9l0 .01" /><path d="M9 12l0 .01" /><path d="M9 15l0 .01" /><path d="M9 18l0 .01" /></svg>-->
                  <a href="#" class="text-reset">@ {!! $author->username !!} | {{ $author->authorType->name }}</a>
                </div>
                <div class="col-auto">
                  <!-- Download SVG icon from http://tabler-icons.io/i/users -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                  <a href="#" class="text-reset">{{ count($authors) }} authors</a>
                </div>
                @if (auth()->user()->blocked == 0)
                <div class="col-auto text-success">
                    <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                    Actived
                  </div>
                </div>
                @else
                <div class="col-auto text-danger">
                    <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z"></path><path d="M12 9v4"></path><path d="M12 17h.01"></path></svg>
                    Blocked
                  </div>
                </div>
                @endif
            </div>
          </div>
          <div class="col-auto d-md-flex">
            <input type="file" name="file" id="changePictureAuthorfile" class="d-none" onchange="this.dispatchEvent(new InputEvent('input'))">
            <a href="#" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('changePictureAuthorfile').click();">
              <!-- Download SVG icon from http://tabler-icons.io/i/message -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" /><path d="M8 9l8 0" /><path d="M8 13l6 0" /></svg>
              Change picture
            </a>
          </div>
        </div>
      </div>


</div>
