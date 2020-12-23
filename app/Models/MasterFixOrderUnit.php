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
    protected $casts = [
        'date_save_order' => 'datetime:d-M-Y H:i:s',
        'date_send_approval' => 'datetime:d-M-Y H:i:s',
        'date_approval' => 'datetime:d-M-Y H:i:s',
        'date_revise' => 'datetime:d-M-Y H:i:s',
        'date_submit_atpm_order' => 'datetime:d-M-Y H:i:s',
        'date_cancel' => 'datetime:d-M-Y H:i:s',
        'date_allocation_atpm' => 'datetime:d-M-Y H:i:s',
        'created_at' => 'datetime:d-M-Y H:i:s',
        'updated_at' => 'datetime:d-M-Y H:i:s',
    ];

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
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
