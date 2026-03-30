<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    /**
     * お問い合わせは1つのカテゴリに属する
     * RelationNotFoundExceptionを解決するための定義
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
