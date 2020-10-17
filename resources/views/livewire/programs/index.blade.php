<div>

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div class="flex items-center">
            <h1 class="text-3xl font-mono font-bold mr-5">Programs</h1>
            <a href="{{ route('programs.create') }}" class="text-sm py-1 px-3 border border-gray-200 rounded-lg shadow-sm hover:shadow-md cursor-pointer">
                Create
            </a>
        </div>

        <x-input type="text" class="border-blue-700 border-b-4 text-xl outline-none mt-2 sm:mt-0" placeholder="Search" name="search" wire:model="search" />
    </div>

    <div wire:poll class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 my-8 gap-8">
        @forelse ($programs as $program)

            <a href="{{ route('programs.show', $program) }}" class="flex flex-col p-8 border border-gray-200 rounded-md shadow-sm hover:shadow-md cursor-pointer">
                <div class="flex-grow text-lg font-bold font-mono">
                    {{ $program->name  ?? 'Nameless program' }}
                </div>
                <div class="text-xs text-gray-600 mt-1">
                    updated <x-carbon :date="$program->updated_at" human />
                </div>
                <div class="flex text-sm text-gray-600 mt-2 items-center">
                    <x-user :user="$program->user" />
                </div>
            </a>
        @empty
            <div>No programs matching your query</div>
        @endforelse
    </div>
    {{ $programs->links() }}
</div>
