@extends('front.layouts.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Categories')
@section('content')

    <div class="row">
        <div class="col-12">
            <!-- <div class="breadcrumbs mb-4"> <a href="index.html">Home</a>
                <span class="mx-1">/</span>  <a href="#!">Articles</a>
                <span class="mx-1">/</span>  <a href="#!">Travel</a>
            </div> -->
            <h1 class="mb-4 border-bottom border-primary d-inline-block">{{ $pageTitle }}</h1>
        </div>
        <div class="col-lg-8 mb-5 mb-lg-0">
            <div class="row">
                @forelse ($posts as $item)
                    <div class="col-md-6 mb-4">
                        <article class="card article-card article-card-sm h-100">
                            <a href="{{ route('read_posts', $item->post_slug) }}">
                                <div class="card-image">
                                    <div class="post-info"> <span
                                            class="text-uppercase">{{ date_formatter($item->created_at) }}</span>
                                        <span
                                            class="text-uppercase">{{ readDuration($item->post_title, $item->post_content) }}
                                            @choice('min|mins', readDuration($item->post_title, $item->post_content))</span>
                                    </div>
                                    <img loading="lazy" decoding="async"
                                        src="/storage/images/post_images/thumbnails/resized_{{ $item->featured_image }}"
                                        alt="{{ $item->post_title }}" class="w-100" width="420" height="280">
                                </div>
                            </a>
                            <div class="card-body px-0 pb-0">
                                <ul class="post-meta mb-2">
                                    <li>
                                        @foreach (explode(',', $item->post_tags) as $tag)
                                    <li><a href="#">{{ $tag }}</a></li>
                @endforeach
                </li>
                </ul>
                <h2><a class="post-title" href="{{ route('read_posts', $item->post_slug) }}">
                        {{ $item->post_title }}</a></h2>
                <p class="card-text">{!! Str::ucfirst(words($item->post_content, 25)) !!}</p>
                <div class="content"> <a class="read-more-btn" href="{{ route('read_posts', $item->post_slug) }}">Read Full
                        Article</a>
                </div>
            </div>
            </article>
        </div>
    @empty
        <span class="text-danger">No post(s) found !</span>
        @endforelse
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                {{ $posts->appends(request()->input())->links('custom_pagination') }}
            </div>
        </div>
    </div>
    </div>
    <div class="col-lg-4">
        <div class="widget-blocks">
            <div class="row">
                <!-- place une chose ajouter-->
                <div class="col-lg-12 col-md-6">
                    <div class="widget">
                        <h2 class="section-title mb-3">Latest Posts</h2>
                        <div class="widget-body">
                            <div class="widget-list">
                                @if (latest_first_sidebar_post())
                                <article class="card mb-4">
                                    <div class="card-image">
                                        <div class="post-info"> <span class="text-uppercase">{{ date_formatter(latest_first_sidebar_post()->created_at) }}</span>
                                        </div>
                                        <img loading="lazy" decoding="async"
                                         src="/storage/images/post_images/thumbnails/resized_{{ latest_first_sidebar_post()->featured_image }}"
                                            alt="{{ latest_first_sidebar_post()->post_title }}" class="w-100">
                                    </div>
                                    <div class="card-body px-0 pb-1">
                                        <h3><a class="post-title post-title-sm" href="{{ route('read_posts', latest_first_sidebar_post()->post_slug) }}">
                                            {{ latest_first_sidebar_post()->post_title }}
                                            </a>
                                        </h3>
                                        <p class="card-text">
                                            {!! Str::ucfirst(words(latest_first_sidebar_post()->post_content, 25)) !!}
                                        </p>
                                        <div class="content">
                                            <a class="read-more-btn" href="{{ route('read_posts', latest_first_sidebar_post()->post_slug) }}">
                                                Read FullArticle
                                            </a>
                                        </div>
                                    </div>
                                </article>
                                @endif
                                @foreach (latest_sidebar_post() as $item)
                                    <a class="media align-items-center" href="{{ route('read_posts', $item->post_slug) }}">
                                        <img loading="lazy" decoding="async"
                                        src="/storage/images/post_images/thumbnails/resized_{{ $item->featured_image }}"
                                            alt="{{ $item->post_title }}" class="w-100">
                                        <div class="media-body ml-3">
                                            <h3 style="margin-top:-5px">{{ $item->post_title }}</h3>
                                            <p class="mb-0 small">{!! Str::ucfirst(words($item->post_content, 25)) !!}</p>
                                        </div>
                                    </a>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <x-categories-list/>
                <x-tags-list/>
            </div>
        </div>
    </div>
    </div>

@endsection
