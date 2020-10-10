<div x-cloak x-data="{modalOpen:false}" class="w-full p-4 text-center border border-gray-200 rounded-md my-4">
    <div class="mb-5 flex flex-col items-start">
        <div class="flex flex-col items-start sm:items-center sm:flex-row sm:justify-between w-full">
            <div>
                <div class="flex items-center font-bold">
                    <label class="mr-5" for="{{'name-query-'. $prologQuery->id}}">Query Name</label>
                    <x-input :id="'name-query-'. $prologQuery->id" class="flex-grow outline-none bg-blue-50 py-2 px-4 rounded-md shadow" type="text" name="name" wire:model="prologQuery.name" wire:keydown.debounce.200ms="save()"/>
                </div>
                <x-error class="text-red-500 text-left" field="prologQuery.name" />
            </div>
            <button type="button" @click="modalOpen = ! modalOpen" class="mt-2 sm:mt-0 float-right text-red-600">Delete</button>
            <x-modal-delete titre="Delete Query" action="deletePrologQuery">
                Are you sure?
            </x-modal-delete>
        </div>
    </div>
    <x-textarea class="prolog-queries outline-none bg-blue-50 w-full py-2 px-4 rounded-md shadow" name="content" wire:model="prologQuery.content" wire:keydown.debounce.200ms="save()" rows="3"></x-textarea>
    <x-error class="text-red-500" field="prologQuery.content" />
    <div class="h-8 mt-3">
        <button x-data @click="evaluate($event)" class="inline-flex items-center text-sm py-1 px-3 border border-gray-200 rounded-lg shadow-sm hover:shadow-md cursor-pointer float-right" type="button">
            <svg class="w-6 h-6 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Execute
        </button>
    </div>
</div>
