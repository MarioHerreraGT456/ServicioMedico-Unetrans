<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PacienteBase;

class ImportController extends Controller
{
    public function index()
    {
        return view('import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:csv,txt'
        ]);

        $file = fopen($request->file('archivo'), 'r');

        $header = fgetcsv($file); // saltar encabezado

        while (($row = fgetcsv($file)) !== false) {

            PacienteBase::updateOrCreate(
                ['cedula' => $row[0]],
                [
                    'nombre' => $row[1],
                    'nombre2' => $row[2],
                    'apellido' => $row[3],
                    'apellido2' => $row[4],
                    'tipo_paciente' => $row[5],
                    'pnf' => $row[6] ?? null,
                    'tipo_personal' => $row[7] ?? null,
                ]
            );
        }

        fclose($file);

        return back()->with('success', 'Datos importados correctamente');
    }
}
