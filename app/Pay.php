<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $table = 'pays';

    protected $fillable = [
        'content', 'value', 'wallet_id', 'wallet_receive',
    ];

    public $timestamps = true;

    public function wallets()
    {
        return $this->belongsTo('App\Wallet', 'wallet_id', 'id');
    }
}
