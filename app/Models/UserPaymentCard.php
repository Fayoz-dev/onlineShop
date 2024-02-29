<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPaymentCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_card_type_id',
        'name',
        'number',
        'exp_date',
        'holder_name',
        'last_four_number',
    ];

    public function type():BelongsTo
    {
       return $this->belongsTo(PaymentCardType::class,'payment_card_type_id','id');
    }
}
