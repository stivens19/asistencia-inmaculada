<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'turno'     => $row[0],
            'grado'    => $row[1], 
            'seccion' => $row[2],
            'email'=>$row[5].'@mariainmaculada.com',
            'role_id'=>$row[4],
            'dni'=>$row[5],
            'name'=>$row[6],
            'password'=>Hash::make($row[5].'mariainmaculada'),
        ]);
    }
}
