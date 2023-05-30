<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Application::class;

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
        'version_count' => $this->faker->randomDigitNotNull,
        'version' => $this->faker->word,
        'account_fk' => $this->faker->word,
        'package' => $this->faker->word,
        'notification_app_id' => $this->faker->word,
        'notification_server_key' => $this->faker->text,
        'update_title' => $this->faker->word,
        'update_message' => $this->faker->text,
        'status' => $this->faker->word,
        'uuid' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
