<x-dashboard.header page="Statistics by country">
    <div class="mt-9 mb-10">
        <form method="GET">
            <div class="relative">
                <input type="text" id="search" name="search" placeholder="Search by country"
                    class="border px-2 pl-14 h-10 w-60 outline-none rounded-lg" value="{{ request('search') }}">
                <svg class="absolute top-0 left-0 h-5 w-5 ml-6 transform -translate-y-1/2 mt-5" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19.3334 19.3334L14 14.0001M8.66669 16.6667C4.24841 16.6667 0.666687 13.085 0.666687 8.66675C0.666687 4.24847 4.24841 0.666748 8.66669 0.666748C13.085 0.666748 16.6667 4.24847 16.6667 8.66675C16.6667 13.085 13.085 16.6667 8.66669 16.6667Z"
                        stroke="#010414" />
                </svg>
            </div>
            <input type="hidden" name="sort" value="{{ request('sort') }}">
        </form>
    </div>

    <div
        class="max-h-[600px] mb-10 overflow-y-scroll border-collapse border border-table-border
         rounded-lg scrollbar-thin scrollbar-track-transparent scrollbar-thumb-slate-600 scrollbar-thumb-rounded-full scrollbar-track-rounded-full">
        <table class="w-full">
            <thead>
                <tr>
                    <x-dashboard.sort-header title="Location" column="country" padding="px-10" />
                    <x-dashboard.sort-header title="New Cases" column="confirmed" />
                    <x-dashboard.sort-header title="Deaths" column="deaths" />
                    <x-dashboard.sort-header title="Recovered" column="recovered" width="" />
                </tr>
            </thead>
            <tbody>
                @foreach ($countryStats as $countryStat)
                    <tr>
                        <td class="px-10 py-2 border-b border-table-border">
                            {{ $countryStat->country }}
                        </td>
                        <td class="border-b border-table-border ">
                            {{ number_format($countryStat->confirmed) }}
                        </td>
                        <td class="border-b border-table-border ">
                            {{ number_format($countryStat->deaths) }}
                        </td>
                        <td class="border-b border-table-border ">
                            {{ number_format($countryStat->recovered) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</x-dashboard.header>
