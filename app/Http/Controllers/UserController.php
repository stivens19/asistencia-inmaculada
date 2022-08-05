<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Facades\Excel;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users=User::with('role')->get();
        $roles=Role::all();
        return view('users.index',compact('users','roles'));
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
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed',
            'role_id'=>'required',
            'turno'=>'required',
            'dni'=>'required|unique:users',
        ]);
        $data['password']=bcrypt($data['password']);
        $user=User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>$data['password'],
            'role_id'=>$data['role_id'],
            'turno'=>$data['turno'],
            'grado'=>$request->grado,
            'seccion'=>$request->seccion,
            'dni'=>$data['dni'],

        ]);
        return redirect()->route('users.index')->withSuccess('Usuario creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::findOrFail($id);
        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($user->dni));
        $pdf = \PDF::loadView('users.pdf', compact('user','qrcode'));
        return $pdf->download("carnet-$user->name.pdf");
    }

    
    public function import(Request $request)
    {
        Excel::import(new UsersImport, request()->file('file'));
        set_time_limit(0);
        return back()->with('success', 'Usuarios importados con éxito');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
