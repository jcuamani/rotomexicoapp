<li data-id="{{ $menu->id }}" class="list-group-item nested-{{ $level }}">
    
    <span class="menu-item handle">{{ $menu->title }}</span>
    @if ($menu->children->count())
        <ul class="list-group col nested-sortable">
            @foreach ($menu->children as $child)
                @include('admin.menus.partials.item', ['menu' => $child], ['level' => $level + 1])
            @endforeach
        </ul>
    @endif
</li>