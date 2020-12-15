<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelStatus extends Model
{
    use HasFactory;

    protected $table = 'tbl_cancel_status';
    protected $primaryKey = 'id_cancel_status';
    protected $guarded = ['id_cancel_status'];
    protected $searchableColumn = ['nama_cancel_status'];

    public function getSearchableColumn()
    {
        return $this->searchableColumn;
    }
}
