<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuUserGroup extends Model
{
    use HasFactory;

    protected $table = 'tbl_menu_user_group';
    protected $primaryKey = 'id_menu_user_group';
    protected $searchableColumn =  [
        'nama_group',
        'nama_parent_menu',
        'nama_child_menu',
        'nama_sub_child_menu',
        'nama_sub_sub_child_menu',
        'can_view',
        'can_add',
        'can_edit',
        'can_delete',
    ];
    protected $guarded = ['id_menu_user_group'];

    public function getsearchableColumn()
    {
        return $this->searchableColumn;
    }

    public function parentsMenu()
    {
        return $this->hasMany(ParentMenu::class, 'id_parent_menu');
    }
}
