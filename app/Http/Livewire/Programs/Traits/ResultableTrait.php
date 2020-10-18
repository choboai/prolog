<?php

namespace App\Http\Livewire\Programs\Traits;

trait ResultableTrait
{
    /**
     * @var array|string
     */
    public $resultsText = 'Execute a query to get a result';

    /**
     * @var string
     */
    public $resultsClass = 'results-start';

    /**
     * @var string
     */
    public $resultsLabel = 'Results';

    /**
     *
     * @param string $type
     * @param mixed $text
     * @return void
     */
    public function saveResults($type, $text): void
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
