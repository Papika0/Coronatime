<x-dashboard.header page="Worldwide Statistics">

    <div class="container mx-auto">
        <div class="grid grid-cols-2 md:grid-cols-3 p-4 gap-4 md:p-0 md:gap-6 mt-6 md:mt-10">
            <x-dashboard.dashboard-card title="New Cases" number="{{ $stats->confirmed }}" color="blue" col="col-span-2"
                background="bg-blue-opacity-8" text="text-my-blue" />

            <x-dashboard.dashboard-card title="Recovered" number="{{ $stats->recovered }}" color="green"
                background="bg-green-opacity-8" text="text-my-green" />

            <x-dashboard.dashboard-card title="Death" number="{{ $stats->deaths }}" color="yellow"
                background="bg-yellow-opacity-8" text="text-my-yellow" />
        </div>
    </div>
</x-dashboard.header>
