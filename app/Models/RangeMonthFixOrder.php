<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RangeMonthFixOrder extends Model
{
    use HasFactory;

    protected $table = 'tbl_range_month_fix_order';
    protected $primaryKey = 'id_range_rule';
    protected $guarded = ['id_range_rule'];
    protected $searchableColumn = [
        'id_range_rule',
        'id_month',
        'month_id_to',
        'flag_open_colour',
        'flag_open_volume',
        'flag_button_add_before',
        'flag_button_amend_before',
        'flag_button_send_approval_before',
        'flag_button_revise_before',
        'flag_button_planning_before',
        'flag_button_submit_before',
        'flag_button_approve_before',
        'flag_button_add_after',
        'flag_button_amend_after',
        'flag_button_send_approval_after',
        'flag_button_revise_after',
        'flag_button_planning_after',
        'flag_button_submit_after',
        'flag_button_approve_after',
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
