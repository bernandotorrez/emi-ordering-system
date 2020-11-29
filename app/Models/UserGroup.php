<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGroup extends Model
{
    use HasFactory;

    protected $table = 'tbl_user_group';
    protected $primaryKey = 'id_user_group';
    protected $fillable = ['nama_group'];
    protected $visible = ['id_user_group', 'nama_group', 'status'];
    protected $searchableColumn = ['nama_group'];

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }

    public function usersGroup()
    {
        return $this->hasMany(User::class, 'id_user_group');
    }
}
