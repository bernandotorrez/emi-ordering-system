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
        'can_view_parent',
        'can_add_parent',
        'can_edit_parent',
        'can_delete_parent',
        'can_view_child',
        'can_add_child',
        'can_edit_child',
        'can_delete_child',
        'can_view_sub_child',
        'can_add_sub_child',
        'can_edit_sub_child',
        'can_delete_sub_child',
        'can_view_sub_sub_child',
        'can_add_sub_sub_child',
        'can_edit_sub_sub_child',
        'can_delete_sub_sub_child',
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
