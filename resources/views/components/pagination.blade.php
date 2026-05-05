<div class="pagination">
    {{-- Previous Button --}}
    @if($hasPrevious)
        <a href="{{ $previousUrl }}" class="pagination-btn">
            <span>←</span>
        </a>
    @else
        <button class="pagination-btn" disabled>
            <span>←</span>
        </button>
    @endif

    {{-- Page Numbers --}}
    @foreach($pages as $key => $page)
        @if($page['type'] === 'ellipsis')
            <span class="pagination-btn" style="cursor:default;border:none;background:transparent">
                {{ $page['number'] }}
            </span>
        @else
            @if(isset($page['isActive']) && $page['isActive'])
                <button class="pagination-btn active" disabled>
                    {{ $page['number'] }}
                </button>
            @else
                <a href="{{ $pageUrls[$key] ?? '#' }}" class="pagination-btn">
                    {{ $page['number'] }}
                </a>
            @endif
        @endif
    @endforeach

    {{-- Next Button --}}
    @if($hasNext)
        <a href="{{ $nextUrl }}" class="pagination-btn">
            <span>→</span>
        </a>
    @else
        <button class="pagination-btn" disabled>
            <span>→</span>
        </button>
    @endif
</div>

<style>
    .pagination-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>
