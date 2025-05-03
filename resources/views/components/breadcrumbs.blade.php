<nav aria-label="breadcrumb" class="text-right">
    <ol class="breadcrumb bg-light px-3 py-2 rounded mb-0 d-flex justify-content-end" style="--bs-breadcrumb-divider: '>'; font-size: 14px;">
        @foreach ($links as $link)
            @if (!$loop->last)
                <li class="breadcrumb-item">
                    <a href="{{ $link['url'] }}" style="text-decoration: none; color: #84b6e2; font-weight: bold;">
                        {{ $link['label'] }}
                    </a>
                </li>
            @else
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    {{ $link['label'] }}
                </li>
            @endif
        @endforeach
    </ol>
</nav>
