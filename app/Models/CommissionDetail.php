<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'account_from_id',
        'fuelcharge',
        'commission',
        'percentage',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function accountFrom()
    {
        return $this->belongsTo(Account::class, 'account_from_id');
    }
}
