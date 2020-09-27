<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function clauses(): HasMany
    {
        return $this->hasMany(Clause::class);
    }

    public function prolog_files(): HasMany
    {
        return $this->hasMany(PrologFile::class);
    }

    public function prolog_queries(): HasMany
    {
        return $this->hasMany(PrologQuery::class);
    }
}
