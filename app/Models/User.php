<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserGroup;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $hidden = ['password'];
    protected $searchableColumn = [
        'kd_user_wrs', 
        'nama_user', 
        'username', 
        'email', 
        'nama_group', 
        'status_atpm'
    ];
    protected $guarded = ['id_user'];

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }
}
