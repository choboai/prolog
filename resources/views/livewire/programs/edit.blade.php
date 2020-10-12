<div x-cloak x-data="{modalOpen:false}">

    <div class="flex flex-col sm:flex-row justify-between sm:items-start mb-4">

        <div class="flex-grow">
            <h1 class="text-3xl font-mono font-bold mr-5">{{ $this->program->name ?? 'Nameless program' }}</h1>

            <div class="flex items-center mt-2">
                <x-user :user="$program->user" />
            </div>
        </div>

        <div class="flex-none flex sm:flex-col items-end h-full mt-3 sm:mt-2">

            <div class="flex flex-none">
                <a href="{{ route('programs.show', $program) }}" class="text-sm py-1 px-3 border border-gray-200 rounded-lg shadow-sm hover:shadow-md cursor-pointer mr-4">
                    Stop editing
                </a>

                @can('delete', $program)
                    <button type="button" @click="modalOpen = ! modalOpen" class="h-8 text-sm py-1 text-red-600 px-3 border border-gray-200 rounded-lg shadow-sm hover:shadow-md cursor-pointer">
                        Delete
                    </button>
                    <x-modal-delete titre="Delete Program" action="deleteProgram">
                        Are you sure?
                    </x-modal-delete>
                @endcan
            </div>

            <div class="text-sm text-gray-700 mt-2 flex-grow text-right">
                updated <x-carbon :date="$program->updated_at" human />
            </div>
        </div>

    </div>

    <form class="flex flex-col">
        <div class="mb-4 bg-gray-50 p-4 rounded-lg text-gray-600">
            <div class="mb-5">
                <div class="flex items-center font-bold">
                    <x-label class="flex-none w-28 mr-5 text-right" for="name" />
                    <x-input class="flex-none outline-none bg-blue-50 sm:w-64 py-2 px-4 rounded-md shadow" type="text" name="name" wire:model="program.name" wire:keydown.debounce.200ms="save()"/>
                    <div class="flex-grow"></div>
                </div>
                <x-error class="text-red-500" field="program.name" />
            </div>
            <div class="flex mb-3">
                <x-label class="flex-none w-28 mr-5 text-right font-bold text-gray-600" for="description" />
                <div class="w-full">
                    <x-textarea class="w-full outline-none bg-blue-50 py-2 px-4 rounded-md shadow" name="description" wire:model="program.description" wire:keydown.debounce.200ms="save()" rows="3"></x-textarea>
                    <x-error class="text-red-500" field="prologFile.description" />
                </div>
            </div>
            @auth
                @if ($this->program->user_id !== null && request()->user()->id === $this->program->user_id)

                <div class="mb-5">
                    <div class="flex items-center font-bold">
                        <div class="flex-none w-28 mr-5 text-right capitalize"></div>
                        <x-checkbox name="public" wire:model="program.is_public" wire:change.debounce.200ms="save()"/>
                        <x-label class="ml-3" for="public"/>
                        <div class="flex-grow"></div>
                    </div>
                    <x-error class="text-red-500" field="program.name" />
                </div>

                <div class="flex mb-3">
                    <x-label class="flex-none w-28 mr-5 text-right font-bold text-gray-600" for="team" />
                    <div class="w-full">
                        <select name="team" id="team" wire:model="program.team_id" wire:change.debounce.200ms="save()">
                            <option value="0">No team</option>
                            @foreach (request()->user()->allTeams() as $team)
                                <option value="{{$team->id}}">{{$team->name}}</option>
                            @endforeach
                        </select>
                        <x-error class="text-red-500" field="program.team_id" />
                    </div>
                </div>
                @endif
            @endauth

        </div>

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
            <hr class="sm:hidden border-gray-200 mt-10 mb-6">
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

                <hr class="sm:hidden border-gray-200 mt-10 mb-6">

                <x-results />

            </div>
        </div>
    </form>
</div>
