<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class EarningReport extends NoDeleteBaseModel
{
    use HasFactory;

    protected $fillable = [
        'earning_id',
        'earning',
        'commission',
        'balance',
    ];


    public function earnings()
    {
        return $this->belongsTo('App\Models\Earning', 'earning_id', 'id');
    }

}
