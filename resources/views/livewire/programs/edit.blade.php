<div>

    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-mono font-bold mr-5 border-blue-700 border-b-4">{{ $this->program->name ?? 'Nameless program' }}</h1>

        <div class="flex items-center">
            @can('delete', $program)
                <a href="{{ route('programs.edit', $program) }}" class="text-sm py-1 px-3 border border-gray-200 rounded-lg shadow-sm hover:shadow-md cursor-pointer mr-4">
                    Delete
                </a>
            @endcan

            <div class="text-sm text-gray-700">
                updated <x-carbon :date="$this->updated_at" human />
            </div>
        </div>
    </div>

    <div class="mb-5">
        <div class="flex text-sm text-gray-600 mt-4 items-center">
            <x-user :user="$program->user" />
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


        @auth
            @if ($this->program->user_id !== null && request()->user()->id === $this->program->user_id)
                <div class="my-5">
                    <div class="flex items-center font-bold w-64">
                        <x-checkbox name="public" wire:model="program.is_public" wire:change.debounce.200ms="save()"/>
                        <x-label class="ml-5" for="public"/>
                    </div>
                    <x-error class="text-red-500" field="program.is_public" />
                </div>

                <div class="my-5">
                    <div class="flex items-center font-bold w-64">
                        <x-label class="mr-5" for="team"/>
                        <select name="team" id="team" wire:model="program.team_id" wire:change.debounce.200ms="save()">
                            <option value="0">No team</option>
                            @foreach (request()->user()->allTeams() as $team)
                                <option value="{{$team->id}}">{{$team->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-error class="text-red-500" field="program.team_id" />
                </div>
            @endif
        @endauth

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-16">
            <div>
                <h2 class="text-2xl font-mono font-bold mr-5">Prolog files</h2>
                <div class="">
                    @forelse ($this->prologFiles as $prologFile)
                        <livewire:programs.prolog-file :key="'file-'. $prologFile->id" :prologFile="$prologFile" />
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
                    <div class="">
                        @forelse ($this->prologQueries as $prologQuery)
                            <livewire:programs.prolog-query :key="'query-'.$prologQuery->id" :prologQuery="$prologQuery" />
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
                    <div id="results" class="text-gray-100 text-lg font-mono bg-indigo-900 w-full my-4 p-4 border border-gray-200 rounded-md overflow-x-auto">
                        Execute a query to get a result
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
