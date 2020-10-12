<div x-cloak x-data="{modalOpen:false}" class="w-full p-4 text-center border border-gray-200 rounded-md my-4">
    <div class="mb-5 flex flex-col items-start">
        <div class="flex flex-shrink flex-col items-start lg:items-center lg:flex-row lg:justify-between w-full">
            <div>
                <div class="flex items-center font-bold">
                    <label class="mr-5" for="{{'name-file-'. $prologFile->id}}">Name</label>
                    <x-input :id="'name-file-'. $prologFile->id" class="flex-grow outline-none bg-blue-50 py-2 px-4 rounded-md shadow w-full" type="text" name="name" wire:model="prologFile.name" wire:keydown.debounce.200ms="save()"/>
                </div>
                <x-error class="text-red-500 text-left" field="prologFile.name" />
            </div>
            <button type="button" @click="modalOpen = ! modalOpen" class="mt-3 lg:mt-0 text-sm py-1 px-3 border border-gray-200 rounded-lg shadow-sm hover:shadow-md cursor-pointer text-red-600">Delete</button>
            <x-modal-delete titre="Delete File" action="deletePrologFile">
                Are you sure?
            </x-modal-delete>
        </div>
    </div>
    <x-textarea class="prolog-files outline-none bg-blue-50 w-full py-2 px-4 rounded-md shadow" name="content" wire:model="prologFile.content" wire:keydown.debounce.200ms="save()" rows="10"></x-textarea>
    <x-error class="text-red-500" field="prologFile.content" />
</div>
