<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = [];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'account_id');
    }
}
