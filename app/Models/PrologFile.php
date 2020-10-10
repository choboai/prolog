<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PrologFile
 *
 * @mixin IdeHelperPrologFile
 * @property int $id
 * @property string $name
 * @property string $content
 * @property int $program_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Program $program
 * @method static \Illuminate\Database\Eloquent\Builder|PrologFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrologFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrologFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|PrologFile whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrologFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrologFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrologFile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrologFile whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrologFile whereUpdatedAt($value)
 */
class PrologFile extends Model
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
