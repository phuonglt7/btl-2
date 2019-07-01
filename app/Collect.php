<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    protected $table = 'collects';

    protected $fillable = [
        'content', 'value', 'wallet_id',
    ];

    public $timestamps = true;

    public function wallets()
    {
        return $this->belongsTo('App\Wallet', 'wallet_id', 'id');
    }
}
