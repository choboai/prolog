<?php

namespace App\Http\Livewire\Programs;

use App\Models\Program;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $page = 1;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        $this->fill(request()->only('search', 'page'));
    }
    public function render()
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
