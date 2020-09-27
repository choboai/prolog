<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Clause
 *
 * @mixin IdeHelperClause
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Predicate|null $predicate
 * @property-read \App\Models\Program $program
 * @method static \Illuminate\Database\Eloquent\Builder|Clause newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Clause newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Clause query()
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereUpdatedAt($value)
 */
class Clause extends Model
{
    use HasFactory;

    protected $fillable = [
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function predicate(): HasOne
    {
        return $this->hasOne(Predicate::class);
    }
}
