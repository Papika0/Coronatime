@php
    $stats = DB::table('country_stats')
        ->selectRaw('sum(confirmed) as confirmed, sum(recovered) as recovered, sum(deaths) as deaths')
        ->first();
@endphp

<x-dashboard.header page="Worldwide Statistics">

    <div class="container mx-auto">
        <div class="grid grid-cols-2 md:grid-cols-3 p-4 gap-4 md:p-0 md:gap-6 mt-6 md:mt-10">
            <x-dashboard.dashboard-card title="New Cases" number="{{ $stats->confirmed }}" color="blue"
                col="col-span-2" />

            <x-dashboard.dashboard-card title="Recovered" number="{{ $stats->recovered }}" color="green" />

            <x-dashboard.dashboard-card title="Death" number="{{ $stats->deaths }}" color="yellow" />
        </div>
    </div>
</x-dashboard.header>
