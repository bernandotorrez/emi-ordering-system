<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAdditionalOrderUnit extends Model
{
    use HasFactory;

    protected $table = 'tbl_master_additional_order_unit';
    protected $primaryKey = 'id_master_additional_order_unit';
    protected $searchableColumn =  [
        'id_oder',
        'order_no_atpm',
        'order_no_dealer',
        'date_save_order',
        'date_send_approval',
        'date_approval',
        'date_submit_atpm_order',
        'date_alocation_atpm',
        'id_dealer',
        'id_user',
        'user_order',
        'user_approval',
        'month_order',
        'year_order',
        'total_qty',
    ];
    protected $guarded = ['id_master_additional_order_unit'];

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }

    public function detailAdditionalOrderUnit()
    {
        return $this->hasMany(DetailAdditionalOrderUnit::class, $this->primaryKey);
    }
}
