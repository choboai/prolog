<div class="mt-4 sm:mt-6">
    <h2 id="results-label" class="text-2xl font-mono font-bold mr-5">{{ $resultsLabel }}</h2>
    @if (is_array($resultsText))
        <pre id="results" class="array {{ $resultsClass }} text-gray-100 font-mono w-full my-4 p-4 border border-gray-200 rounded-md overflow-x-auto">
            {{ print_r($resultsText, true) }}
        </pre>
    @else
        <div id="results" class="{{ $resultsClass }} text-left text-gray-100 font-mono  w-full my-4 p-4 border border-gray-200 rounded-md overflow-x-auto">
            @if ($program->prolog_files->isEmpty())
                Create a prolog file first
            @elseif ($program->prolog_queries->isEmpty())
                Then add a query file
            @else
                {{ $resultsText }}
            @endif
        </div>
    @endif
</div>
