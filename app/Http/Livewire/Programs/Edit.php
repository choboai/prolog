<?php

namespace App\Http\Livewire\Programs;

use App\Models\Program;
use App\Models\PrologFile;
use App\Models\PrologQuery;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    /**
     * @psalm-suppress PropertyNotSetInConstructor
     * @var Program
     */
    public $program;

    /**
     * @psalm-suppress PropertyNotSetInConstructor
     * @var string[]
     *
     * @psalm-var array{prologFileDeleted: string, prologQueryDeleted: string, contentSaved: string}
     */
    protected $listeners = [
        'prologFileDeleted' => 'getPrologFilesProperty',
        'prologQueryDeleted' => 'getPrologQueriesProperty',
        'contentSaved' => 'getUpdatedAtProperty',
    ];

    /**
     * @psalm-suppress PropertyNotSetInConstructor
     * @var string[]
     *
     * @psalm-var array{'program.name': string, 'program.is_public': string, 'program.team_id': string}
     */
    protected $rules = [
        'program.name' => 'required|string|min:4',
        'program.is_public' => 'nullable|boolean',
        'program.team_id' => 'nullable|numeric',
    ];

    public function save(): void
    {
        $this->authorize('update', $this->program);

        $this->validate();
        if ($this->program->team_id == 0) {
            $this->program->team_id = null;
        }

        $this->program->save();
    }

    public function createPrologFile(): void
    {
        $this->program->prolog_files()->create();
        $this->getPrologFilesProperty();
    }

    public function createPrologQuery(): void
    {
        $this->program->prolog_queries()->create();
        $this->getPrologQueriesProperty();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     *
     * @psalm-return \Illuminate\Database\Eloquent\Collection<PrologFile>
     */
    public function getPrologFilesProperty(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->program->prolog_files()->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     *
     * @psalm-return \Illuminate\Database\Eloquent\Collection<PrologQuery>
     */
    public function getPrologQueriesProperty(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->program->prolog_queries()->get();
    }

    public function getUpdatedAtProperty(): ?\Illuminate\Support\Carbon
    {
        return $this->program->updated_at;
    }

    public function deleteProgram(): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('delete', $this->program);

        $this->program->delete();

        session()->flash('ok', 'Program successfully deleted.');

        return redirect()->route('programs.index');
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.programs.edit');
    }
}
