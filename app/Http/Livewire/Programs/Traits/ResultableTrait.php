<?php

namespace App\Http\Livewire\Programs\Traits;

trait ResultableTrait
{
    /**
     * @var string
     */
    public $resultsText = 'Execute a query to get a result';

    /**
     * @var string
     */
    public $resultsClass = 'bg-indigo-700';

    /**
     * @var string
     */
    public $resultsLabel = 'Results';

    public function saveResults(string $type, string $text): void
    {
        $classes = [
            'success' => 'results-success',
            'error' => 'results-error',
        ];

        $labels = [
            'success' => 'Results ✅',
            'error' => 'Results ❌',
        ];

        $this->resultsClass = $classes[$type];
        $this->resultsLabel = $labels[$type];
        $this->resultsText = $text;
    }
}
