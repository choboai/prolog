<div>

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div class="flex items-center">
            <h1 class="text-3xl font-mono font-bold mr-5 border-blue-700 border-b-4">{{ $this->program->name ?? 'Nameless program' }}</h1>
        </div>
    </div>

    <form class="flex flex-col">
        <div class="my-5">
            <div class="flex items-center font-bold w-64">
                <x-label class="mr-5" for="name" />
                <x-input class="outline-none bg-blue-50 w-full py-2 px-4 rounded-md shadow" type="text" name="name" wire:model="program.name" wire:keydown.debounce.200ms="save()"/>
            </div>
            <x-error class="text-red-500" field="program.name" />
        </div>

        <div>
            <h2 class="text-2xl font-mono font-bold mr-5">Prolog files</h2>
            @forelse ($program->prolog_files as $prolog_file)
                @livewire('programs.prolog-file', ['prologFile' => $prolog_file])
            @empty
                <div class="w-full p-4 text-center border border-gray-200 rounded-md">no files yet</div>
            @endforelse
            <div class="mt-2">
                <button class="text-sm py-1 px-3 border border-gray-200 rounded-lg shadow-sm hover:shadow-md cursor-pointer" type="button" wire:click="createPrologFile">add a new file</button>
            </div>
        </div>

    </form>
</div>
