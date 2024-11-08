<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beneficiario;
use App\Models\Aportante;
use Illuminate\Pagination\LengthAwarePaginator;


class BeneficiarioController extends Controller
{
    public function index(Request $request)
    {
        $cedulaAportante = $request->input('cedula_aportante');
        $identificacion = $request->input('identificacion');
    
        // Si se busca por identificación de beneficiario
        if ($identificacion) {
            $beneficiarios = Beneficiario::where('identificacion', 'LIKE', '%' . $identificacion . '%')->paginate(10);
        }
        // Si se busca por la cédula del aportante
        elseif ($cedulaAportante) {
            $aportante = Aportante::where('cedula', $cedulaAportante)->first();
            if ($aportante) {
                $beneficiarios = Beneficiario::where('aportante_id', $aportante->id)->paginate(10);
            } else {
                // Crear un paginador vacío si el aportante no existe
                $beneficiarios = new LengthAwarePaginator([], 0, 10);
            }
        } else {
            // Si no se realiza ninguna búsqueda, muestra todos los beneficiarios
            $beneficiarios = Beneficiario::with('aportante')->paginate(10);
        }
    
        $aportantes = Aportante::all();
        return view('beneficiarios.index', compact('beneficiarios', 'aportantes'));
    }
    

    // Método para buscar beneficiario por cédula
    public function buscarPorCedula(Request $request)
    {
        $cedula = $request->input('cedula');

        // Busca beneficiario por su identificación
        $beneficiarios = Beneficiario::where('identificacion', 'LIKE', "%{$cedula}%")->paginate(10);

        // Retorna la vista con los beneficiarios encontrados
        return view('beneficiarios.index', compact('beneficiarios'));
    }

    // Método para buscar beneficiarios de un aportante
    public function buscarPorAportante(Request $request)
    {
        $cedulaAportante = $request->input('cedula_aportante');

        // Busca el aportante por su cédula
        $aportante = Aportante::where('cedula', $cedulaAportante)->first();

        // Si se encuentra el aportante, busca sus beneficiarios
        if ($aportante) {
            $beneficiarios = Beneficiario::where('aportante_id', $aportante->id)->paginate(10);
        } else {
            $beneficiarios = collect(); // Si no se encuentra aportante, devolvemos una colección vacía
        }

        return view('beneficiarios.index', compact('beneficiarios'));
    }

    public function create()
    {
        return view('beneficiarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'identificacion' => 'required|string|max:20|unique:beneficiarios,identificacion',
            'tipo_identificacion' => 'required|in:TI,RC', // Validar el tipo de identificación
            'direccion' => 'required|string|max:255',
            'parentesco' => 'required|string|max:50',
            'fecha_nacimiento' => 'required|date',
            'aportante_id' => 'required|exists:aportantes,id',
        ]);

        // Crear un nuevo beneficiario
        $beneficiario = Beneficiario::create($request->all());

        // Verificar si el beneficiario cumple 18 años
        if ($this->isEighteenOrOlder($beneficiario->fecha_nacimiento)) {
            // Crear el aportante automáticamente
            Aportante::create([
                'nombres' => $beneficiario->nombres,
                'apellidos' => $beneficiario->apellidos,
                'cedula' => $beneficiario->identificacion, // Asumimos que la identificación se usa como cédula
                'telefono' => null, // No se especifica el teléfono
                'direccion' => $beneficiario->direccion,
                'fecha_nacimiento' => $beneficiario->fecha_nacimiento,
            ]);
            $beneficiario->delete(); // Eliminar el beneficiario
        }

        return redirect()->route('beneficiarios.index')->with('success', 'Beneficiario creado con éxito.');
    }

    public function edit($id)
    {
        $beneficiario = Beneficiario::findOrFail($id);
        $aportantes = Aportante::all();
        return view('beneficiarios.edit', compact('beneficiario', 'aportantes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'identificacion' => 'required|string|max:20|unique:beneficiarios,identificacion,' . $id,
            'tipo_identificacion' => 'required|in:TI,RC', // Validar el tipo de identificación
            'direccion' => 'required|string|max:255',
            'parentesco' => 'required|string|max:50',
            'fecha_nacimiento' => 'required|date',
            'aportante_id' => 'required|exists:aportantes,id',
        ]);

        $beneficiario = Beneficiario::findOrFail($id);
        $beneficiario->update($request->all());

        return redirect()->route('beneficiarios.index')->with('success', 'Beneficiario actualizado con éxito.');
    }

    public function destroy($id)
    {
        $beneficiario = Beneficiario::findOrFail($id);
        $beneficiario->delete();

        return redirect()->route('beneficiarios.index')->with('success', 'Beneficiario eliminado con éxito.');
    }

    // Función para verificar si cumple 18 años
    private function isEighteenOrOlder($fecha_nacimiento)
    {
        $dateOfBirth = \Carbon\Carbon::parse($fecha_nacimiento);
        return $dateOfBirth->diffInYears(now()) >= 18;
    }
}
