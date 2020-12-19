<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HinhAnh extends Model
{

    protected $table        = 'pal_hinhanh';
    protected $fillable     = ['sp_ma', 'ha_stt', 'ha_ten'];
    protected $guarded      = ['ha_stt'];

    protected $primaryKey   = ['sp_ma', 'ha_stt'];

}
