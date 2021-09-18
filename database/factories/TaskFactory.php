<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph,
            'completed' => $this->faker->boolean,
            'end_date' => $this->faker->date
        ];
    }

    public function ofUser(User $user)
    {
        return $this->state([
            'user_id' => $user->id
        ]);
    }

    public function uncompleted()
    {
        return $this->state([
            'completed' => false
        ]);
    }

    public function completed()
    {
        return $this->state([
            'completed' => true
        ]);
    }
}
