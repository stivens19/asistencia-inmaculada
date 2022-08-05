<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceUser extends Model
{
    protected $table = 'attendance_user';
    protected $fillable = ['attendance_id', 'user_id','friaje','tarde','time_attendance'];
    public function attendance()
    {
        return $this->belongsTo(Attendance::class);

    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');

    }
}
