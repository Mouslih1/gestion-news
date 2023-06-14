@extends('back.layouts.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Home')
@section('content')

<div class="col">
    <!-- Page pre-title -->
    <div class="page-pretitle">
      Hello :)
    </div>
    <h2 class="page-title">
      {{ auth()->user()->name }}
    </h2>
</div>
<div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards">
        <div class="col-sm-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="subheader">Users</div>
                <div class="ms-auto lh-1">
                  <div class="dropdown">
                  </div>
                </div>
              </div>
              <div class="h1 mb-3">{{ count($users) }}</div>
              <div class="d-flex mb-2">
                <div>Conversion rate</div>
                <div class="ms-auto">
                    @if(count($users)/100 <= 0)
                    <span class="text-yellow d-inline-flex align-items-center lh-1">
                        {{ count($users)/100 }}% <!-- Download SVG icon from http://tabler-icons.io/i/minus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l14 0"></path></svg>
                    </span>
                    @else
                    <span class="text-green d-inline-flex align-items-center lh-1">
                        {{ count($users)/100 }}% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 17l6 -6l4 4l8 -8"></path><path d="M14 7l7 0l0 7"></path></svg>
                      </span>
                    @endif
                </div>
              </div>
              <div class="progress progress-sm">
                <div class="progress-bar bg-primary" style="width: {{ count($users)/100 }}%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                  <span class="visually-hidden">{{ count($users)/100 }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="subheader">Today news</div>
                  <div class="ms-auto lh-1">
                    <div class="dropdown">
                    </div>
                  </div>
                </div>
                <div class="h1 mb-3">{{ count($postToday) }}</div>
                <div class="d-flex mb-2">
                  <div>Conversion rate</div>
                  <div class="ms-auto">
                      @if(count($postToday)/100 <= 0)
                      <span class="text-yellow d-inline-flex align-items-center lh-1">
                          {{ count($postToday)/100 }}% <!-- Download SVG icon from http://tabler-icons.io/i/minus -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l14 0"></path></svg>
                      </span>
                      @else
                      <span class="text-green d-inline-flex align-items-center lh-1">
                          {{ count($postToday)/100 }}% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 17l6 -6l4 4l8 -8"></path><path d="M14 7l7 0l0 7"></path></svg>
                        </span>
                      @endif
                  </div>
                </div>
                <div class="progress progress-sm">
                  <div class="progress-bar bg-primary" style="width: {{ count($postToday)/100 }}%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                    <span class="visually-hidden">{{ count($postToday)/100 }}</span>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="subheader">Month news</div>
                  <div class="ms-auto lh-1">
                    <div class="dropdown">
                    </div>
                  </div>
                </div>
                <div class="h1 mb-3">{{ count($postMonth) }}</div>
                <div class="d-flex mb-2">
                  <div>Conversion rate</div>
                  <div class="ms-auto">
                      @if(count($postMonth)/100 <= 0)
                      <span class="text-yellow d-inline-flex align-items-center lh-1">
                          {{ count($postMonth)/100 }}% <!-- Download SVG icon from http://tabler-icons.io/i/minus -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l14 0"></path></svg>
                      </span>
                      @else
                      <span class="text-green d-inline-flex align-items-center lh-1">
                          {{ count($postMonth)/100 }}% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 17l6 -6l4 4l8 -8"></path><path d="M14 7l7 0l0 7"></path></svg>
                        </span>
                      @endif
                  </div>
                </div>
                <div class="progress progress-sm">
                  <div class="progress-bar bg-primary" style="width: {{ count($postMonth)/100 }}%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                    <span class="visually-hidden">{{ count($postMonth)/100 }}</span>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="subheader">Year news</div>
                  <div class="ms-auto lh-1">
                    <div class="dropdown">
                    </div>
                  </div>
                </div>
                <div class="h1 mb-3">{{ count($postYear) }}</div>
                <div class="d-flex mb-2">
                  <div>Conversion rate</div>
                  <div class="ms-auto">
                      @if(count($postYear)/100 <= 0)
                      <span class="text-yellow d-inline-flex align-items-center lh-1">
                          {{ count($postYear)/100 }}% <!-- Download SVG icon from http://tabler-icons.io/i/minus -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l14 0"></path></svg>
                      </span>
                      @else
                      <span class="text-green d-inline-flex align-items-center lh-1">
                          {{ count($postYear)/100 }}% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 17l6 -6l4 4l8 -8"></path><path d="M14 7l7 0l0 7"></path></svg>
                        </span>
                      @endif
                  </div>
                </div>
                <div class="progress progress-sm">
                  <div class="progress-bar bg-primary" style="width: {{ count($postYear)/100 }}%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                    <span class="visually-hidden">{{ count($postYear)/100 }}</span>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-12">
          <div class="row row-cards">
            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                         </svg>                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        {{ count($authors) }} Author
                      </div>
                      <div class="text-muted">
                        {{ count($authorsBlocked) }} Blocked
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-article" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                            <path d="M7 8h10"></path>
                            <path d="M7 12h10"></path>
                            <path d="M7 16h10"></path>
                         </svg>
                        </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        {{ count($posts) }} Posts
                      </div>
                      <div class="text-muted">

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                             </svg>
                        </span>

                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        {{ count($admins) }} Admins
                      </div>
                      <div class="text-muted">

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-category-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 4h6v6h-6z"></path>
                            <path d="M4 14h6v6h-6z"></path>
                            <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                            <path d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                         </svg>                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        {{ count($category) }} Categories
                      </div>
                      <div class="text-muted">
                        {{ count($subcategory) }} Subcategories
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @livewire('author-dashbord')
      </div>
    </div>
  </div>

@endsection
