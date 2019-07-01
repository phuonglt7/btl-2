<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';

    protected $fillable = [
        'wallet_name', 'coin', 'user_id',
    ];

    public $timestamps = true;

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function pays()
    {
        return $this->hasMany('App\Pay', 'wallet_id', 'id');
    }

    public function collects()
    {
        return $this->hasMany('App\Collect', 'wallet_id', 'id');
    }

    public function scopeSort($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
