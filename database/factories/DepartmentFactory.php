<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    /**
     * El nombre de la clase del modelo asociado a este factory.
     *
     * @var string
     */
    protected $model = Department::class;

    /**
     * Define el estado predeterminado del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Generar datos falsos para los campos del departamento
            'Serial' => $this->faker->sentence(3),
            'Pais' => $this->faker->country,
            'Ciudad' => $this->faker->city,
            'Institucion' => $this->faker->company,
            'Telefono' => $this->faker->phoneNumber,
            'Direccion' => $this->faker->address,
            'ubicacionEquipo' => $this->faker->streetAddress,
            'Piso' => $this->faker->numberBetween(1, 10),
        ];
    }
}
