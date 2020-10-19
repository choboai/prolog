<?php

namespace App\Http\Livewire\Programs;

use App\Http\Livewire\Programs\Traits\ResultableTrait;
use App\Models\Program;
use App\Models\PrologFile;
use App\Models\PrologQuery;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use InvalidArgumentException;
use Livewire\Component;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class Show extends Component
{
    use ResultableTrait;

    /**
     * @psalm-suppress PropertyNotSetInConstructor
     * @var Program
     */
    public $program;

    /**
     * @var string[]
     */
    protected $listeners = [
        'result' => 'saveResults',
    ];

    /**
     * @return Collection
     *
     * @psalm-return Collection<PrologFile>
     */
    public function getPrologFilesProperty(): Collection
    {
        return $this->program->prolog_files()->get();
    }

    /**
     * @return Collection
     *
     * @psalm-return Collection<PrologQuery>
     */
    public function getPrologQueriesProperty(): Collection
    {
        return $this->program->prolog_queries()->get();
    }

    /**
     * @return RedirectResponse
     * @throws InvalidArgumentException
     * @throws BindingResolutionException
     * @throws RouteNotFoundException
     */
    public function duplicateProgram()
    {
        $clone = $this->program->replicate();
        $clone->user_id = intval(Auth::id()) === 0 ? null : intval(Auth::id());
        $clone->team_id = null;
        $clone->name = $clone->name . " (copy)";
        $clone->save();

        $this->program->prolog_files->each(function (PrologFile $file) use ($clone) {
            $clone->prolog_files()->create($file->toArray());
        });

        $this->program->prolog_queries->each(function (PrologQuery $query) use ($clone) {
            $clone->prolog_queries()->create($query->toArray());
        });

        session()->flash('ok', 'Program successfully cloned.');

        return redirect()->route('programs.edit', $clone);
    }

    /**
     * @return View
     *
     * @throws BindingResolutionException
     */
    public function render(): View
    {
        return view('livewire.programs.show');
    }
}
