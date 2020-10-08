<div class="min-h-screen flex flex-col mt-8 items-center pt-4 sm:pt-0">
    <div class="text-6xl font-mono font-extrabold">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
