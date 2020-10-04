<div class="w-full p-4 text-center border border-gray-200 rounded-md my-4">
    <div class="mb-5 flex flex-col items-start">
        <div class="flex items-center font-bold w-64">
            <x-label class="mr-5" for="name" />
            <x-input class="outline-none bg-blue-50 w-full py-2 px-4 rounded-md shadow" type="text" name="name" wire:model="prologFile.name" wire:keydown.debounce.200ms="save()"/>
        </div>
        <x-error class="text-red-500" field="prologFile.name" />
    </div>
    <x-textarea class="outline-none bg-blue-50 w-full py-2 px-4 rounded-md shadow" name="content" wire:model="prologFile.content" wire:keydown.debounce.200ms="save()" rows="10"></x-textarea>
    <x-error class="text-red-500" field="prologFile.content" />
</div>
