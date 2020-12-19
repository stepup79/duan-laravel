<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mau_SanPham extends Model
{
    protected $table        = 'pal_mau_sanpham';
    protected $fillable     = ['sp_ma', 'm_ma', 'msp_soluong'];
    protected $guarded      = ['m_ma'];

    protected $primaryKey   = ['sp_ma', 'm_ma'];
}
