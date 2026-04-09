<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    public function mostrarEstadisticas()
    {
        $totalGeneral = DB::table('table_consultas')
        ->where('especialidad', 'general')
        ->count();
        // 1. Contar cuántos registros son de 'Odontología'
        $totalNiños = DB::table('table_consultas')
            ->where('especialidad', 'general')
            ->where('tipo_consulta', 'niños')
            ->count();

        // 2. Contar cuántos registros son de sexo 'Fem'
        $totalParto = DB::table('table_consultas')
            ->where('especialidad', 'general')
            ->where('tipo_consulta', 'parto')
            ->count();

        // 3. Contar cuántos registros están en estado 'Pendiente'
        $totalPesquisa = DB::table('table_consultas')
        ->where('especialidad', 'general')
            ->where('tipo_consulta', 'pesquisa')
            ->count();

        $totalVital = DB::table('table_consultas')
            ->where('especialidad', 'general')
            ->where('tipo_consulta', 'vital')
            ->count();
        $generalObrero = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'general')
            ->where('pacientes.tipo_paciente', 'obrero')
            ->count();

        $generalDocente = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'general')
            ->where('pacientes.tipo_paciente', 'docente')
            ->count();

        $generalAdministrativo = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'general')
            ->where('pacientes.tipo_paciente', 'administrativo')
            ->count();

        $generalEstudiante = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'general')
            ->where('pacientes.tipo_paciente', 'estudiante')
            ->count();





        //Contadores de visitantes
        $totalVisitantes = DB::table('table_consultas')
            ->where('visitante', 'si')
            ->count();
            $totalVisitantesGeneral = DB::table('table_consultas')
            ->where('especialidad', 'general')
            ->where('visitante', 'si')
            ->count();
            $totalVisitantesOdontologia = DB::table('table_consultas')
            ->where('especialidad', 'odontologia')
            ->where('visitante', 'si')
            ->count();
            $totalVisitantesPsiquiatria = DB::table('table_consultas')
            ->where('especialidad', 'psiquiatria')
            ->where('visitante', 'si')
            ->count();
            $totalVisitantesFisiatria = DB::table('table_consultas')
            ->where('especialidad', 'fisiatria')
            ->where('visitante', 'si')
            ->count();
            $totalVisitantesTraumatologia = DB::table('table_consultas')
            ->where('especialidad', 'traumatologia')
            ->where('visitante', 'si')
            ->count();



            //Contadores de odontologia
        $totalOdontologia = DB::table('table_consultas')
            ->where('especialidad', 'odontologia')
            ->count();
            $odontologiaObrero = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'odontologia')
            ->where('pacientes.tipo_paciente', 'obrero')
            ->count();

        $odontologiaDocente = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'odontologia')
            ->where('pacientes.tipo_paciente', 'docente')
            ->count();

        $odontologiaAdministrativo = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'odontologia')
            ->where('pacientes.tipo_paciente', 'administrativo')
            ->count();

        $odontologiaEstudiante = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'odontologia')
            ->where('pacientes.tipo_paciente', 'estudiante')
            ->count();
        
        //Contadores de psiquiatria
        $totalPsiquiatria = DB::table('table_consultas')
            ->where('especialidad', 'psiquiatria')
            ->count();
        $psiquiatriaObrero = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'psiquiatria')
            ->where('pacientes.tipo_paciente', 'obrero')
            ->count();

        $psiquiatriaDocente = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'psiquiatria')
            ->where('pacientes.tipo_paciente', 'docente')
            ->count();

        $psiquiatriaAdministrativo = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'psiquiatria')
            ->where('pacientes.tipo_paciente', 'administrativo')
            ->count();

        $psiquiatriaEstudiante = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'psiquiatria')
            ->where('pacientes.tipo_paciente', 'estudiante')
            ->count();

        //Contadores de fisiatria
        $totalFisiatria = DB::table('table_consultas')
            ->where('especialidad', 'fisiatria')
            ->count();
        $fisiatriaObrero = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'fisiatria')
            ->where('pacientes.tipo_paciente', 'obrero')
            ->count();

        $fisiatriaDocente = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'fisiatria')
            ->where('pacientes.tipo_paciente', 'docente')
            ->count();

        $fisiatriaAdministrativo = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'fisiatria')
            ->where('pacientes.tipo_paciente', 'administrativo')
            ->count();

        $fisiatriaEstudiante = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'fisiatria')
            ->where('pacientes.tipo_paciente', 'estudiante')
            ->count();



        //Contadores de traumatologia
        $totalTraumatologia = DB::table('table_consultas')
            ->where('especialidad', 'traumatologia')
            ->count();
        $traumatologiaObrero = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'traumatologia')
            ->where('pacientes.tipo_paciente', 'obrero')
            ->count();

        $traumatologiaDocente = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'traumatologia')
            ->where('pacientes.tipo_paciente', 'docente')
            ->count();

        $traumatologiaAdministrativo = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'traumatologia')
            ->where('pacientes.tipo_paciente', 'administrativo')
            ->count();

        $traumatologiaEstudiante = DB::table('table_consultas')
            ->join('pacientes', 'table_consultas.cedula', '=', 'pacientes.cedula')
            ->where('table_consultas.especialidad', 'traumatologia')
            ->where('pacientes.tipo_paciente', 'estudiante')
            ->count();

        //Las Consultas en total
        $totalConsultas = DB::table('table_consultas')
            ->count();

        // Retornamos la vista con los tres contadores
        return view('estadisticas', compact(
            'totalGeneral',
            'totalNiños',
            'totalParto',
            'totalPesquisa',
            'totalVital',
            'generalObrero',
            'generalDocente',
            'generalAdministrativo',
            'generalEstudiante',
            'totalOdontologia',
            'odontologiaObrero',
            'odontologiaDocente',
            'odontologiaAdministrativo',
            'odontologiaEstudiante',
            'totalPsiquiatria',
            'psiquiatriaObrero',
            'psiquiatriaDocente',
            'psiquiatriaAdministrativo',
            'psiquiatriaEstudiante',
            'totalFisiatria',
            'fisiatriaObrero',
            'fisiatriaDocente',
            'fisiatriaAdministrativo',
            'fisiatriaEstudiante',
            'totalTraumatologia',
            'traumatologiaObrero',
            'traumatologiaDocente',
            'traumatologiaAdministrativo',
            'traumatologiaEstudiante',
            'totalVisitantes',
            'totalVisitantesGeneral',
            'totalVisitantesOdontologia',
            'totalVisitantesPsiquiatria',
            'totalVisitantesFisiatria',
            'totalVisitantesTraumatologia',
            'totalConsultas'
        ));
    }
}
