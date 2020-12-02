<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubChildMenu extends Model
{
    use HasFactory;

    protected $table = 'tbl_sub_sub_child_menu';
    protected $primaryKey = 'id_sub_sub_child_menu';
    protected $fillable = [
        'id_sub_child_menu', 'id_parent_menu', 'id_child_menu', 'sub_sub_child_position', 
        'nama_sub_sub_child_menu', 'url', 'icon'
    ];
    protected $visible = [
        'id_sub_sub_child_menu', 'id_sub_child_menu', 'id_parent_menu', 'id_child_menu', 
        'sub_sub_child_position', 'nama_sub_sub_child_menu', 'url', 'icon'
    ];
    protected $searchableColumn =  [
        'id_sub_sub_child_menu', 'id_sub_child_menu', 'id_parent_menu', 'id_child_menu', 
        'sub_sub_child_position', 'nama_sub_sub_child_menu', 'url', 'icon'
    ];

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }

    public function subChildMenu()
    {
        return $this->belongsTo(SubchildMenu::class, 'id_sub_child_menu');
    }

    public function childMenu()
    {
        return $this->belongsTo(ChildMenu::class, 'id_child_menu');
    }

    public function parentMenu()
    {
        return $this->belongsTo(ParentMenu::class, 'id_parent_menu');
    }
}
