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
    protected $fillable = [
        'kd_user_wrs', 'nama_user', 'username', 'password', 'email', 'id_user_group', 
        'id_dealer', 'id_dealer_level', 'level_access', 'status_atpm', 'is_from_wrs'
    ];
    protected $primaryKey = 'id_user';
    protected $visible = [
        'kd_user_wrs', 'nama_user', 'username', 'password', 'email', 'id_user_group', 
        'id_dealer', 'id_dealer_level', 'level_access', 'status_atpm', 'is_from_wrs'
    ];
    protected $searchableColumn = ['kd_user_wrs', 'nama_user', 'username', 'email', 'id_user_group', 'status_atpm'];
    protected $keyType = 'string';

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }

    public function userGroup()
    {
        return $this->belongsTo(UserGroup::class, 'id_user_group');
    }
}
