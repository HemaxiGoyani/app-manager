<?php

namespace Database\Factories;

use App\Models\WallpaperCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class WallpaperCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WallpaperCategory::class;

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
        'order' => $this->faker->word,
        'uuid' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
