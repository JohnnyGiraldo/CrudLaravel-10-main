<?php 


use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Employee;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crea 6 registros en la tabla departments usando el factory
        Department::factory(6)->create();

        // Crea 25 registros en la tabla employees usando el factory
        Employee::factory(25)->create([
            'department_id' => Department::inRandomOrder()->first()->id
        ]);
    }
}

