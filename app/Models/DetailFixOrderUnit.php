<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFixOrderUnit extends Model
{
    use HasFactory;

    protected $table = 'tbl_detail_fix_order_unit';
    protected $primaryKey = 'id_detail_fix_order_unit';
    protected $guarded = ['id_detail_fix_order_unit'];

    protected $searchableColumn =  [
        'id_detail_fix_order_unit',
        'id_master_fix_order_unit',
        'id_model',
        'model_name',
        'id_type',
        'type_name',
        'total_qty',
        'year_production',
    ];

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }

    public function detailColorFixOrder()
    {
        return $this->hasMany(DetailColourFixOrderUnit::class, 'id_detail_fix_order_unit');
    }

    public function masterFixOrderUnit()
    {
        return $this->belongsTo(MasterFixOrderUnit::class, 'id_master_fix_order_unit');
    }
}
