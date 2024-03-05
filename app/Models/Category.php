<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory,HasTranslations, SoftDeletes;

    protected $fillable = ['name','icon','order','parent_id'];

    public $translatable = ['name'];

    public function childCategories()
    {
        return $this->hasMany(self::class,'parent_id','id');
    }

    public function ParentCategory()
    {
       return $this->belongsTo(self::class,'parent_id','id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
