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

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-16">
            <div>
                <h2 class="text-2xl font-mono font-bold mr-5">Prolog files</h2>
                <div class="prolog-files">
                    @forelse ($this->prologFiles as $prologFile)
                        <livewire:programs.prolog-file :key="$prologFile->id" :prologFile="$prologFile" />
                    @empty
                        <div class="w-full my-4 p-4 text-center border border-gray-200 rounded-md">no files yet</div>
                    @endforelse
                </div>
                <div class="mt-2">
                    <button class="text-sm py-1 px-3 border border-gray-200 rounded-lg shadow-sm hover:shadow-md cursor-pointer" type="button" wire:click="createPrologFile">add a new file</button>
                </div>
            </div>
            <div>
                <div>
                    <h2 class="text-2xl font-mono font-bold mr-5">Queries</h2>
                    <div class="prolog-queries">
                        @forelse ($this->prologQueries as $prologQuery)
                            <livewire:programs.prolog-query :key="$prologQuery->id" :prologQuery="$prologQuery" />
                        @empty
                            <div class="w-full my-4 p-4 text-center border border-gray-200 rounded-md">no queries yet</div>
                        @endforelse
                    </div>
                    <div class="mt-2">
                        <button class="text-sm py-1 px-3 border border-gray-200 rounded-lg shadow-sm hover:shadow-md cursor-pointer" type="button" wire:click="createPrologQuery">add a new query</button>
                    </div>
                </div>
                <div class="mt-10">
                    <h2 class="text-2xl font-mono font-bold mr-5">Results</h2>
                    <div class="text-gray-100 text-lg font-mono bg-indigo-900 w-full my-4 p-4 border border-gray-200 rounded-md">
                        Execute a query to get a result
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
