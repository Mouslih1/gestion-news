@foreach (categories() as $item)
<li>
    <a href="{{ route('category_posts', $item->slug) }}">
        {{ $item->subcategory_name }}
        <span class="ml-auto">({{ $item->posts->count() }})</span>
    </a>
</li>
@endforeach
