<div>
    @if(all_tags() != null)
    @php
        $all_tags =  all_tags();
        $all_tags_array = explode(',', $all_tags);
    @endphp
    <div class="widget">
        <h2 class="section-title mb-3">Tags</h2>
        <div class="widget-body">
            <ul class="widget-list">
                @foreach ($all_tags_array as $tag)
                <li>
                    <a href="{{ route('tag_posts', $tag) }}">
                        #{{ $tag }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
</div>
