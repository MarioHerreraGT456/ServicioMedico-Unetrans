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
        return view('crear-historias');
    }

   public function index(Request $request)
    {
        $persona = Auth::user();
        $buscar = $request->input('buscar');
        $consultas = collect();

        // Lista de campos comunes en ambas tablas según tus migraciones
        $camposComunes = [
            'id', 'cedula', 'nombre', 'apellido', 'tipo', 'sexo', 
            'fecha_nacimiento', 'edad', 'correo', 'direccion', 'telefono', 
            'motivo_consulta', 'enfermedad', 'antecedentes_familiares', 
            'antecedentes_personales', 'radiodiagnóstico', 'tratamiento', 'created_at'
        ];

        // 1. Consulta Historias Generales (Agregamos NULL en los campos que NO tiene)
        $queryGeneral = DB::table('historias')
            ->select(array_merge($camposComunes, [
                DB::raw('NULL as examen'), // No existe en historias
                DB::raw('NULL as diente'), // No existe en historias
                DB::raw("'General' as especialidad")
            ]));

        // 2. Consulta Historias Odontología (Tiene todos los campos)
        $queryOdonto = DB::table('historias-odontologo')
            ->select(array_merge($camposComunes, [
                'examen', 
                'diente',
                DB::raw("'Odontología' as especialidad")
            ]));

        // --- LÓGICA DE FILTRADO ---

        if ($persona->rol === 'paciente') {
            // El paciente ve lo suyo automáticamente
            $cedula = $persona->cedula;
            $consultas = $queryGeneral->where('cedula', $cedula)
                ->union($queryOdonto->where('cedula', $cedula))
                ->orderBy('created_at', 'desc')
                ->get();

        } elseif ($persona->rol === 'medico' && $buscar) {
            // El médico solo ve si busca algo
            $filtro = function($q) use ($buscar) {
                $q->where('cedula', 'like', "%{$buscar}%")
                  ->orWhere('nombre', 'like', "%{$buscar}%")
                  ->orWhere('apellido', 'like', "%{$buscar}%");
            };

            $consultas = $queryGeneral->where($filtro)
                ->union($queryOdonto->where($filtro))
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('historias', compact('consultas', 'buscar', 'persona'));
    }
    
    public function store(Request $request)
    {
        // 1. Definimos las reglas básicas comunes para ambas tablas
        $rules = [
            'nombre'                  => 'required|string|max:255',
            'apellido'                => 'required|string|max:255',
            'tipo'                    => 'required|in:V,E',
            'cedula'                  => 'required|integer', 
            'correo'                  => 'required|email',
            'telefono'                => 'required|string|max:11',
            'direccion'               => 'required|string',
            'edad'                    => 'required|integer|min:0',
            'fecha_nacimiento'        => 'required|date',
            'sexo'                    => 'required|in:masculino,femenino',
            'motivo_consulta'         => 'required|string',
            'enfermedad'              => 'required|string',
            'antecedentes_familiares' => 'required|string',
            'antecedentes_personales' => 'required|in:hemorragia,cardiovascular,respiratorio,alergias,diabetes,epilepsia,tratamiento_medico,medicacion',
            'radiodiagnóstico'        => 'required|string',
            'tratamiento'             => 'required|string',
        ];

        // 2. Validación para Odontología: Si viene el campo 'diente', hacemos obligatorios sus campos
        $esOdontologia = $request->has('diente');

        if ($esOdontologia) {
            $rules['examen'] = 'required|in:labios,lengua,piso_bucal,encias,atm,oclusion';
            $rules['diente'] = 'required|in:18,17,16,15,14,13,12,11,21,22,23,25,26,27,28,48,47,46,45,44,43,42,41,31,32,33,34,35,36,37,38';
            $rules['odontograma'] = 'nullable|string';
        }

        $validatedData = $request->validate($rules);

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
