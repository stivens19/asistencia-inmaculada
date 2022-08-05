<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','dni','celular','direccion','active','grado','seccion','turno'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class,'role_id');
    }
    private function attuser()
    {
        return $this->belongsToMany(Attendance::class,'attendance_user','user_id','attendance_id');
    }
    public function hasRoles(array $roles){
        foreach($roles as $rol){
            if($this->role->name==$rol){
                return true;
            }
        }
        return false;
    }
}
