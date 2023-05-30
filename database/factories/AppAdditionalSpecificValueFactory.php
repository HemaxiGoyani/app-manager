<?php

namespace Database\Factories;

use App\Models\AppAdditionalSpecificValue;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppAdditionalSpecificValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AppAdditionalSpecificValue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->word,
        'app_fk' => $this->faker->word,
        'attribute_fk' => $this->faker->word,
        'value' => $this->faker->text,
        'uuid' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
