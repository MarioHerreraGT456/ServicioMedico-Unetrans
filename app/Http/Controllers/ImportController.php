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

        $header = fgetcsv($file);

        $errores = [];
        $filasValidas = [];

        $filaNum = 1;

        while (($row = fgetcsv($file)) !== false) {

            $filaNum++;

            if (!$row[0] || !$row[1] || !$row[3] || !$row[5]) {
                $errores[] = "Fila $filaNum incompleta";
                continue;
            }

            if (!in_array($row[5], ['estudiante','personal'])) {
                $errores[] = "Fila $filaNum tipo inválido";
                continue;
            }

            $filasValidas[] = $row;
        }

        fclose($file);

        // SI HAY ERRORES --- NO GUARDAR
        if (count($errores) > 0) {
            return back()->withErrors([
                'error' => 'Se encontraron errores en el archivo. No se importó nada.'
            ])->with('errores_detalle', $errores);
        }

        // GUARDAR SOLO SI TODO OK
        foreach ($filasValidas as $row) {

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

        return back()->with('success', 'Datos importados correctamente');
    }
}
