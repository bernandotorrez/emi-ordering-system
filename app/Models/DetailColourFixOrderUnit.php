<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailColourFixOrderUnit extends Model
{
    use HasFactory;

    protected $table = 'tbl_detail_color_fix_order_unit';
    protected $primaryKey = 'id_detail_color_fix_order_unit';
    protected $guarded = ['id_detail_color_fix_order_unit'];

    protected $searchableColumn =  [
        'id_detail_fix_order_unit',
        'id_colour',
        'colour_name',
        'qty',
    ];

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }
}
