<?php

namespace App\Exports;

use App\Attendance;
use App\AttendanceUser;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
class AttendanceExport implements FromQuery
{
    use Exportable;
    public function __construct($grado,$seccion,$attendance_id)
    {
        $this->grado = $grado;
        $this->seccion = $seccion;
        $this->attendance_id = $attendance_id;
    }

    public function query()
    {
        return AttendanceUser::with('user')->where('attendance_id',$this->attendance_id)->whereHas('user',function($q){
            $q->where('grado',$this->grado)->where('seccion',$this->seccion);
        });
    }
}
