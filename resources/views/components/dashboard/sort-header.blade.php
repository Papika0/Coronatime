@props(['title', 'column', 'width' => 'w-72', 'padding' => ''])

<th class="{{ $padding }} py-5 bg-table-border text-left {{ $width }}">
    {{ $title }}
    <span>
        <a href="{{ route('dashboard.countries', ['sort' => $column . '_asc'] + request()->query()) }}">
            <i class="ri-arrow-drop-up-fill"></i>
        </a>
        <a href="{{ route('dashboard.countries', ['sort' => $column . '_desc'] + request()->query()) }}">
            <i class="ri-arrow-drop-down-fill"></i>
        </a>
    </span>
</th>
