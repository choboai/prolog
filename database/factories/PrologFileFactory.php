<?php

namespace Database\Factories;

use App\Models\PrologFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrologFileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PrologFile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'rules',
            'content' => 'likes(sam, salad).
likes(dean, pie).
likes(sam, apples).
likes(dean, whiskey).',
        ];
    }
}
