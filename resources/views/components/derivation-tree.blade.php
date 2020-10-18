
    <div x-data x-show="window.tree != ''" class="w-full">
        <h2 class="text-2xl font-mono font-bold mr-5">Derivation tree</h2>
        <div x-html="window.tree" class="overflow-x-auto">
        </div>
        <div class="hidden">
            <canvas id="derivation"></canvas>
        </div>
    </div>
