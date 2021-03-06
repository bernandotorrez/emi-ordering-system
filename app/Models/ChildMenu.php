<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildMenu extends Model
{
    use HasFactory;

    protected $table = 'tbl_child_menu';
    protected $primaryKey = 'id_child_menu';
    protected $searchableColumn =  [
        'nama_parent_menu', 
        'child_position', 
        'nama_child_menu', 
        'url', 
        'icon',
        'nama_group'
    ];
    protected $guarded = ['id_child_menu'];

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }

    public function parentMenu()
    {
        return $this->belongsTo(ParentMenu::class, 'id_parent_menu');
    }

    public function subChildsMenu()
    {
        return $this->hasMany(SubchildMenu::class, 'id_child_menu');
    }
}