<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Account extends Model
{
    use HasFactory, NodeTrait;

    protected $fillable = [
        'rank_id',
        'account_group_id',
        'login',
        'member_name',
        'mobile_number',
        'email',
    ];

    public function rank() {
        return $this->belongsTo(RankSetting::class, 'rank_id', 'id');
    }

    public function accountGroup() {
        return $this->belongsTo(AccountGroups::class, 'account_group_id', 'id');
    }
}
