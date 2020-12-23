<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthExceptionRule extends Model
{
    use HasFactory;

    protected $table = 'tbl_month_exception_rule';
    protected $primaryKey = 'id_rule_month';
    protected $guarded = ['id_rule_month'];
    protected $searchableColumn = [
        'id_month',
        'date_input_lock_month_start',
        'date_input_lock_month_end',
        'id_dealer',
        'flag_open_colour',
        'flag_open_volume',
    ];

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }
}
