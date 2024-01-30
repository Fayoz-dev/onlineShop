<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class DeliveryMethod extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $fillable = [
        'name',
        'estimeted_time',
        'sum'
    ];

    public $translatable = ['name' , 'estimeted_time'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
