<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeTahun extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_kode_tahun';
    protected $primaryKey = 'id_kode_tahun';
    protected $guarded = ['id_kode_tahun'];
}
