<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAdditionalOrderUnit extends Model
{
    use HasFactory;

    protected $table = 'tbl_detail_additional_order_unit';
    protected $primaryKey = 'id_detail_order_unit';
    protected $searchableColumn =  [
        'id_detail_additional_order_unit',
        'id_master_additional_order_unit',
        'id_model',
        'id_type',
        'id_colour',
        'qty',
        'year_production',
    ];
    protected $guarded = ['id_detail_order_unit'];
}
