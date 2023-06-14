@extends('front.layouts.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Welcome to newsZ')
@section('meta-tags')
    <meta name="robots" content="index, follow"/>
    <meta name="title" content="{{ blog_info()->blog_name }}" />
    <meta name="description" content="{{ blog_info()->blog_description}}" />
    <meta name="author" content="{{ blog_info()->blog_name }}" />
    <link rel="canonical" href="{{ Request::root() }}" />
    <meta property="og:title" content="{{ blog_info()->blog_name }}" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="{{ blog_info()->blog_description }}" />
    <meta property="og:url" href="{{ Request::root() }}" />
    <meta property="og:image" content="{{ blog_info()->blog_logo }}" />
    <meta property="og:description" content="{{ blog_info()->blog_description }}" />
    <meta name="twitter:domain" href="{{ Request::root() }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" property="og:description" itemprop="description" content="{{ blog_info()->blog_description }}" />
    <meta name="twitter:image" content="{{ blog_info()->blog_logo }}" />



@endsection
@section('content')

<div class="row no-gutters-lg">
    <div class="col-12">
      <h2 class="section-title">Latest Articles</h2>
    </div>
    <div class="col-lg-8 mb-5 mb-lg-0">
      <div class="row">
        <div class="col-12 mb-4">
            @if(single_latest_post())
          <article class="card article-card">
            <a href="{{ route('read_posts', single_latest_post()->post_slug)  }}">
              <div class="card-image">
                <div class="post-info"><span class="text-uppercase">{{ date_formatter(single_latest_post()->created_at) }}</span>
                  <span class="text-uppercase">{{ readDuration(single_latest_post()->post_title,
                  single_latest_post()->post_content) }} @choice('min|mins', readDuration(single_latest_post()->post_title,
                  single_latest_post()->post_content)) read</span>
                </div>
                <img loading="lazy" decoding="async" src="/storage/images/post_images/{{ single_latest_post()->featured_image }}"
                alt="{{ single_latest_post()->post_title }}" class="w-100">
              </div>
            </a>
            <div class="card-body px-0 pb-1">
              <ul class="post-meta mb-2">
                <li>
                    <a href="#!">travel</a>
                    <a href="#!">news</a>
                </li>
              </ul>
              <h2 class="h1"><a class="post-title" href="{{ route('read_posts', single_latest_post()->post_slug)  }}">
                {{ single_latest_post()->post_title }}</a></h2>
              <p class="card-text">{!! Str::ucfirst(words(single_latest_post()->post_content,35)) !!}</p>
              <div class="content"> <a class="read-more-btn" href="{{ route('read_posts', single_latest_post()->post_slug)  }}">Read Full Article</a>
              </div>
            </div>
          </article>
            @endif
        </div>
        @foreach (latest_home_6posts() as $item)
        <div class="col-md-6 mb-4">
            <article class="card article-card article-card-sm h-100">
              <a href="{{ route('read_posts', $item->post_slug ) }}">
                <div class="card-image">
                  <div class="post-info"> <span class="text-uppercase">{{ date_formatter($item->created_at) }}</span>
                    <span class="text-uppercase">{{ readDuration($item->post_title, $item->post_content) }}
                    @choice('min|mins', readDuration($item->post_title, $item->post_content)) read</span>
                  </div>
                  <img loading="lazy" decoding="async" src="/storage/images/post_images/thumbnails/resized_{{ $item->featured_image }}"
                  alt="{{ $item->post_title }}" class="w-100">
                </div>
              </a>
              <div class="card-body px-0 pb-0">
                <ul class="post-meta mb-2">
                  <li> <a href="{{ route('category_posts', $item->subcategory->slug) }}">
                    {{ $item->subcategory->subcategory_name }}</a>
                  </li>
                </ul>
                <h2><a class="post-title" href="{{ route('read_posts', $item->post_slug)  }}">
                    {{ $item->post_title }}</a></h2>
                <p class="card-text">{!! Str::ucfirst(words($item->post_content, 25)) !!}</p>
                <div class="content"> <a class="read-more-btn" href="{{ route('read_posts', $item->post_slug)  }}">Read Full Article</a>
                </div>
              </div>
            </article>
          </div>
        @endforeach
        <div class="col-12">
          <div class="row">
            <div class="col-12">
              <nav class="mt-4">
                <!-- pagination -->
                <nav class="mb-md-50">
                  <ul class="pagination justify-content-center">
                    <li class="page-item">
                      <a class="page-link" href="#!" aria-label="Pagination Arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
                        </svg>
                      </a>
                    </li>
                    <li class="page-item active "> <a href="index.html" class="page-link">
                        1
                      </a>
                    </li>
                    <li class="page-item"> <a href="#!" class="page-link">
                        2
                      </a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#!" aria-label="Pagination Arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                        </svg>
                      </a>
                    </li>
                  </ul>
                </nav>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
<div class="widget-blocks">
<div class="row">
<!-- place une chose ajouter-->
  @if(recommended_posts() && single_recommended_posts())
  <div class="col-lg-12 col-md-6">
    <div class="widget">
      <h2 class="section-title mb-3">Recommended</h2>
      <div class="widget-body">
        <div class="widget-list">
          <article class="card mb-4">
            <div class="card-image">
              <div class="post-info"> <span class="text-uppercase">{{ readDuration(single_recommended_posts()->post_title,
                single_recommended_posts()->post_content) }} @choice('min|mins', readDuration(single_recommended_posts()->post_title,
                single_recommended_posts()->post_content)) read</span>
              </div>
              <img loading="lazy" decoding="async"
              src="/storage/images/post_images/thumbnails/thumb_{{ single_recommended_posts()->featured_image }}"
               alt="{{ single_recommended_posts()->post_title }}" class="w-100">
            </div>
            <div class="card-body px-0 pb-1">
                <h3><a class="post-title post-title-sm" href="{{ route('read_posts', single_recommended_posts()->post_slug) }}">
                    {{ single_recommended_posts()->post_title }}</a>
                </h3>
              <p class="card-text">{!! Str::ucfirst(words(single_recommended_posts()->post_content,20)) !!}</p>
              <div class="content"> <a class="read-more-btn" href="{{ route('read_posts', single_recommended_posts()->post_slug) }}">Read Full Article</a>
              </div>
            </div>
          </article>
          @foreach (recommended_posts() as $item)
          <a class="media align-items-center" href="{{ route('read_posts', $item->post_slug) }}">
            <img loading="lazy" decoding="async" src="/storage/images/post_images/thumbnails/thumb_{{ $item->featured_image }}" alt="Post Thumbnail" class="w-100">
            <div class="media-body ml-3">
              <h3 style="margin-top:-5px">{{ $item->post_title }}</h3>
              <p class="mb-0 small">{!! Str::ucfirst(words($item->post_content,20)) !!}</p>
            </div>
          </a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  @endif

 <x-categories-list/>
 <x-tags-list/>
</div>
</div>
</div>
  </div>

@endsection
