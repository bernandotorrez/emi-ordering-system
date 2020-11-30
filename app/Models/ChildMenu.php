<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildMenu extends Model
{
    use HasFactory;

    protected $table = 'tbl_child_menu';
    protected $primaryKey = 'id_child_menu';
    protected $fillable = ['id_parent_menu', 'child_position', 'nama_child_menu', 'url', 'icon'];
    protected $visible = ['id_child_menu', 'id_parent_menu', 'child_position', 'nama_child_menu', 'url', 'icon'];
    protected $searchableColumn =  ['id_parent_menu', 'child_position', 'nama_child_menu', 'url', 'icon'];

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }

    public function parentMenu()
    {
        return $this->belongsTo(ParentMenu::class, 'id_parent_menu');
    }
}