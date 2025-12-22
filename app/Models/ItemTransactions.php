<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTransactions extends Model
{
    /** @use HasFactory<\Database\Factories\ItemTransactionsFactory> */
    use HasFactory;

     protected $fillable = [
        'item_id',
        'user_id',
        'transaction_type',
        'quantity',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
