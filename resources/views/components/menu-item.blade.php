<li class="nav-item">
    @if ($menu->route)
        <a class="nav-link" href="{{ route($menu->route) }}">
            @if($menu->icon)
                <i class="{{ $menu->icon }}"></i>
            @endif
            {{ $menu->title }}
        </a>
    @else
        <span class="nav-link">
            @if($menu->icon)
                <i class="{{ $menu->icon }}"></i>
            @endif
            {{ $menu->title }}
        </span>
    @endif

    @if ($menu->children->isNotEmpty())
        <ul class="nav flex-column ms-3">
            @foreach ($menu->children as $child)
                @if ($child->permission === null || auth()->user()->can($child->permission))
                    @include('components.menu-item', ['menu' => $child])
                @endif
            @endforeach
        </ul>
    @endif
</li>
