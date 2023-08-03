<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * El nombre de la clase del modelo asociado a este factory.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define el estado predeterminado del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Generar datos falsos para los campos del empleado
            'Modelo' => $this->faker->word,
            'Serial' => $this->faker->unique()->word,
            'Estado' => $this->faker->word,
            'fechaFabricacion' => $this->faker->date,
            'tipoAsistencia' => $this->faker->word,
            'fechaInstalacion' => $this->faker->date,
            'tipoMantenimiento' => $this->faker->word,
            'fechaMantenimiento' => $this->faker->date,
            'tipoPieza' => $this->faker->word,
            'fechaCambioPieza' => $this->faker->date,
            'numeroCiclos' => $this->faker->numberBetween(1, 9999),
            'fechaIncidente' => $this->faker->date,
            'Observaciones' => $this->faker->sentence,
            'Img' => $this->faker->imageUrl(),
        ];
    }
}

