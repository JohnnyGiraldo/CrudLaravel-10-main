<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Employee;

class DatabaseSeeder extends Seeder
{
    /**
     * Ejecuta los seeders de la aplicación.
     */
    public function run(): void
    {
        // Crea 6 registros en la tabla departments usando el factory
        Department::factory()->create();

        // Crea 25 registros en la tabla employees usando el factory
        Employee::factory()->create();
    }
}

