<?php

namespace Database\Factories;

use App\Models\MusicLyric;
use Illuminate\Database\Eloquent\Factories\Factory;

class MusicLyricFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MusicLyric::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->word,
        'music_fk' => $this->faker->word,
        'language_fk' => $this->faker->word,
        'lyrics' => $this->faker->text,
        'uuid' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
