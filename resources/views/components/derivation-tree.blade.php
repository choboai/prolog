
    <div x-data x-show="window.treeDataUrl != undefined" class="w-full pb-2">
        <h2 class="text-2xl font-mono font-bold mr-5">Derivation tree</h2>
        <img class="my-5" id="derivation-img" x-bind:src="window.treeDataUrl" alt="">
        <a class="text-sm py-1 px-3 border border-gray-200 rounded-lg shadow-sm hover:shadow-md cursor-pointer mr-4" @click="window.openImage($event)" target="_blank">
            visualise in a new tab (only works with chromium based browsers)
        </a>
        <div id="derivation-canvas" class="hidden">
            <canvas id="derivation"></canvas>
        </div>
    </div>
