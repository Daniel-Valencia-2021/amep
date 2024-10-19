<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aportante;

class AportanteController extends Controller
{
    // Mostrar la lista de aportantes
    public function index(Request $request)
    {
        $cedula = $request->input('cedula'); // Obtiene la cédula desde la solicitud
    
        if ($cedula) {
            // Si se ingresó una cédula, filtra los aportantes por cédula
            $aportantes = Aportante::where('cedula', 'LIKE', '%' . $cedula . '%')->paginate(10);
        } else {
            // Si no hay cédula, muestra todos los aportantes
            $aportantes = Aportante::where('cedula', '!=', '1')->paginate(10);
        }
    
        return view('aportantes.index', compact('aportantes'));
    }

    // Mostrar el formulario para crear un nuevo aportante
    public function create()
    {
        return view('aportantes.create');
    }

    // Almacenar un nuevo aportante en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:aportantes,cedula',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
        ]);

        // Crear un nuevo aportante
        Aportante::create($request->all());

        // Redirigir a la lista de aportantes
        return redirect()->route('aportantes.index')->with('success', 'Aportante creado con éxito.');
    }

    // Mostrar un aportante específico (opcional, si quieres usarlo)
    public function show($id)
    {
        $aportante = Aportante::findOrFail($id);
        return view('aportantes.show', compact('aportante'));
    }

    // Mostrar el formulario para editar un aportante
    public function edit($id)
    {
        $aportante = Aportante::findOrFail($id);
        return view('aportantes.edit', compact('aportante'));
    }

    // Actualizar un aportante en la base de datos
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:aportantes,cedula,' . $id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
        ]);

        // Actualizar el aportante
        $aportante = Aportante::findOrFail($id);
        $aportante->update($request->all());

        // Redirigir a la lista de aportantes
        return redirect()->route('aportantes.index')->with('success', 'Aportante actualizado con éxito.');
    }

    // Eliminar un aportante de la base de datos
    public function destroy($id)
    {
        // Buscar y eliminar el aportante
        $aportante = Aportante::findOrFail($id);
        $aportante->delete();

        // Redirigir a la lista de aportantes
        return redirect()->route('aportantes.index')->with('success', 'Aportante eliminado con éxito.');
    }
}
