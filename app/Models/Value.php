<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Value extends Model
{
    use HasFactory,HasTranslations;

    public $translatable = ['name'];
    protected $fillable = ['name'];

    public function attribute():BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }
}
