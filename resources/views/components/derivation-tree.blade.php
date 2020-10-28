
    <div x-data x-show="window.treeDataUrl != undefined" class="w-full">
        <h2 class="text-2xl font-mono font-bold mr-5">Derivation tree</h2>
        <a x-bind:href="window.treeDataUrl" target="_blank" class="overflow-x-auto">
            <img id="derivation-img" x-bind:src="window.treeDataUrl" alt="">
        </a>
        <div id="derivation-canvas" class="hidden">
            <canvas id="derivation"></canvas>
        </div>
    </div>
