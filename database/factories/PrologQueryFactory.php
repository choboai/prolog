<?php

namespace Database\Factories;

use App\Models\PrologQuery;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrologQueryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PrologQuery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'What Sam does like?',
            'content' => 'likes(sam, X).',
        ];
    }
}
