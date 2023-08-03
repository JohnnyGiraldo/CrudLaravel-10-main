<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DepartmentController extends Controller
{

    public function index()
    {
        // todos los registros de la tabla, se asignan a la variable departamentos
        $departments = Department::all();
        // se retorna mediante Inertia hacia la vista de la carpeta deptos y el archivo index
        // a la vista se le envian los deptos como parametros o props
        return Inertia::render('Departments/Index', ['departments' => $departments]);
    }

    public function create()
    {
         // los deptos van en un CRUD con vistas separadas. En la funcion redirigimos a
        // la vista de la carpeta deptos y el archivo se llama create
        return Inertia::render('Departments/Create');
    }

    public function store(Request $request)
    {
        //funcion para guardar. El nombre es requerido y tiene un max. de 100 caracteres
        $request->validate([
            'Serial' => 'required|max:100',
            'pais' => 'required|max:100',
            'ciudad' => 'required|max:100',
            'institucion' => 'required|max:100',
            'telefono' => 'required|max:15',
            'direccion' => 'required|max:100',
            'ubicacionEquipo' => 'required|max:100',
            'piso' => 'required|max:100',
        ]);
        // nuevo depto con los datos del request
        $department = new Department($request->input());
        // una vez creado se guarda y se retorna a la vista deptos
        $department->save();
        return redirect('departments');
    }

    public function show(Department $department)
    {
        // Puedes implementar lógica específica aquí si deseas mostrar un departamento específico.
        // Por ejemplo, puedes renderizar una vista para mostrar los detalles de un departamento.
    }

    public function edit(Department $department)
    {
        //es similar a crear solo que redirige a la vista editar. Pasa la info del depto
        return Inertia::render('Departments/Edit', ['department' => $department]);
    }

    public function update(Request $request, Department $department)
    {
        //se pide el nombre y se actualiza con la info del request
        $request->validate([
            'Serial' => 'required|max:100',
            'pais' => 'required|max:100',
            'ciudad' => 'required|max:100',
            'institucion' => 'required|max:100',
            'telefono' => 'required|max:15',
            'direccion' => 'required|max:100',
            'ubicacionEquipo' => 'required|max:100',
            'piso' => 'required|max:100',
        ]);
        $department->update($request->input());
        return redirect('departments');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect('departments');
    }
}


