<div wire:poll.1000ms>

    <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-4">
        <div>
            <h1 class="text-3xl font-mono font-bold mr-5">{{ $this->program->name ?? 'Nameless program' }}</h1>

            <div class="flex items-center mt-2">
                <x-user :user="$program->user" />
            </div>
        </div>

        <div class="flex sm:flex-col items-end justify-between h-full mt-3 sm:mt-0">

            <div class="flex">
                @can('update', $program)
                    <a href="{{ route('programs.edit', $program) }}" class="text-sm py-1 px-3 border border-gray-200 rounded-lg shadow-sm hover:shadow-md cursor-pointer mr-4">
                        Edit
                    </a>
                @endcan

                <button type="button" wire:click="duplicateProgram" class="text-sm py-1 px-3 border border-gray-200 rounded-lg shadow-sm hover:shadow-md cursor-pointer">
                    Clone
                </button>
            </div>

            <div class="text-sm text-gray-700 mt-2">
                updated <x-carbon :date="$program->updated_at" human />
            </div>
        </div>

    </div>

    @if ($this->program->description)
        <x-markdown-view :text="$this->program->description" class="mb-4" />
    @endif

    <div class="flex flex-col line-numbers">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-16">
            <div >
                <h2 class="text-2xl font-mono font-bold mr-5">Prolog files</h2>
                <div>
                    @forelse ($this->prologFiles as $prologFile)
                        <div x-data="{...copyButton()}" class="w-full px-4 pt-3 text-center border border-gray-200 rounded-md my-4">
                            <div class="mb-2 flex flex-col items-start">
                                <div class="flex items-center justify-between w-full">
                                    <div class="text-left text-lg font-bold text-gray-600">
                                        {{ $prologFile->name ?? 'nameless file' }}
                                    </div>
                                    <div>

                                        <button @click="copy($event)" class="border border-gray-200 text-gray-700 px-1 py-1 rounded-lg text-sm font-bold transform hover:shadow" x-bind:class="{'bg-green-200': isCopied, 'border-green-400': isCopied, 'text-green-700': isCopied}">
                                            <svg x-show="! isCopied" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                            </svg>
                                            <svg x-show="isCopied" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <pre x-show="isTextareaHidden" class="font-mono overflow-y-auto outline-none bg-blue-50 w-full py-2 px-4 rounded-md shadow text-left" style="max-height: 30em;"><code @click="toggle" class="language-prolog">{!! nl2br($prologFile->content == '' ? '% No code yet' : $prologFile->content ) !!}</code></pre>
                            <textarea x-show="! isTextareaHidden" class="h-auto prolog-files font-mono outline-none bg-blue-50 w-full py-2 px-4 rounded-md shadow" rows="10">{{ $prologFile->content }}</textarea>
                        </div>
                    @empty
                        <div class="w-full my-4 p-4 text-center border border-gray-200 rounded-md">no files yet</div>
                    @endforelse
                </div>
            </div>
            <div >
                <div class="">
                    <h2 class="text-2xl font-mono font-bold mr-5">Queries</h2>
                    <div class="">

                        @forelse ($this->prologQueries as $prologQuery)
                            <div x-data="{...copyButton()}" class="w-full px-4 pt-3 text-center border border-gray-200 rounded-md my-4">
                                <div class="mb-2 flex flex-col items-start">
                                    <div class="flex items-center justify-between w-full">
                                        <div class="text-left text-lg font-bold text-gray-600">
                                            {{ $prologQuery->name ?? 'nameless query' }}
                                        </div>
                                        <div class="flex">

                                            <button @click="copy($event)" class="border border-gray-200 text-gray-700 px-1 py-1 rounded-lg text-sm font-bold transform hover:shadow" x-bind:class="{'bg-green-200': isCopied, 'border-green-400': isCopied, 'text-green-700': isCopied}">
                                                <svg x-show="! isCopied" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                                <svg x-show="isCopied" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                            <button x-data @click="evaluate($event)" class="ml-2 flex items-center text-sm py-1 px-1 border border-gray-200 rounded-lg shadow-sm hover:shadow-md cursor-pointer float-right focus:shadow-outline-green focus:outline-none" type="button">
                                                <svg class="w-5 h-5 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                <span class="pr-1">Execute</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <pre x-show="isTextareaHidden" class="font-mono overflow-y-auto outline-none bg-blue-50 py-2 px-4 rounded-md shadow" style="max-height: 30em;"><code @click="toggle()" class="language-prolog">{!! nl2br($prologQuery->content ?? '% No code yet') !!}</code></pre>
                                <textarea x-show="! isTextareaHidden" class="prolog-queries font-mono outline-none bg-blue-50 w-full py-2 px-4 rounded-md shadow" rows="3">{{ $prologQuery->content }}</textarea>
                            </div>
                        @empty
                            <div class="w-full my-4 p-4 text-center border border-gray-200 rounded-md">no queries yet</div>
                        @endforelse
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div>
        <x-results :resultsLabel="$this->resultsLabel" :resultsClass="$this->resultsClass" :resultsText="$this->resultsText" />
    </div>
    <x-derivation-tree />
</div>
