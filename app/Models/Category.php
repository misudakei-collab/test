<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // ここに書くのが正解です！
    protected $fillable = ['content'];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
