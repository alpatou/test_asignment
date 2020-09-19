<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{

    protected $table = 'accounts';

    protected $fillable = [
        'name',
        'balance',
    ];

    public function transactionsSent() {
        return $this->hasMany(Transaction::class, 'from');
    }

    public function transactionsReceived() {
        return $this->hasMany(Transaction::class, 'to');
    }

}
