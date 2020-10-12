<div>

    <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-4">
        <div>
            <h1 class="text-3xl font-mono font-bold mr-5">{{ $this->program->name ?? 'Nameless program' }}</h1>

            <div class="flex items-center mt-2">
                <x-user :user="$program->user" />
            </div>
        </div>

        <div class="flex sm:flex-col items-end justify-between h-full mt-3 sm:mt-0">

            <div class="flex">
                <button type="button" wire:click="duplicateProgram" class="text-sm py-1 px-3 border border-gray-200 rounded-lg shadow-sm hover:shadow-md cursor-pointer mr-4">
                    Clone
                </button>

                @can('update', $program)
                    <a href="{{ route('programs.edit', $program) }}" class="text-sm py-1 px-3 border border-gray-200 rounded-lg shadow-sm hover:shadow-md cursor-pointer">
                        Edit
                    </a>
                @endcan
            </div>

            <div class="text-sm text-gray-700 mt-2">
                updated <x-carbon :date="$program->updated_at" human />
            </div>
        </div>

    </div>

    @if ($this->program->description)
        <div class="mb-4 bg-gray-50 p-4 rounded-lg text-gray-600">{!! nl2br($this->program->description) !!}</div>
    @endif

    <div class="flex flex-col">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-16">
            <div>
                <h2 class="text-2xl font-mono font-bold mr-5">Prolog files</h2>
                <div class="">
                    @forelse ($this->prologFiles as $prologFile)
                        <div class="w-full p-4 text-center border border-gray-200 rounded-md my-4">
                            <div class="mb-2 flex flex-col items-start">
                                <div class="flex flex-col items-start sm:items-center sm:flex-row sm:justify-between w-full">
                                    <div class="capitalize text-lg font-bold text-gray-600">
                                        {{ $prologFile->name ?? 'nameless file' }}
                                    </div>
                                </div>
                            </div>
                            <div class="h-64 overflow-y-auto outline-none bg-blue-50 w-full py-2 px-4 rounded-md shadow text-left" style="min-height: 2.5em;">{!! nl2br($prologFile->content) !!}</div>
                            <textarea class="prolog-files hidden" name="content">{{ $prologFile->content }}</textarea>
                        </div>
                    @empty
                        <div class="w-full my-4 p-4 text-center border border-gray-200 rounded-md">no files yet</div>
                    @endforelse
                </div>
            </div>
            <hr class="sm:hidden border-gray-200 mt-10 mb-6">
            <div>
                <div>
                    <h2 class="text-2xl font-mono font-bold mr-5">Queries</h2>
                    <div class="">

                        @forelse ($this->prologQueries as $prologQuery)
                            <div class="w-full p-4 text-center border border-gray-200 rounded-md my-4">
                                <div class="mb-2 flex flex-col items-start">
                                    <div class="flex flex-col items-start sm:items-center sm:flex-row sm:justify-between w-full">
                                        <div class="capitalize text-lg font-bold text-gray-600">
                                            {{ $prologQuery->name ?? 'nameless query' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="outline-none bg-blue-50 w-full py-2 px-4 rounded-md shadow text-left" style="min-height: 2.5em;">{!! nl2br($prologQuery->content) !!}</div>
                                <textarea class="prolog-queries hidden" name="content">{{ $prologQuery->content }}</textarea>
                                <div class="h-8 mt-3">
                                    <button x-data @click="evaluate($event)" class="inline-flex items-center text-sm py-1 px-3 border border-gray-200 rounded-lg shadow-sm hover:shadow-md cursor-pointer float-right" type="button">
                                        <svg class="w-6 h-6 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Execute
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="w-full my-4 p-4 text-center border border-gray-200 rounded-md">no queries yet</div>
                        @endforelse
                    </div>
                </div>

                <hr class="sm:hidden border-gray-200 mt-10 mb-6">

                <x-results />

            </div>
        </div>
    </div>
</div>
