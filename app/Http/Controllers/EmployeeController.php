<?php

/* Declarando el espacio de nombres del archivo. */

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
/* Importando la clase Request del espacio de nombres Illuminate\Http. */
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

/* Extendiendo la clase Controller. */

class EmployeeController extends Controller
{
    public function index()
    {
        // Select, consulta multitabla de los empleados, ocupando id y nombre,
        $employees = Employee::select(
            'employees.id as employee_id',
            'employees.Serial as employee_Serial',
            'Modelo',
            'Estado',
            'fechaFabricacion',
            'tipoAsistencia',
            'fechaInstalacion',
            'tipoMantenimiento',
            'fechaMantenimiento',
            'tipoPieza',
            'fechaCambioPieza',
            'numeroCiclos',
            'fechaIncidente',
            'Telefono',
            'Observaciones',
            'Img',
            'employees.department_id', // Cambia a 'employees.department_id'
            'departments.Serial as department_Serial'
        )
            ->join('departments', 'departments.id', '=', 'employees.department_id')
            ->paginate(10);
        
        $departments = Department::all();
        
        // La información de ambas tablas se retorna hacia la vista a través de Inertia
        // en un prop van las variables empleados y deptos
        return Inertia::render('Employees/Index', [
            'employees' => $employees,
            'departments' => $departments
        ]);
    }
        
    public function store(Request $request)
    {
        // Validar la info de los campos con sus respectivas especificaciones
        $request->validate([
            'Modelo' => 'required|max:150',
            'Estado' => 'required|max:10',
            'fechaFabricacion' => 'required|date',
            'tipoAsistencia' => 'required|max:150',
            'fechaInstalacion' => 'required|date',
            'tipoMantenimiento' => 'required|max:150',
            'fechaMantenimiento' => 'required|date',
            'tipoPieza' => 'required|max:150',
            'fechaCambioPieza' => 'required|date',
            'numeroCiclos' => 'required|int',
            'fechaIncidente' => 'required|date',
            'Telefono' => 'required|int',
            'Observaciones' => 'required|max:500',
            'Img' => 'required|max:150',
        ]);
        // Se crea un nuevo empleado con la info del request
        $employee = new Employee($request->input());
        $employee->save();
        return redirect('employees');
    }
    public function update(Request $request, Employee $employee)
    {
        //
        $request->validate([
            'Modelo' => 'required|max:150',
            'Estado' => 'required|max:10',
            'fechaFabricacion' => 'required|date',
            'tipoAsistencia' => 'required|max:150',
            'fechaInstalacion' => 'required|date',
            'tipoMantenimiento' => 'required|max:150',
            'fechaMantenimiento' => 'required|date',
            'tipoPieza' => 'required|max:150',
            'fechaCambioPieza' => 'required|date',
            'numeroCiclos' => 'required|int',
            'fechaIncidente' => 'required|date',
            'Telefono' => 'required|int',
            'Observaciones' => 'required|max:500',
            'Img' => 'required|max:150',
        ]);
        $employee->update($request->input());
        return redirect('employees');
    }
    public function destroy(Employee $employee)
    /* A blade directive that is used to open a section. */
    {
        $employee->delete();
        return redirect('employees');
    }
    public function EmployeeByDepartment()
    {
        // Función para la gráfica
        // En el select se calcula el número de empleados y se renombra count, incluye nombre de los deptos
        $data = Employee::select(DB::raw('count(employees.id) as count, departments.Serial'))
            ->join('departments', 'departments.id', '=', 'employees.department_id')
            // Se agrupan por nombre de depto
            ->groupBy('departments.Serial')->get();
        // La información de la consulta se envía a la vista Graphic con la info en un prop
        return Inertia::render('Employees/Graphic', ['data' => $data]);
    }
    public function reports()
    {
        $employees = Employee::select(
            'employees.id as employee_id', // Cambia 'id' por 'employee_id'
            'employees.Serial as employee_Serial', // Cambia 'Serial' por 'employee_Serial'
            'Modelo',
            'Estado',
            'fechaFabricacion',
            'tipoAsistencia',
            'fechaInstalacion',
            'tipoMantenimiento',
            'fechaMantenimiento',
            'tipoPieza',
            'fechaCambioPieza',
            'numeroCiclos',
            'fechaIncidente',
            'Telefono',
            'Observaciones',
            'Img',
            
            'employee_department_id', // Cambia 'department_id' por 'employee_department_id'
            'departments.Serial as department_Serial'
        )
            ->join('departments', 'departments.id', '=', 'employees.department_id')
            ->get();
        $departments = Department::all();
        return Inertia::render('Employees/Reports', [
            'employees' => $employees,
            'departments' => $departments
        ]);
    }
    /* Cerrando la clase. */
}
