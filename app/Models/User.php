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
    protected $fillable = ['id_user', 'nama_user', 'username', 'password', 'email', 'id_group', 'level_access', 'status_atpm'];
    protected $primaryKey = 'id_user';
    protected $visible = ['id_user', 'nama_user', 'username', 'email', 'id_group', 'status_atpm', 'level_access'];
    protected $searchableColumn = ['nama_user', 'username', 'email', 'status_atpm'];
    public $incrementing = 'false';
    protected $keyType = 'string';

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }

    public function oneUserGroup()
    {
        return $this->belongsTo(UserGroup::class, 'id_user_group');
    }
}
