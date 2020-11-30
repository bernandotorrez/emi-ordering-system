<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentMenu extends Model
{
    use HasFactory;

    protected $table = 'tbl_parent_menu';
    protected $primaryKey = 'id_parent_menu';
    protected $fillable = ['parent_position', 'nama_parent_menu', 'url', 'icon'];
    protected $visible = ['id_parent_menu', 'parent_position', 'nama_parent_menu', 'url', 'icon'];
    protected $searchableColumn =  ['parent_position', 'nama_parent_menu', 'url', 'icon'];

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }

    public function childsMenu()
    {
        return $this->hasMany(ChildMenu::class, 'id_parent_menu');
    }
}
