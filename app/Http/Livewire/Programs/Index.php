<?php

namespace App\Http\Livewire\Programs;

use App\Models\Program;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    /**
     * @psalm-suppress PropertyNotSetInConstructor
     * @var string
     */
    public $search = '';

    /**
     * @psalm-suppress PropertyNotSetInConstructor
     * @var int
     */
    public $page = 1;

    /**
     * @psalm-suppress PropertyNotSetInConstructor
     * @var (int|string)[][]
     *
     * @psalm-var array{search: array{except: string}, page: array{except: int}}
     */
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    /**
     * @psalm-suppress PossiblyInvalidMethodCall
     * @return void
     * @throws BindingResolutionException
     */
    public function mount()
    {
        $this->fill(request()->only(['search', 'page']));
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.programs.index', [
            'programs' => $this->getProgramsList(),
        ]);
    }

    private function getProgramsList(): Paginator
    {
        return Program::latest()
            ->visibles()
            ->where('name', 'like', '%'.$this->search.'%')
            ->orWhereHas('user', function (Builder $query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })
            ->orWhereHas('team', function (Builder $query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })
            ->paginate(12);
    }
}
