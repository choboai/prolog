<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PrologQuery
 *
 * @mixin IdeHelperPrologQuery
 * @property int $id
 * @property string $name
 * @property string $content
 * @property int $program_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Program $program
 * @method static \Illuminate\Database\Eloquent\Builder|PrologQuery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrologQuery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrologQuery query()
 * @method static \Illuminate\Database\Eloquent\Builder|PrologQuery whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrologQuery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrologQuery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrologQuery whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrologQuery whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrologQuery whereUpdatedAt($value)
 * @method static \Database\Factories\PrologQueryFactory factory(...$parameters)
 */
class PrologQuery extends Model
{
    use HasFactory;

    /**
     * @var string[]
     *
     * @psalm-var array{0: string, 1: string, 2: string}
     */
    protected $fillable = [
        'name',
        'content',
        'program_id',
    ];

    /**
     * @var string[]
     *
     * @psalm-var array{0: string}
     */
    protected $touches = ['program'];

    /**
     * @return BelongsTo
     *
     * @psalm-return BelongsTo<Program>
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
}
