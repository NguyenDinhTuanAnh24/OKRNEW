<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $primaryKey = 'user_id'; // Sử dụng user_id làm khóa chính

    protected $fillable = [
        'email',
        'sub',
        'full_name',
        'phone',
        'job_title',
        'avatar_url',
        'department_id',
        'role_id',
        'google_id',
    ];

    // Bỏ password_hash vì Cognito quản lý mật khẩu
    protected $hidden = ['password_hash'];

    // Quan hệ với bảng departments và roles
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'department_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }
}