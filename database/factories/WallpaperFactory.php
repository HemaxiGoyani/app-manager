<?php

namespace Database\Factories;

use App\Models\Wallpaper;
use Illuminate\Database\Eloquent\Factories\Factory;

class WallpaperFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wallpaper::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->word,
        'name' => $this->faker->word,
        'category_fk' => $this->faker->word,
        'uuid' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
