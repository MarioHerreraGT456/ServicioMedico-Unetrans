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
        $persona = Auth::user();
        $buscar = $request->input('buscar');
        $consultas = collect();

        // Lista de campos comunes en ambas tablas según tus migraciones
        $camposComunes = [
            'id', 'cedula', 'nombre', 'apellido', 'tipo', 'sexo', 
            'fecha_nacimiento', 'edad', 'direccion', 'telefono', 
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
                'dientes',
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
                $q->where('cedula', 'like', "{$buscar}%")
                  ->orWhere('nombre', 'like', "%{$buscar}%")
                  ->orWhere('apellido', 'like', "%{$buscar}%")
                  ->orWhere('fecha_consulta', 'like', "%{$buscar}%")
                  ->orWhere('especialidad', 'like', "%{$buscar}%")
                  ->orWhere('nombre_doctor', 'like', "%{$buscar}%");
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
        ];

        // 2. Validación para Odontología: Si viene el campo 'diente', hacemos obligatorios sus campos
        $esOdontologia = $request->has('diente');

        if ($esOdontologia) {
            $rules['examen'] = 'required|json';
            $rules['dientes'] = 'required|json';
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
