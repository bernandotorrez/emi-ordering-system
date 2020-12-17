<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMonthOrder extends Model
{
    use HasFactory;

    protected $table = 'tbl_master_month_order';
    protected $primaryKey = 'id_month';
    protected $guarded = ['id_month'];
    protected $searchableColumn = [
        'month',
        'date_input_lock_start',
        'date_input_lock_end',
        'operator_start',
        'operator_end',
    ];

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }

    public function rangeMonths()
    {
        return $this->hasMany(RangeMonthFixOrder::class, 'id_month');
    }
}
