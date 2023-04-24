@props(['title', 'column', 'width' => 'md:w-72 w-20', 'padding' => ''])

<th class="{{ $padding }} py-5 bg-table-border  text-left {{ $width }}">
    <div class="flex items-center gap-2">
        <p class="text-sm whitespace-nowrap"> {{ __("dashboard.$title") }} </p>
        <span class="flex flex-col gap-1 ">
            <a href="{{ route('countries.index', ['sort' => $column . '_asc'] + request()->query()) }}">
                <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 0.5L10 5.5L0 5.5L5 0.5Z"
                        fill="{{ request()->query('sort') == $column . '_asc' ? '#010414' : '#BFC0C4' }}" />
                </svg>
            </a>
            <a href="{{ route('countries.index', ['sort' => $column . '_desc'] + request()->query()) }}">
                <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 5.5L0 0.5H10L5 5.5Z"
                        fill="{{ request()->query('sort') == $column . '_desc' ? '#010414' : '#BFC0C4' }}" />
                </svg>
            </a>
        </span>
    </div>
</th>
