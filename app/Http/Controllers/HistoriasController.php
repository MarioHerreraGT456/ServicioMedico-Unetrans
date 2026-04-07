<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Historias;
use App\Models\Persona;
use App\Models\HistoriasOdontologo;

class HistoriasController extends Controller
{
    public function showHistoriaForm()
    {
        $persona = Auth::user();
        $medico = $persona->medico;
        return view('crear-historias', compact('persona', 'medico'));
    }

   public function index(Request $request)
{
    $buscar = $request->input('buscar');
    $esOdontologia = $request->has('dientes');

    if (empty($buscar)) {
        return view('historias', ['consultas' => collect(), 'buscar' => $buscar]);
    }
    
    

    // 2. Query para Historias Generales
    $queryGeneral = Historias::select([
    'id', 'cedula', 'nombre', 'apellido', 'tipo', 'sexo', 
    'fecha_nacimiento', 'direccion', 'telefono', 
    'motivo_consulta', 'enfermedad', 'antecedentes_familiares', 
    'antecedentes_personales', 'radiodiagnóstico', 'tratamiento', 
    'created_at', 'foto', 'visitante',
    DB::raw('NULL as examen'), 
    DB::raw('NULL as diente'),
    DB::raw("'General' as especialidad")
]);

$queryOdonto = HistoriasOdontologo::select([
    'id', 'cedula', 'nombre', 'apellido', 'tipo', 'sexo', 
    'fecha_nacimiento', 'direccion', 'telefono', 
    'motivo_consulta', 'enfermedad', 'antecedentes_familiares', 
    'antecedentes_personales', 'radiodiagnóstico', 'tratamiento', 
    'created_at', 'foto', 'visitante',
    'examen',
    'dientes as diente',
    DB::raw("'Odontología' as especialidad")
]);

    // 4. Aplicar filtros si existe una búsqueda
    if ($buscar) {
        $filtro = function($q) use ($buscar) {
            $q->where('cedula', 'like', "{$buscar}%")
              ->orWhere('nombre', 'like', "%{$buscar}%")
              ->orWhere('apellido', 'like', "%{$buscar}%")
              ->orWhere('motivo_consulta', 'like', "%{$buscar}%")
              ->orWhere('tratamiento', 'like', "%{$buscar}%");
        };

        $queryGeneral->where($filtro);
        $queryOdonto->where($filtro);
    }

    // 5. Unir y ejecutar (Ordenamos por la fecha de creación más reciente)
    $consultas = $queryGeneral
        ->union($queryOdonto)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('historias', compact('consultas', 'buscar'));
}
    
    public function store(Request $request)
    {

        $rutasFotos = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $foto) {
                // Guardar en public/historias y obtener la ruta
                $ruta = $foto->store('historias', 'public');
                $rutasFotos[] = $ruta;
            }
        }
        // 1. Definimos las reglas básicas comunes para ambas tablas
        $rules = [
            'nombre'                  => 'required|string|max:255',
            'nombre2'                  => 'required|string|max:255',
            'apellido'                => 'required|string|max:255',
            'apellido2'                  => 'required|string|max:255',
            'tipo'                    => 'required|in:V,E',
            'cedula'                  => 'required|integer', 
            'codigo'                    => 'required|in:0412,0414,0416,0424,0426',
            'telefono'                => 'required|string|max:7',
            'direccion'               => 'required|string',
            'fecha_nacimiento'        => 'required|date',
            'sexo'                    => 'required|in:masculino,femenino',
            'motivo_consulta'         => 'required|string',
            'enfermedad'              => 'required|string',
            'antecedentes_familiares' => 'required|string',
            'antecedentes_personales' => 'required|json',
            'radiodiagnóstico'        => 'required|string',
            'tratamiento'             => 'required|string',
            'visitante'               => 'required|in:si,no',
            'foto' => 'nullable|array|max:5',
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ];

        // 2. Validación para Odontología: Si viene el campo 'diente', hacemos obligatorios sus campos
        $esOdontologia = $request->has('dientes');

        if ($esOdontologia) {
            $rules['examen'] = 'required|in:labios,lengua,piso_bucal,encias,atm,oclusion';
            $rules['dientes'] = 'required|json';
            $rules['odontograma'] = 'nullable|string';
        }

        
        
        $validatedData = $request->validate($rules);
        $validatedData['foto'] = $rutasFotos;

        // dd($validatedData, $esOdontologia);
        

        DB::beginTransaction();

        try {
            if ($esOdontologia) {
                // Guardar en la tabla historias-odontologo
                HistoriasOdontologo::create($validatedData);
            } else {
                // Guardar en la tabla historias (General)
                Historias::create($validatedData);
            }

            DB::commit(); 
            return redirect()->route('crear-historias')->with('success', 'Historia clínica registrada exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al guardar: ' . $e->getMessage()])->withInput();
        }
    }
}
