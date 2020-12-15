<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentMenu extends Model
{
    use HasFactory;

    protected $table = 'tbl_parent_menu';
    protected $primaryKey = 'id_parent_menu';
    protected $searchableColumn =  ['parent_position', 'prefix', 'nama_parent_menu', 'url', 'icon', 'nama_group'];
    protected $guarded = ['id_parent_menu'];

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }

    public function childsMenu()
    {
        return $this->hasMany(ChildMenu::class, 'id_parent_menu');
    }

    public function menuUserGroup()
    {
        return $this->belongsTo(MenuUserGroup::class, 'id_parent_menu');
    }
}
