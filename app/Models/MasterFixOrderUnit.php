<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFixOrderUnit extends Model
{
    use HasFactory;

    protected $table = 'tbl_master_fix_order_unit';
    protected $primaryKey = 'id_master_fix_order_unit';
    protected $searchableColumn = [
        'id_master_fix_order_unit',
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
        'id_month',
        'year_order',
        'grand_total_qty',
    ];
    protected $guarded = ['id_master_fix_order_unit'];

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }

    // this is a Accessor (change field to show)
    public function getDateReviseAttribute($value)
    {
        if($value) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d M Y H:i:s');
        }
    }

    public function getDateSaveOrderAttribute($value)
    {
        if($value) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d M Y H:i:s');
        }
    }

    public function getDateCancelAttribute($value)
    {
        if($value) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d M Y H:i:s');
        }
        
    }

    public function detailFixOrderUnit()
    {
        return $this->hasMany(DetailFixOrderUnit::class, 'id_master_fix_order_unit');
    }

    public function detailColorFixOrderUnit()
    {
        return $this->hasMany(DetailColourFixOrderUnit::class, 'id_detail_fix_order_unit');
    }
}
