<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAdditionalOrderUnit extends Model
{
    use HasFactory;

    protected $table = 'tbl_detail_additional_order_unit';
    protected $primaryKey = 'id_detail_additional_order_unit';
    protected $searchableColumn =  [
        'id_detail_additional_order_unit',
        'id_master_additional_order_unit',
        'id_model',
        'model_name',
        'id_type',
        'type_name',
        'id_colour',
        'colour_name',
        'qty',
        'year_production',
    ];
    protected $fillable = [
        'id_master_additional_order_unit',
        'id_model',
        'model_name',
        'id_type',
        'type_name',
        'id_colour',
        'colour_name',
        'qty',
        'year_production',
    ];
    protected $guarded = ['id_detail_additional_order_unit'];

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }

    public function masterAdditionalOrderUnit()
    {
        return $this->belongsTo(MasterAdditionalOrderUnit::class, 'id_master_additional_order_unit');
    }
}
