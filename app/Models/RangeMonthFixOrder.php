<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RangeMonthFixOrder extends Model
{
    use HasFactory;

    protected $table = 'tbl_range_month_fix_order';
    protected $primayKey = 'id_range_rule';
    protected $guarded = ['id_range_rule'];
    protected $searchableColumn = [
        'id_month',
        'month_id_to',
        'flag_open_colour',
        'flag_open_volume',
        'flag_open_volume',
    ];

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }

    public function month()
    {
        return $this->belongsTo(MasterMonthOrder::class, 'id_month');
    }
}
