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

    <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 my-8 gap-8">
        @forelse ($programs as $program)

            <a href="{{ route('programs.show', $program) }}" class="p-8 border border-gray-200 rounded-md shadow-sm hover:shadow-md cursor-pointer">
                <div>
                    {{ $program->name }}
                </div>
                <div class="text-xs text-gray-600 mt-1">
                    updated <x-carbon :date="$program->updated_at" human />
                </div>
                <div class="flex text-sm text-gray-600 mt-2 items-center">
                    @if ($program->user !== null)
                        <img class="h-8 w-8 rounded-full object-cover" src="{{ $program->user->profile_photo_url ?? asset('storage/anon.jpg') }}" alt="{{ $program->user->name ?? 'Anon user' }}" />
                    @else
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    @endif
                    <span class="ml-2">
                        {{ $program->user->name ?? 'Anon user' }}
                    </span>
                </div>
            </a>
        @empty
            <div>No programs matching your query</div>
        @endforelse
    </div>
    {{ $programs->links() }}
</div>
