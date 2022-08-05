<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\AttendanceUser;
use App\Exports\AttendanceExport;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $days=Attendance::latest()->paginate(3);
        return view('day.index',compact('days'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'time_in'=>'required',
            'turno'=>'required',
        ]);
        $date=date('Y-m-d');
        // $time=date('H:i:s');
        Attendance::create([
            'time_in'=>$data['time_in'],
            'turno'=>$data['turno'],
            'date'=>$date,
        ]);
        return redirect()->route('days.index')->withSuccess('Registro creado con éxito');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attendance=Attendance::find($id);
        return view('day.show',compact('attendance'));
    }
    public function InfoUser($dni)
    {
        $user=User::where('dni',$dni)->first();
        return response()->json($user);
    }
    public function registrarAsistencia($user,$attendance)
    {
        $attendance=Attendance::find($attendance);
        $hoy=date('Y-m-d');
        $user=User::find($user);
        if($attendance->turno !== $user->turno){
            return response()->json(['type'=>'error','message'=>'El usuario no corresponde al turno de la asistencia']);
        }
        if($attendance->date !== $hoy){
            return response()->json(['type'=>'error','message'=>'La asistencia no corresponde al día de hoy']);
        }
        $time=date('H:i:s');
        $tarde=$time>$attendance->time_in;
        DB::table('attendance_user')->insert([
            'user_id'=>$user->id,
            'attendance_id'=>$attendance->id,
            'tarde'=>$tarde,
            'time_attendance'=>$time,
        ]);
        return response()->json(['type'=>'success','message'=>'Asistencia registrada con éxito']);
    }
    public function exportView($id)
    {
        $attendance=Attendance::find($id);
        return view('day.registros',compact('attendance'));
    }
    public function export($id)
    {
        $grado=request()->grado;
        $seccion=request()->seccion;
        $attuser=AttendanceUser::where('attendance_id',$id)->whereHas('user',function($q){
            $q->where([['grado',request()->grado],['seccion',request()->seccion]]);
        })->get();
        $pdf = \PDF::loadView('day.pdf', compact('attuser','grado','seccion'));
        return $pdf->download("regasistencia.pdf");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
